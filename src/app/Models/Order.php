<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'goods_id',
        'payment_method',
        'post_code',
        'address',
        'building',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function good()
    {
        return $this->belongsTo(Good::class);
    }
    
    public function goods()
    {
        return $this->belongsTo(Good::class, 'goods_id');
    }
}
