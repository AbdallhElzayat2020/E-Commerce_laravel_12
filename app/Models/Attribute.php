<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Attribute extends Model
{
    use HasTranslations;

    public array $translatable = ['name'];

    protected $table = 'attributes';

    protected $fillable = ['name'];

    /* ------------------- Relationships ----------------- */

    public function attributeValues(): HasMany
    {
        return $this->hasMany(AttributeValue::class, 'attribute_id');
    }
}
