<?php

namespace App\Http\Controllers;
use App\Models\Goods;

use Illuminate\Http\Request;

class GoodsController extends Controller
{

    public function index()
    {
        $goods = Goods::all(); // すべての商品を取得
        return view('index', compact('goods'));
    }

    public function show($id)
    {
        $goods = Goods::with('category')->findOrFail($id);
        return view('show', compact('goods'));
    }
}
