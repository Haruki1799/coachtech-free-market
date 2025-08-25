@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
<div class="product-page">
    <div class="product-left">
        @if(Str::startsWith($good->image_url, 'http'))
        <img src="{{ $good->image_url }}" alt="{{ $good->item }}">
        @else
        <img src="{{ asset('storage/' . $good->image_url) }}" alt="{{ $good->item }}">
        @endif
    </div>

    <div class="product-right">
        <h1>{{ $good->item }}</h1>
        <p class="brand">{{ $good->brand_name }}</p>
        <p class="price">¥{{ number_format($good->price) }} <span>税込</span></p>

        <div class="reaction-section">
            <div class="reaction-block">
                @auth
                @if($good->likes->contains('user_id', auth()->id()))
                <form action="{{ route('likes.destroy', $good->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="reaction-icon liked">⭐️</button>
                </form>
                @else
                <form action="{{ route('likes.store', $good->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="reaction-icon">☆</button>
                </form>
                @endif
                @else
                <button type="button" class="reaction-icon disabled-btn" disabled>☆</button>
                @endauth
                <div class="reaction-count">{{ $good->likes_count }}</div>
            </div>

            <div class="reaction-block">
                <div class="reaction-icon">💬</div>
                <div class="reaction-count">{{ $good->comments_count }}</div>
            </div>
        </div>

        <a href="{{ route('purchase.show', ['id' => $good->id]) }}" class="purchase-btn">
            購入手続きへ
        </a>

        <div class="description">
            <h3>商品説明</h3>
            <div class="explanation">{{ $good->explanation }}</div>
        </div>

        <div class="info">
            <h3>商品の情報</h3>
            <div class="category-row">
                <div class="category-label">カテゴリー：</div>
                <div class="category-name">
                    @foreach($good->categories as $category)
                    <span class="category-tag">{{ $category->content }}</span>
                    @endforeach
                </div>
            </div>

            <div class="condition-row">
                <div class="condition-label">商品の状態：</div>
                <div class="condition-name">{{ $good->condition }}</div>
            </div>

            <div class="comments">
                <h3>コメント ({{ $good->comments_count }})</h3>

                @foreach($good->comments as $comment)
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
                <form action="{{ route('comments.store', $good->id) }}" class="comment-form" method="POST">
                    @csrf
                    <textarea name="body" required>{{ old('body') }}</textarea>
                    <button type="submit">コメントを送信する</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection