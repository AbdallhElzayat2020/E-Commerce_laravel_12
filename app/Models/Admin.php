<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admins';
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'status',
        'role_id',
        'remember_token',
    ];


    public function hasAccess($config_permission)
    {
        $role = $this->role;
        if (!$role) {
            return false;
        }

        $permissions = $role->permissions;

        // Normalize to array if stored as JSON string
        if (is_string($permissions)) {
            $decoded = json_decode($permissions, true);
            $permissions = is_array($decoded) ? $decoded : [];
        }

        if (!is_array($permissions)) {
            return false;
        }

        return in_array($config_permission, $permissions, true);
    }

    /* ============== Relationships ============== */

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
