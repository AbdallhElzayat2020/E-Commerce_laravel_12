<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use Sluggable, HasTranslations;

    protected $table = 'pages';
    protected $fillable = ['title', 'slug', 'content', 'image'];

    public array $translatable = ['title', 'content'];


    // sluggable dynamic
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    /**====================== Methods and Functions ====================== */

    public function getCreatedAtAttribute()
    {
        return date('d/m/y H:i', strtotime($this->attributes['created_at']));
    }

//    public function getImageAttribute($value)
//    {
//        return asset('uploads/pages/' . $value);
//    }
}
