<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $fillable = [
        'user_id',
        'item',
        'brand_name',
        'price',
        'explanation',
        'image_url',
        'condition',
        'categories_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function isSold()
    {
        return $this->is_sold;
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'goods_id');
    }
}
