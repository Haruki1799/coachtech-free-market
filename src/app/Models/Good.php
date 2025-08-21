<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item',
        'brand_name',
        'price',
        'explanation',
        'image_url',
        'condition',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'goods_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'goods_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_good', 'goods_id', 'category_id');
    }

    public function getIsSoldAttribute()
    {
        return $this->attributes['is_sold'];
    }
    public function isSold(): bool
    {
        return (bool) $this->is_sold;
    }
}