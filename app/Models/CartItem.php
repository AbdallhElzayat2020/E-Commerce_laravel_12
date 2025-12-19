<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{

    protected $fillable = [
        'cart_id',
        'product_id',
        'product_variant_id',
        'quantity',
        'price',
        'attributes',
    ];

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function productVariant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class);
    }

    protected function casts(): array
    {
        return [
            'attributes' => 'array',
        ];
    }


    /* ------------------ Attribute Variants ----------------- */

    // public function getAttributesAttribute($attributes)
    // {
    //     return json_decode($attributes, true);
    // }
}
