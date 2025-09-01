<?php

namespace App\Http\Controllers;

use App\Models\Good;
use Illuminate\Http\Request;
use App\Http\Requests\ExhibitionRequest;

class GoodsController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab');
        $keyword = trim($request->query('keyword'));

        $query = Good::query()->withCount(['likes', 'comments']);

        if ($keyword !== '') {
            $query->where('item', 'like', "%{$keyword}%");
        }

        if ($tab === 'mylist') {
            $query->whereHas('likes', function ($q) {
                $q->where('user_id', auth()->id());
            });
        }

        $goods = $query->latest()->get();

        return view('index', compact('goods'));
    }

    public function show($id)
    {
        $good = Good::with([
            'categories',
            'likes',
            'comments.user.address'
        ])
            ->withCount(['likes', 'comments'])
            ->findOrFail($id);

        return view('show', compact('good'));
    }

    public function store(ExhibitionRequest $request)
    {
        $validated = $request->validated();

        $imagePath = $request->file('image')->store('goods', 'public');

        $good = new Good();
        $good->item = $validated['item'];
        $good->brand_name = $request->input('brand_name');
        $good->explanation = $validated['explanation'];
        $good->condition = $validated['condition'];
        $good->price = $validated['price'];
        $good->image_url = $imagePath;
        $good->user_id = auth()->id();
        $good->save();

        $good->categories()->sync($validated['category_ids']);

        return redirect()->route('home');
    }
}