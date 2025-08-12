<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite; 
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class GoogleController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect(); 
    }

    /**
     * Handle the callback from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleCallback()
    {
        try {
            
            $googleUser = Socialite::driver('google')->stateless()->user();

            $user = User::where('google_id', $googleUser->getId())->first();

            if ($user) {
                Auth::login($user);
                return redirect()->intended('/'); 
            } else {

                $existingUser = User::where('email', $googleUser->getEmail())->first();
                if ($existingUser) {

                    $existingUser->update([
                        'google_id' => $googleUser->getId(),
                        'foto' => $googleUser->getAvatar(), 
                    ]);
                    Auth::login($existingUser);
                    return redirect()->intended('/'); 
                } else {

                    $newUser = User::create([
                        'name' => $googleUser->getName(),
                        'email' => $googleUser->getEmail(),
                        'google_id' => $googleUser->getId(),
                        'foto' => $googleUser->getAvatar(),
                        'password' => Hash::make('ukmcyber'), // password default !!!
                    ]);                  

                    $role = Role::firstOrCreate(['name' => 'user']); 
                    $newUser->assignRole($role);

                    Auth::login($newUser);
                    return redirect()->intended('/'); 
                }
            }
        } catch (\Exception $e) {
            return redirect('/login')->with('loginError', 'Autentikasi dengan Google gagal.');
        }
    }
}
