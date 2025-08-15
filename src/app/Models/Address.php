<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id',
        'user_name',
        'post_code',
        'address',
        'building',
        'profile_image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}