<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Psr\Log\LoggerInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    
    protected const MAX_ATTEMPTS = 3;
    protected const ATTEMPT_DECAY_SECONDS = 120; 
    protected const BLOCK_INCREMENT_SECONDS = 10; 
    protected const BLOCK_MAX_SECONDS = 60; 

    protected $logger;

    /**
     * Konstruktor untuk menyuntikkan LoggerInterface.
     *
     * @param  \Psr\Log\LoggerInterface  $logger
     * @return void
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Tampilkan halaman login.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('auth.login', [
            'title' => 'Login',
            'active' => 'login',
            'csrf_token' => csrf_token(), 
        ]);
    }

    /**
     * Proses autentikasi pengguna.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
       
        $credentials = $request->validate([
            'username' => 'required|string|min:3|max:50',
            'password' => 'required|string|min:8|max:50',
        ]);
    
        $throttleKey = $this->throttleKey($request);
        $attemptsKey = 'login_attempts:' . $throttleKey;
        $blockKey = 'login_blocked:' . $throttleKey;
    
        // Cek apakah pengguna saat ini diblokir
        if (RateLimiter::tooManyAttempts($blockKey, 1)) {
            $seconds = RateLimiter::availableIn($blockKey);
            $this->logger->warning('Percobaan login diblokir dari IP: ' . $request->ip());
    
            return back()
                ->with('loginError', 'Terlalu banyak percobaan login. Coba lagi dalam ' . $seconds . ' detik.')
                ->with('retryAfter', $seconds);
        }
    
        // autentikasi
        if (Auth::attempt($credentials)) {

            $user = Auth::user(); 

            $token = $user->createToken('CyberWeb')->plainTextToken;

            $request->session()->regenerate();
            RateLimiter::clear($attemptsKey);
            RateLimiter::clear($blockKey); 
    
            return redirect('/apps');
        }
    
        // Autentikasi gagal
        RateLimiter::hit($attemptsKey, self::ATTEMPT_DECAY_SECONDS);
        $currentAttempts = RateLimiter::attempts($attemptsKey);
        $attemptsLeft = self::MAX_ATTEMPTS - ($currentAttempts % self::MAX_ATTEMPTS);
    
        $this->logger->warning('Login gagal dari IP: ' . $request->ip());
    
        if ($currentAttempts % self::MAX_ATTEMPTS === 0) {
           
            $blockCount = intdiv($currentAttempts, self::MAX_ATTEMPTS);
            
            $blockSeconds = self::BLOCK_INCREMENT_SECONDS * $blockCount;
            $blockSeconds = min($blockSeconds, self::BLOCK_MAX_SECONDS); 
    
            // Blokir pengguna selama $blockSeconds detik
            RateLimiter::hit($blockKey, $blockSeconds);
    
            return back()
                ->with('loginError', 'Terlalu banyak percobaan login. Coba lagi dalam ' . $blockSeconds . ' detik.')
                ->with('retryAfter', $blockSeconds);
        }
    
        return back()->with('loginError', 'Login gagal. Silakan coba lagi.');
    }
    

    /**
     * Logout pengguna.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $user = $request->user();

        $user->tokens->each(function ($token) {
            $token->delete(); // Menghapus token
        });
        Auth::logout();
        
        $request->session()->flush(); 
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
    

    /**
     * Mendapatkan kunci throttle unik untuk pengguna.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function throttleKey(Request $request)
    {
        // Hanya menggunakan IP untuk throttle key
        return $request->ip();
    }
}
