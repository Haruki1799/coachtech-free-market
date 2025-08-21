<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Good;

class SellController extends Controller
{
    public function index()
    {
        $goods = Good::all();
        return view('sell', compact('goods'));
    }
    public function show($id)
    {
        $good = Good::findOrFail($id);
        return view('sell', compact('good'));
    }
}
