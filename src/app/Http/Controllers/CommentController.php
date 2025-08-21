<?php

namespace App\Http\Controllers;

use App\Models\Good;
use App\Models\Comment;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(CommentRequest $request, Good $good)
    {
        Comment::create([
            'goods_id' => $good->id,
            'user_id' => auth()->id(),
            'body' => $request->body,
        ]);

        return back()->with('success', 'コメントを投稿しました');
    }
}
