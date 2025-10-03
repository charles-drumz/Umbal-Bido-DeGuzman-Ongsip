<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'email',
        'password',
        'bio',      // ✅ added bio
        'avatar',   // ✅ added avatar
        'address',  // ✅ added address
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function tasks()
    {
        return $this->hasMany(\App\Models\Task::class);
    }

    public function profile()
    {
        return $this->hasOne(\App\Models\Profile::class);
    }

    // Add this for posts relationship
    public function posts()
    {
        return $this->hasMany(\App\Models\Post::class);
    }
}
