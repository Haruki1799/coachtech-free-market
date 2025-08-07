<?php

namespace App\Http\Controllers;
use App\Models\Goods;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->query('page');

        if ($page === 'mylist') {
            // ログインユーザーの商品だけを取得
            $goods = Goods::where('user_id', auth()->id())->get();
        } else {
            // デフォルト：全商品を取得
            $goods = Goods::all();
        }

        return view('dashboard.index', compact('goods', 'page'));
    }

}
