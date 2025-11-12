<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class FaqQuestion extends Model
{


    public function fetCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/y H:i');
    }
}
