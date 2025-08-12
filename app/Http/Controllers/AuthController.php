<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Models\Shift;
use Carbon\Carbon;

class AuthController extends Controller
{
    protected const MAX_ATTEMPTS = 3;
    protected const ATTEMPT_DECAY_SECONDS = 2400; // 40 menit
    protected const BLOCK_INCREMENT_SECONDS = 60; // 1 menit
    protected const BLOCK_MAX_SECONDS = 1800; // 30 menit

    public function index()
    {
        // Redirect jika sudah login
        if (Auth::check()) {
            return redirect()->intended('/apps');
        }

        return view('login', [
            'title' => 'Login - Sistem Kasir',
            'active' => 'login',
        ]);
    }

    public function authenticate(Request $request)
    {
        try {
            // Log untuk debugging
            Log::info('Login attempt started', [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'username' => $request->input('username')
            ]);

            // Validasi input
            $credentials = $request->validate([
                'username' => [
                    'required',
                    'string',
                    'min:3',
                    'max:50',
                    'regex:/^[a-zA-Z0-9_.-]+$/'
                ],
                'password' => [
                    'required',
                    'string',
                    'min:6',
                    'max:255'
                ],
            ], [
                'username.required' => 'Username wajib diisi.',
                'username.min' => 'Username minimal 3 karakter.',
                'username.max' => 'Username maksimal 50 karakter.',
                'username.regex' => 'Username hanya boleh mengandung huruf, angka, underscore, titik, dan dash.',
                'password.required' => 'Password wajib diisi.',
                'password.min' => 'Password minimal 6 karakter.',
            ]);

            $throttleKey = $this->throttleKey($request);
            $attemptsKey = 'login_attempts:' . $throttleKey;
            $blockKey = 'login_blocked:' . $throttleKey;

            // Cek blokir IP
            if (RateLimiter::tooManyAttempts($blockKey, 1)) {
                $seconds = RateLimiter::availableIn($blockKey);
                Log::warning('Login blocked', [
                    'ip' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'username' => $credentials['username'],
                    'retry_after' => $seconds
                ]);
                return back()
                    ->withInput($request->only('username'))
                    ->with('loginError', 'Terlalu banyak percobaan login. Silakan tunggu.')
                    ->with('retryAfter', $seconds);
            }

            // Cek apakah user ada di database
            $user = User::where('username', $credentials['username'])->first();
            
            if (!$user) {
                Log::warning('Login failed - user not found', [
                    'ip' => $request->ip(),
                    'username' => $credentials['username']
                ]);
                
                // Increment attempts untuk user yang tidak ada juga
                RateLimiter::hit($attemptsKey, self::ATTEMPT_DECAY_SECONDS);
                $currentAttempts = RateLimiter::attempts($attemptsKey);
                
                return $this->handleFailedLogin($request, $credentials, $currentAttempts, $attemptsKey, $blockKey);
            }

            if ($user->is_active != 1) {
                Log::warning('Login blocked - user inactive', [
                    'ip' => $request->ip(),
                    'username' => $credentials['username']
                ]);
                
                return back()
                    ->withInput($request->only('username'))
                    ->with('loginError', 'Akun Anda tidak aktif. Silakan hubungi administrator.');
            }

            // Coba login dengan Auth::attempt
            $loginAttempt = Auth::attempt([
                'username' => $credentials['username'],
                'password' => $credentials['password']
            ], $request->boolean('remember'));

            if ($loginAttempt) {
                // Login berhasil
                $request->session()->regenerate();

                // Clear rate limiting
                RateLimiter::clear($attemptsKey);
                RateLimiter::clear($blockKey);

                // Update user login info
                $authenticatedUser = Auth::user();
                $authenticatedUser->update([
                    'last_login_at' => now(),
                    'last_login_ip' => $request->ip(),
                ]);

                Log::info('User logged in successfully', [
                    'user_id' => $authenticatedUser->id,
                    'username' => $authenticatedUser->username,
                    'name' => $authenticatedUser->name,
                    'ip' => $request->ip()
                ]);

                // Create API token jika menggunakan Sanctum
                if (method_exists($authenticatedUser, 'createToken')) {
                    $token = $authenticatedUser->createToken('AuthToken')->plainTextToken;
                    session(['api_token' => $token]);
                }

                return redirect()
                    ->intended('/apps')
                    ->with('success', 'Selamat datang, ' . $authenticatedUser->name . '!');
            }

            // Login gagal - password salah
            Log::warning('Login failed - invalid credentials', [
                'ip' => $request->ip(),
                'username' => $credentials['username'],
                'user_exists' => 'yes'
            ]);

            // Increment failed attempts
            RateLimiter::hit($attemptsKey, self::ATTEMPT_DECAY_SECONDS);
            $currentAttempts = RateLimiter::attempts($attemptsKey);

            return $this->handleFailedLogin($request, $credentials, $currentAttempts, $attemptsKey, $blockKey);

        } catch (ValidationException $e) {
            Log::warning('Login validation failed', [
                'ip' => $request->ip(),
                'errors' => $e->errors()
            ]);
            throw $e;
        } catch (\Exception $e) {
            Log::error('Login exception', [
                'ip' => $request->ip(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()
                ->withInput($request->only('username'))
                ->with('loginError', 'Terjadi kesalahan sistem. Silakan coba lagi.');
        }
    }

    /**
     * Handle failed login attempts
     */
    private function handleFailedLogin(Request $request, array $credentials, int $currentAttempts, string $attemptsKey, string $blockKey)
    {
        $attemptsLeft = self::MAX_ATTEMPTS - ($currentAttempts % self::MAX_ATTEMPTS);

        Log::warning('Login attempt failed', [
            'ip' => $request->ip(),
            'username' => $credentials['username'],
            'attempts' => $currentAttempts,
            'attempts_left' => $attemptsLeft
        ]);

        // Jika sudah mencapai batas maksimal attempts
        if ($currentAttempts % self::MAX_ATTEMPTS === 0) {
            $blockCount = intdiv($currentAttempts, self::MAX_ATTEMPTS);
            $blockSeconds = min(self::BLOCK_INCREMENT_SECONDS * $blockCount, self::BLOCK_MAX_SECONDS);
            
            RateLimiter::hit($blockKey, $blockSeconds);
            
            Log::warning('IP blocked due to too many failed attempts', [
                'ip' => $request->ip(),
                'username' => $credentials['username'],
                'block_seconds' => $blockSeconds,
                'total_attempts' => $currentAttempts
            ]);
            
            return back()
                ->withInput($request->only('username'))
                ->with('loginError', 'Terlalu banyak percobaan gagal. Akun Anda diblokir sementara.')
                ->with('retryAfter', $blockSeconds);
        }

        // Buat pesan error dengan informasi sisa percobaan
        $error = 'Username atau password salah.';
        if ($attemptsLeft <= 2) {
            $error .= " Sisa percobaan: $attemptsLeft.";
        }

        return back()
            ->withInput($request->only('username'))
            ->with('loginError', $error);
    }

    public function logout(Request $request)
    {
        $user = $request->user();

        if ($user) {
            // Prevent logout if there is an active shift for this user
            $activeShift = Shift::where('user_id', $user->id)
            ->where('status', 'active')
            ->first();
            
            if ($activeShift) {
                return redirect()
                    ->route('apps.shifts.close-form', $activeShift)
                    ->with('warning', 'Tutup shift terlebih dahulu sebelum logout.');
            }

            Log::info('User logged out', [
                'user_id' => $user->id,
                'username' => $user->username,
                'name' => $user->name,
                'ip' => $request->ip()
            ]);

            // Hapus semua token API jika menggunakan Sanctum
            if (method_exists($user, 'tokens')) {
                $user->tokens()->delete();
            }
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')
            ->with('success', 'Anda telah berhasil logout.');
    }

    /**
     * Generate throttle key berdasarkan IP dan user agent
     */
    protected function throttleKey(Request $request): string
    {
        return Str::transliterate(Str::lower($request->ip() . '|' . $request->header('User-Agent')));
    }

    /**
     * Get current login attempts for IP
     */
    public function getLoginAttempts(Request $request): int
    {
        $throttleKey = $this->throttleKey($request);
        $attemptsKey = 'login_attempts:' . $throttleKey;
        
        return RateLimiter::attempts($attemptsKey);
    }

    /**
     * Clear login attempts for IP (untuk admin)
     */
    public function clearLoginAttempts(Request $request): bool
    {
        $throttleKey = $this->throttleKey($request);
        $attemptsKey = 'login_attempts:' . $throttleKey;
        $blockKey = 'login_blocked:' . $throttleKey;
        
        RateLimiter::clear($attemptsKey);
        RateLimiter::clear($blockKey);
        
        Log::info('Login attempts cleared', [
            'ip' => $request->ip(),
            'admin_user' => $request->user()?->username
        ]);
        
        return true;
    }

    /**
     * Check current block status (AJAX endpoint)
     */
    public function checkBlockStatus(Request $request)
    {
        $status = $this->isBlocked($request);
        $attempts = $this->getLoginAttempts($request);
        
        return response()->json([
            'blocked' => $status['blocked'],
            'retry_after' => $status['retry_after'],
            'attempts' => $attempts,
            'max_attempts' => self::MAX_ATTEMPTS,
            'attempts_left' => max(0, self::MAX_ATTEMPTS - ($attempts % self::MAX_ATTEMPTS))
        ]);
    }

    /**
     * Check if user is currently blocked
     */
    public function isBlocked(Request $request): array
    {
        $throttleKey = $this->throttleKey($request);
        $blockKey = 'login_blocked:' . $throttleKey;
        
        $isBlocked = RateLimiter::tooManyAttempts($blockKey, 1);
        $retryAfter = $isBlocked ? RateLimiter::availableIn($blockKey) : 0;
        
        return [
            'blocked' => $isBlocked,
            'retry_after' => $retryAfter
        ];
    }
}