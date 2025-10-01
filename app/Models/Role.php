<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Role extends Model
{
    use HasTranslations;

    public array $translatable = ['name'];

    protected $fillable = [
        'name',
        'permissions',
        'status',
    ];

    protected $casts = [
        'permissions' => 'array',
    ];

    /* ============== Relationships ============== */
    public function admins(): HasMany
    {
        return $this->hasMany(Admin::class, 'role_id');
    }
}
