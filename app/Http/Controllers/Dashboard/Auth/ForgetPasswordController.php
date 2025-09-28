<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Auth\ForgetPasswordRequest;
use App\Http\Requests\Dashboard\Auth\VerifyOtpRequest;
use App\Models\Admin;
use App\Notifications\SendOtpNotification;
use App\Notifications\ResetPasswordNotification;
use App\Services\Auth\PasswordService;
use Ichtrojan\Otp\Otp;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ForgetPasswordController extends Controller
{
    public $otp2;
    public PasswordService $PasswordService;

    public function __construct(PasswordService $PasswordService)
    {
        $this->PasswordService = $PasswordService;
        $this->otp2 = new Otp();
    }

    public function forgotPassword()
    {
        return view('dashboard.auth.password.email-request');
    }

    public function sendResetLinkEmail(ForgetPasswordRequest $request)
    {

        $admin = Admin::whereEmail($request->email)->first();
        $token = Str::random(10);

        if (!$admin) {
            return redirect()->back()->with('error', 'Email address not found in our system.');
        }

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
        try {
            $otp = $this->otp2->validate($request->email, $request->otp);

            if (!$otp->status) {
                return redirect()->back()
                    ->with('error', 'Invalid OTP code. Please check your email and try again.')
                    ->withInput($request->only('email', 'otp'));
            }
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'OTP validation failed. Please try again.')
                ->withInput($request->only('email', 'otp'));
        }

        // After OTP verification, create password reset token
        $resetToken = Str::random(64);
        $email = $request->email;

        // Delete any existing tokens for this email
        DB::table('password_reset_tokens')->where('email', $email)->delete();

        // Insert new reset token

        // use upsert
        DB::table('password_reset_tokens')->updateOrInsert([
            'email' => $email,
            'token' => $resetToken,
            'created_at' => now()
        ]);

        // Send password reset link
        $admin = Admin::whereEmail($email)->first();
        $admin->notify(new ResetPasswordNotification($resetToken));

        return redirect()->route('dashboard.password.show-reset-password-form', ['email' => $email, 'token' => $resetToken])
            ->with('success', 'OTP verified successfully! Password reset link has been sent to your email.');
    }
}
