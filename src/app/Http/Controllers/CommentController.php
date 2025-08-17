<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use App\Models\Comment;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(CommentRequest $request, Goods $goods)
    {
        Comment::create([
            'goods_id' => $goods->id,
            'user_id' => auth()->id(),
            'body' => $request->body,
        ]);

        return back()->with('success', 'コメントを投稿しました');
    }
}
