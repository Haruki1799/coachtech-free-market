@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
<div class="container">
    <h2>商品の出品</h2>

    <form action="{{ route('goods.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- 商品画像 --}}
        <div class="form-group">
            <label for="image">商品画像</label>
            <input type="file" name="image" id="image">
        </div>

        {{-- カテゴリー --}}
        <div class="form-group">
            <label for="category_id">カテゴリー</label>
            <select name="category_id" id="category_id">
                <option value="">選択してください</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->content }}</option>
                @endforeach
            </select>
        </div>

        {{-- 商品の状態 --}}
        <div class="form-group">
            <label for="condition">商品の状態</label>
            <select name="condition" id="condition">
                <option value="">選択してください</option>
                <option value="新品">新品</option>
                <option value="未使用に近い">未使用に近い</option>
                <option value="目立った傷や汚れなし">目立った傷や汚れなし</option>
                <option value="やや傷や汚れあり">やや傷や汚れあり</option>
                <option value="状態が悪い">状態が悪い</option>
            </select>
        </div>

        {{-- 商品名・ブランド名・説明 --}}
        <div class="form-group">
            <label for="item">商品名</label>
            <input type="text" name="item" id="item">

            <label for="brand_name">ブランド名</label>
            <input type="text" name="brand_name" id="brand_name">

            <label for="explanation">商品の説明</label>
            <textarea name="explanation" id="explanation" rows="4"></textarea>
        </div>

        {{-- 販売価格 --}}
        <div class="form-group">
            <label for="price">販売価格</label>
            <div class="price-input">
                <span>¥</span>
                <input type="number" name="price" id="price" min="0">
            </div>
        </div>

        {{-- 出品ボタン --}}
        <div class="form-group">
            <button type="submit" class="submit-button">出品する</button>
        </div>
    </form>
</div>
@endsection