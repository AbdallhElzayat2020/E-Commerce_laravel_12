<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Slider extends Model
{
    use HasTranslations;

    protected $fillable = [
        'file_name',
        'note',
    ];

    public array $translatable = ['note'];
    protected $table = 'sliders';


    /*  ============= Methods =============  */
    public function getFileNameAttribute($file_name)
    {
        return 'uploads/sliders/' . $file_name;
    }

    public function getCreatedAtAttribute()
    {
        return date('d/m/y H:i', strtotime($this->attributes['created_at']));
    }
}
