<?php

namespace App\Http\Controllers;

use App\Models\Good;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Good $good)
    {
        $good->likes()->firstOrCreate([
            'user_id' => auth()->id(),
        ]);

        return back();
    }

    public function destroy(Good $good)
    {
        $good->likes()->where('user_id', auth()->id())->delete();

        return back();
    }
}
