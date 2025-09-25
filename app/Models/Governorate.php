<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    protected $table = 'governorates';
    protected $fillable = [
        'name',
        'country_id',
    ];
}
