<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['id', 'name', 'email', 'phone', 'subject', 'message', 'user_id'];


    // Scopes
    public function scopeRead($query)
    {
        return $query->where('is_read', 1);
    }

    public function scopeUnread($query)
    {
        return $query->where('is_read', 0);
    }

    public function scopeAnswered($query)
    {
        return $query->where('replay_status', 1);
    }

    public function scopeUnanswered($query)
    {
        return $query->where('replay_status', 0);
    }

    public static function searchContact($keyword)
    {
        return self::when($keyword, function ($query) use ($keyword) {
            $query->Where('email', 'like', '%' . $keyword . '%');
        });
    }

    // relationship with user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // accessor for created at an d updated at
    public function getUpdatedAtAttribute($value)
    {
        return date('d-m-Y H:i:s a', strtotime($value));
    }
}
