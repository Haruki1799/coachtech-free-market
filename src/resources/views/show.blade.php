@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
<div class="product-page">
    <div class="product-left">
        <img src="{{ $goods->image_url ?? 'placeholder.jpg' }}" alt="商品画像">
    </div>

    <div class="product-right">
        <h1>{{ $goods->item }}</h1>
        <p class="brand">{{ $goods->brand_name }}</p>
        <p class="price">¥{{ number_format($goods->price) }} <span>税込</span></p>

        <div class="reaction-section">
            <div class="reaction-block">
                @auth
                @if($goods->likes->contains('user_id', auth()->id()))
                <form action="{{ route('likes.destroy', $goods->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="reaction-icon liked">⭐️</button>
                </form>
                @else
                <form action="{{ route('likes.store', $goods->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="reaction-icon">☆</button>
                </form>
                @endif
                @else
                <button type="button" class="reaction-icon disabled-btn" disabled>☆</button>
                @endauth
                <div class="reaction-count">{{ $goods->likes_count }}</div>
            </div>

            <div class="reaction-block">
                <div class="reaction-icon">💬</div>
                <div class="reaction-count">{{ $goods->comments_count }}</div>
            </div>
        </div>

        <a href="{{ route('purchase.show', ['id' => $goods->id]) }}" class="purchase-btn">
            購入手続きへ
        </a>

        <div class="description">
            <h3>商品説明</h3>
            <div class="explanation">{{ $goods->explanation }}</div>
        </div>

        <div class="info">
            <h3>商品の情報</h3>
            <div class="category-row">
                <div class="category-label">カテゴリー：</div>
                <div class="category-name">{{ $goods->category->content }}</div>
            </div>

            <div class="condition-row">
                <div class="condition-label">商品の状態：</div>
                <div class="condition-name">{{ $goods->condition }}</div>
            </div>

            <div class="comments">
                <h3>コメント ({{ $goods->comments_count }})</h3>

                @foreach($goods->comments as $comment)
                <div class="comment-block">
                    <div class="comment-header">
                        <img src="{{ asset('storage/' . optional($comment->user->address)->profile_image) }}"
                            alt="プロフィール画像"
                            class="profile-img">
                        <span class="username">{{ $comment->user->name }}</span>
                    </div>
                    <div class="comment-body">
                        {{ $comment->body }}
                    </div>
                </div>
                @endforeach

                <h3>商品へのコメント</h3>
                <form action="{{ route('comments.store', $goods->id) }}" class="comment-form" method="POST">
                    @csrf
                    <textarea name="body" required>{{ old('body') }}</textarea>
                    <button type="submit">コメントを送信する</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection