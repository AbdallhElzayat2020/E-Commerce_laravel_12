<?php

namespace App\Services\Auth;

use App\Notifications\SendOtpNotification;
use App\Repositories\Auth\PasswordRepository;

class PasswordService
{
    protected PasswordRepository $PasswordRepository;

    public function __construct(PasswordRepository $PasswordRepository)
    {
        $this->PasswordRepository = $PasswordRepository;
    }

    public function sendResetLink($email, $token)
    {
        $admin = $this->PasswordRepository->sendResetLink($email);
        if (!$admin) {
            return false;
        }
        return $admin->notify(new SendOtpNotification($token));
    }

    public function verifyOtp($email, $otp)
    {
        return $this->PasswordRepository->verifyOtp($email, $otp);
    }
}
