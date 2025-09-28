<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Auth\ResetPasswordRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    /**
     * Show password reset form
     */
    public function showResetPasswordForm($email, $token)
    {
        // Validate token
        $passwordReset = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->where('token', $token)
            ->where('created_at', '>', now()->subMinutes(60)) // Token valid for 60 minutes
            ->first();

        if (!$passwordReset) {
            return redirect()->route('dashboard.password.forgot-password')
                ->with('error', 'Invalid or expired password reset link. Please request a new one.');
        }

        return view('dashboard.auth.password.reset-password', [
            'email' => $email,
            'token' => $token
        ]);
    }

    /**
     * Handle password reset
     */
    public function ResetPassword(ResetPasswordRequest $request)
    {
        // Validate token again
        $passwordReset = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->where('created_at', '>', now()->subMinutes(60))
            ->first();

        if (!$passwordReset) {
            return redirect()->back()
                ->with('error', 'Invalid or expired password reset token. Please request a new reset link.')
                ->withInput();
        }

        // Find user
        $admin = Admin::where('email', $request->email)->first();
        if (!$admin) {
            return redirect()->back()
                ->with('error', 'User not found in our system.')
                ->withInput();
        }

        try {
            // Update password
            $admin->password = Hash::make($request->password);
            $admin->save();

            // Delete token from database
            DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->where('token', $request->token)
                ->delete();

            return redirect()->route('dashboard.login')
                ->with('success', 'Password has been reset successfully! Please login with your new password.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'An error occurred while resetting your password. Please try again.')
                ->withInput();
        }
    }
}
