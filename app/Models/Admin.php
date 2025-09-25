<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admins';
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'status',
        'role_id',
        'remember_token',
    ];
}
