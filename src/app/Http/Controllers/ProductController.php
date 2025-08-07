<?php

namespace App\Http\Controllers;
use App\Models\Category;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create()
    {
        $categories = Category::all(); // カテゴリ一覧を取得
        return view('sell', compact('categories'));
    }
}
