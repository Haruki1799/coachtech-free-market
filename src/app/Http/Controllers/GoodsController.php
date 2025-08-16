<?php

namespace App\Http\Controllers;
use App\Models\Goods;

use Illuminate\Http\Request;

class GoodsController extends Controller
{

    public function index()
    {
        if (request('page') === 'mylist') {
            $goods = Goods::whereHas('likes', function ($q) {
                $q->where('user_id', auth()->id());
            })
                ->withCount('likes')
                ->latest()
                ->get();
        } else {
            $goods = Goods::withCount('likes')
                ->latest()
                ->get();
        }

        return view('index', compact('goods'));
    }

    public function show($id)
    {
        $goods = Goods::with(['category', 'likes'])
                        ->withCount('likes')
                        ->findOrFail($id);

        return view('show', compact('goods'));
    }
}
