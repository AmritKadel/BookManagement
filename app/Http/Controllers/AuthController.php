<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirectToGoogle(Request $request)
    {
        
        return Socialite::driver('google')
            ->with(['state' => csrf_token()])
            ->redirect();
    }
    

    public function handleGoogleCallback()
{
    try {
        $user = Socialite::driver('google')->user();
    } catch (\Exception $e) {
       
        return redirect('/login')->with('error', 'Failed to authenticate with Google');
    }
    
    
    $googleId = $user->getId();
    $name = $user->getName();
    $email = $user->getEmail();

    
    return redirect('/dashboard');
}

    
}