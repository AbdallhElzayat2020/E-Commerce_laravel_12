<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'product_description',
        'quantity',
        'product_price',
        'data',
        'product_variant_id',
    ];
}
