<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'name',
        'slug',
        'small_description',
        'description',
        'status',
        'sku',
        'available_for',
        'price',
        'discount',
        'start_discount',
        'end_discount',
        'manage_stock',
        'quantity',
        'available_in_stock',
        'views',
        'brand_id',
        'category_id',
    ];
}
