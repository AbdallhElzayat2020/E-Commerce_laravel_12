<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'user_name',
        'user_email',
        'user_phone',
        'price',
        'shipping_price',
        'total_price',
        'notes',
        'status',
        'country',
        'governorate',
        'postal_code',
        'city',
        'street',
        'coupon',
        'coupon_discount',
    ];
}
