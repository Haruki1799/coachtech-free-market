<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Good;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        $good = new Good();
        return view('sell', compact('categories', 'good'));
    }

    public function search(Request $request)
    {
        $keyword = trim($request->input('keyword'));
        $page = $request->input('page');

        $query = Good::query();

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