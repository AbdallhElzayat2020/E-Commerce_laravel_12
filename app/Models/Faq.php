<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Faq extends Model
{
    use HasTranslations, HasFactory;

    public array $translatable = ['question', 'answer'];

    protected $table = 'faqs';
    protected $fillable = [
        'question',
        'answer',
        'status',
    ];
}
