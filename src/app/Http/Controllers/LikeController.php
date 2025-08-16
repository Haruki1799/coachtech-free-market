<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Goods $goods)
    {
        $goods->likes()->firstOrCreate([
            'user_id' => auth()->id(),
        ]);

        return back();
    }

    public function destroy(Goods $goods)
    {
        $goods->likes()->where('user_id', auth()->id())->delete();

        return back();
    }
}
