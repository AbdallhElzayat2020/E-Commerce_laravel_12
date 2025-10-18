<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';
    protected $fillable = [
        'file_name',
        'file_size',
        'file_type',
        'product_id'
    ];
}
