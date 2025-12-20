<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $table = 'coupons';
    protected $fillable = [
        'status',
        'time_used',
        'limit',
        'end_date',
        'start_date',
        'discount_percentage',
        'discount',
        'code',
    ];


    public function getCreatedAtAttribute($value)
    {
        return date('d/m/y H:i', strtotime($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('d/m/y H:i', strtotime($value));
    }

    /*  --------------------- Relations --------------------- */


    /*  --------------------- Scopes --------------------- */

    #[Scope]
    protected function Valid(Builder $query): Builder
    {
        return $query->where('status', 'active')
            ->whereColumn('time_used', '<', 'limit')
            ->where('end_date', '>', now())
            ->where('start_date', '<=', now());
    }

    #[Scope]
    protected function NotValid(Builder $query): Builder
    {
        return $query->where('status', 'inactive')
            ->orWhere('time_used', '>=', 'limit')
            ->orWhere('end_date', '<', now());
    }

    public function couponIsValid()
    {
        return $this->status == 'active' && $this->time_used < $this->limit && $this->end_date > now() && $this->start_date <= now();
    }

    public function status()
    {
        return $this->status == 'active' ? 'Active' : 'inActive';
    }


    /*  --------------------- Methods --------------------- */
}
