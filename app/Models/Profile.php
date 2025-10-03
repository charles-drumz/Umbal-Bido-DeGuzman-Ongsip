<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'field_name',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
