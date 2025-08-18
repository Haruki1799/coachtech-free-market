<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Goods;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('sell', compact('categories'));
    }

    public function search(Request $request)
    {
        $keyword = trim($request->input('keyword'));
        $page = $request->input('page');

        $query = Goods::query();

        if ($keyword !== '') {
            $query->where('item', 'like', "%{$keyword}%");
        }

        if ($page === 'mylist') {
            $query->whereHas('likes', function ($q) {
                $q->where('user_id', auth()->id());
            });
        }

        $goods = $query->latest()->get();

        return view('index', compact('goods'));
    }
}
