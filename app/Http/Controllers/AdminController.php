<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationCodeMail;

class AdminController extends Controller
{
    /**
     * Destroy an authenticated session.
     */
    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
    //End Method

    public function AdminLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if(Auth::attempt($credentials)){
            $user = Auth::user();
            $verificationCode = random_int(100000, 999999);
            session(['verification_code' => $verificationCode, 'user_id' => $user->id]);
            Mail::to($user->email)->send(new VerificationCodeMail($verificationCode));
            Auth::logout();
            return redirect()->route('custom.verification.form')->with('status', 'Verification code sent to your email.'); 
        } else {
            return redirect()->back()->withErrors([
                'email' => 'The provided credentials do not match our records.'
            ]);

        }
    }
    //End Method

    public function ShowVerification()
    {
        return view('auth.verify');
    } 
    //End Method  

    public function VerificationVerify(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6',
        ]);

        $storedCode = session('verification_code');
        $userId = session('user_id');

        if ($request->input('code') == $storedCode) {
            Auth::loginUsingId($userId);
            // $user = User::find($userId);
            // Auth::login($user);
            session()->forget(['verification_code', 'user_id']);
            return redirect()->intended(route('dashboard', absolute: false));
        } else {
            return redirect()->back()->withErrors([
                'code' => 'The provided verification code is incorrect.'
            ]);
        }
    }
    //End Method

    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_profile', compact('profileData'));
    }
    //End Method
}
