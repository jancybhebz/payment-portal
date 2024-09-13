<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GoogleLogin extends Component
{
    // Redirect to Google
    public function redirectToGoogle()
    {
        return redirect()->away(Socialite::driver('google')->stateless()->redirect()->getTargetUrl());
    }

    // Handle Google callback
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            
            // Check if the user exists
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // If user does not exist, create a new user
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => Hash::make(uniqid()), // Generate a random password
                ]);
            }

            // Log in the user
            Auth::login($user);

            // Redirect to the dashboard
            return redirect()->intended('dashboard');

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Error logging in with Google.');
        }
    }

    public function render()
    {
        return view('livewire.auth.google-login');
    }
}