<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class AttributeValue extends Model
{
    use HasTranslations;

    public array $translatable = ['value'];

    protected $table = 'attribute_values';

    protected $fillable = ['attribute_id', 'value'];


    /* ------------------- Relationships ----------------- */
    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class);
    }

}
