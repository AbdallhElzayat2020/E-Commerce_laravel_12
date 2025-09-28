<?php

namespace App\Repositories\Auth;

use App\Models\Admin;
use Ichtrojan\Otp\Otp;

class PasswordRepository
{
    protected $otp2;

    public function __construct()
    {
        $this->otp2 = new Otp();
    }

    public function sendResetLink($email)
    {
        return Admin::whereEmail($email)->first();
    }

    public function verifyOtp($email, $otp)
    {
        return $this->otp2->validate($email, $otp);
    }
}
