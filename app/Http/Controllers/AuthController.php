<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Otp;
use App\Models\User;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function loginForm(Request $request)
    {
        if ($request->has('redirect')) {
            session(['redirect_after_login' => $request->redirect]);
        }
        return view('auth.login');
    }

    public function counsellorLoginForm()
    {
        return view('auth.counsellor-login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            $role = Auth::user()->role;
            if ($role === 'admin') return redirect()->route('admin.dashboard');
            if ($role === 'counsellor') return redirect()->route('counsellor.dashboard');
            
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function sendOtp(Request $request)
    {
        $request->validate(['phone' => 'required|digits:10']);
        
        $lastSent = $request->session()->get('otp_sent_at');
        if ($lastSent && Carbon::now()->timestamp - $lastSent < 60) {
            return back()->with('otp_sent', true)->withErrors(['phone' => 'Please wait 1 minute before requesting another OTP.']);
        }
        
        $otpCode = (string) rand(100000, 999999);
        
        Otp::updateOrCreate(
            ['phone' => $request->phone],
            [
                'otp' => $otpCode,
                'expires_at' => Carbon::now()->addMinutes(3)
            ]
        );
        
        Log::info("OTP for {$request->phone} is: {$otpCode}");
        
        $request->session()->put('otp_phone', $request->phone);
        $request->session()->put('otp_sent_at', Carbon::now()->timestamp);
        
        return back()->with('otp_sent', true)->with('success', 'OTP sent successfully. Check logs.');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6'
        ]);
        
        $phone = $request->session()->get('otp_phone');
        if (!$phone) {
            return back()->withErrors(['otp' => 'Session expired. Please request OTP again.']);
        }
        
        $otpRecord = Otp::where('phone', $phone)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', Carbon::now())
            ->first();
            
        if (!$otpRecord) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
        }
        
        // Find or create user
        $user = User::firstOrCreate(
            ['phone' => $phone],
            ['name' => 'User ' . substr($phone, -4), 'role' => 'user']
        );
        
        Auth::login($user);
        $request->session()->regenerate();
        $request->session()->forget('otp_phone');
        
        $otpRecord->delete(); // Consume OTP
        
        $redirectUrl = session('redirect_after_login', route('user.dashboard'));
        session()->forget('redirect_after_login');
        
        return redirect($redirectUrl);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    public function clearOtp(Request $request)
    {
        $request->session()->forget('otp_phone');
        $request->session()->forget('otp_sent_at');
        return redirect()->route('login');
    }
}
