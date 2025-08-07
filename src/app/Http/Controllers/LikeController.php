<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Goods;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    // いいね一覧
    public function index()
    {
        $likedGoods = Auth::user()->likedGoods;
        return view('likes.index', compact('likedGoods'));
    }

    // いいね登録
    public function store(Goods $goods)
    {
        Like::firstOrCreate([
            'user_id' => Auth::id(),
            'goods_id' => $goods->id,
        ]);

        return back()->with('success', 'いいねしました');
    }

    // いいね解除
    public function destroy(Goods $goods)
    {
        Like::where('user_id', Auth::id())
            ->where('goods_id', $goods->id)
            ->delete();

        return back()->with('success', 'いいねを解除しました');
    }
}
