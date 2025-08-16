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

        <div class="like-section">
            @auth
            @if($goods->likes->contains('user_id', auth()->id()))
            <form action="{{ route('likes.destroy', $goods->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="like-btn liked">⭐️</button>
            </form>
            @else
            <form action="{{ route('likes.store', $goods->id) }}" method="POST">
                @csrf
                <button type="submit" class="like-btn">☆</button>
            </form>
            @endif
            @else
            <button type="button" class="like-btn disabled-btn" disabled>☆</button>
            @endauth

            <div class="like-count">{{ $goods->likes_count }}</div>
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
                <h3>コメント (1)</h3>
                <div class="comment">
                    <strong>admin:</strong>
                </div>
                <form class="comment-form">
                    <textarea placeholder="商品のコメント"></textarea>
                    <button type="submit">コメントを送信する</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection