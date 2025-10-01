<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Auth\ForgetPasswordRequest;
use App\Http\Requests\Dashboard\Auth\VerifyOtpRequest;
use App\Models\Admin;
use App\Notifications\SendOtpNotification;
use App\Notifications\ResetPasswordNotification;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class ForgetPasswordController extends Controller
{
    public $otp2;

    public function __construct()
    {
        $this->otp2 = new Otp();
    }

    public function forgotPassword()
    {
        return view('dashboard.auth.password.email-request');
    }

    public function sendResetLinkEmail(ForgetPasswordRequest $request)
    {
        $email = $request->validated()['email'];

        // Rate limiting: 2 requests per minute per email
        $key = 'otp-requests:' . $email;
        if (RateLimiter::tooManyAttempts($key, 2)) {
            $seconds = RateLimiter::availableIn($key);
            return redirect()->back()->with('error', "Too many OTP requests. Please try again in {$seconds} seconds.");
        }

        $admin = Admin::where('email', $email)->first();
        $token = Str::random(10);

        if (!$admin) {
            return redirect()->back()->with('error', 'Email address not found in our system.');
        }

        // Increment rate limiter
        RateLimiter::hit($key, 60); // 60 seconds

        // Send OTP
        $admin->notify(new SendOtpNotification($token));

        return to_route('dashboard.password.show-otp-form', ['email' => $admin->email, 'token' => $token])
            ->with('success', 'OTP verification code has been sent to your email address.');
    }

    public function showOtpForm($email, $token)
    {
        return view('dashboard.auth.password.confirm', ['email' => $email, 'token' => $token]);
    }

    public function verifyOtp(VerifyOtpRequest $request)
    {
        $validated = $request->validated();
        $email = $validated['email'];
        $otp = $validated['otp'];

        try {
            $otpResult = $this->otp2->validate($email, $otp);

            if (!$otpResult->status) {
                return redirect()->back()
                    ->with('error', 'Invalid OTP code. Please check your email and try again.')
                    ->withInput(['email' => $email, 'otp' => $otp]);
            }
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'OTP validation failed. Please try again.')
                ->withInput(['email' => $email, 'otp' => $otp]);
        }

        // After OTP verification, create password reset token
        $resetToken = Str::random(64);

        // Delete any existing tokens for this email
        DB::table('password_reset_tokens')->where('email', $email)->delete();

        // Insert new reset token
        DB::table('password_reset_tokens')->updateOrInsert([
            'email' => $email,
            'token' => $resetToken,
            'created_at' => now()
        ]);

        // Send password reset link
        $admin = Admin::where('email', $email)->first();
        $admin->notify(new ResetPasswordNotification($resetToken));

        return redirect()->route('dashboard.password.show-reset-password-form', ['email' => $email, 'token' => $resetToken])
            ->with('success', 'OTP verified successfully! Password reset link has been sent to your email.');
    }

    public function resendOtp(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:admins,email'],
            'token' => ['required', 'string']
        ]);

        $email = $request->email;
        
        // Rate limiting: 2 requests per minute per email
        $key = 'otp-requests:' . $email;
        if (RateLimiter::tooManyAttempts($key, 2)) {
            $seconds = RateLimiter::availableIn($key);
            return redirect()->back()->with('error', "Too many OTP requests. Please try again in {$seconds} seconds.");
        }

        $admin = Admin::where('email', $email)->first();
        
        if (!$admin) {
            return redirect()->back()->with('error', 'Email address not found in our system.');
        }

        // Increment rate limiter
        RateLimiter::hit($key, 60); // 60 seconds

        // Generate new OTP
        $otp = $this->otp2->generate($email, 'numeric', 6, 10);
        
        // Send new OTP
        $admin->notify(new SendOtpNotification($request->token));

        return redirect()->back()->with('success', 'OTP code has been resent to your email address.');
    }
}
