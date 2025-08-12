<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     */
    public function showRegistrationForm()
    {
        return view('register');
    }

    /**
     * Handle a registration request.
     */
    public function register(Request $request)
    {
        // Rate limiting untuk mencegah spam registrasi
        $key = 'register.' . $request->ip();
        
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->withErrors([
                'email' => "Terlalu banyak percobaan registrasi. Silakan coba lagi dalam {$seconds} detik."
            ])->withInput($request->except('password', 'password_confirmation'));
        }

        // Validasi input dengan aturan keamanan ketat
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            RateLimiter::hit($key, 300); // 5 menit cooldown untuk validasi gagal
            return back()
                ->withErrors($validator)
                ->withInput($request->except('password', 'password_confirmation'));
        }

        try {
            // Buat user baru
            $user = $this->create($request->all());

            // Log aktivitas registrasi
            Log::info('User registered successfully', [
                'user_id' => $user->id,
                'email' => $user->email,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);

            // Fire event untuk registered
            event(new Registered($user));

            // Auto login setelah registrasi (opsional)
            Auth::login($user);

            // Clear rate limiter setelah sukses
            RateLimiter::clear($key);

            return redirect()->route('dashboard')->with('success', 'Registrasi berhasil! Selamat datang.');

        } catch (\Exception $e) {
            // Log error
            Log::error('Registration failed', [
                'error' => $e->getMessage(),
                'email' => $request->email,
                'ip_address' => $request->ip()
            ]);

            RateLimiter::hit($key, 300);

            return back()
                ->withErrors(['email' => 'Terjadi kesalahan saat registrasi. Silakan coba lagi.'])
                ->withInput($request->except('password', 'password_confirmation'));
        }
    }

    /**
     * Get a validator for an incoming registration request.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => [
                'required',
                'string',
                'max:255',
                'min:2',
                'regex:/^[a-zA-Z\s]+$/', // Hanya huruf dan spasi
            ],
            'email' => [
                'required',
                'string',
                'email:rfc,dns', // Validasi email dengan DNS check
                'max:255',
                'unique:users,email',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'
            ],
            'password' => [
                'required',
                'string',
                'confirmed',
                Password::min(8)
                    ->mixedCase() // Huruf besar dan kecil
                    ->numbers()   // Angka
                    ->symbols()   // Simbol
                    ->uncompromised() // Cek password yang sudah bocor
            ],
            'phone' => [
                'required',
                'string',
                'regex:/^(\+62|62|0)[0-9]{9,13}$/', // Format nomor Indonesia
                'unique:users,phone'
            ],
            'address' => [
                'required',
                'string',
                'min:10',
                'max:500'
            ],
            'role' => [
                'required',
                'in:admin,kasir' // Hanya role yang diizinkan
            ],
            'terms' => [
                'required',
                'accepted'
            ],
            // CAPTCHA atau reCAPTCHA (opsional)
            'g-recaptcha-response' => 'sometimes|required'
        ], [
            // Custom error messages
            'name.required' => 'Nama wajib diisi.',
            'name.regex' => 'Nama hanya boleh berisi huruf dan spasi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'phone.regex' => 'Format nomor telepon tidak valid.',
            'phone.unique' => 'Nomor telepon sudah terdaftar.',
            'address.required' => 'Alamat wajib diisi.',
            'address.min' => 'Alamat minimal 10 karakter.',
            'role.required' => 'Role wajib dipilih.',
            'role.in' => 'Role tidak valid.',
            'terms.accepted' => 'Anda harus menyetujui syarat dan ketentuan.',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     */
    protected function create(array $data)
    {
        // Sanitasi input
        $name = strip_tags(trim($data['name']));
        $email = strtolower(strip_tags(trim($data['email'])));
        $phone = preg_replace('/[^0-9+]/', '', $data['phone']);
        $address = strip_tags(trim($data['address']));

        return User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($data['password']),
            'phone' => $phone,
            'address' => $address,
            'role' => $data['role'],
            'is_active' => true, // Default aktif, bisa diubah jadi false jika perlu verifikasi email
        ]);
    }

    /**
     * Verify reCAPTCHA (jika digunakan)
     */
    protected function verifyRecaptcha($recaptchaResponse)
    {
        $secretKey = config('services.recaptcha.secret_key');
        
        if (!$secretKey || !$recaptchaResponse) {
            return false;
        }

        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$recaptchaResponse}");
        $responseData = json_decode($response);

        return isset($responseData->success) && $responseData->success === true;
    }
}