<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupons';
    protected $fillable = [
        'code',
        'discount',
        'discount_percentage',
        'start_date',
        'end_date',
        'limit',
        'time_used',
        'status',
    ];
}
