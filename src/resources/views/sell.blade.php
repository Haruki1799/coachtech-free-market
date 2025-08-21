@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
<div class="container">
    <h1>商品の出品</h1>

    <form action="{{ route('goods.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- 商品画像 --}}
        <div class="form-group">
            <label for="product_image">商品画像</label>
            <div class="product-image-section">
                <img src="{{ isset($good) && $good->image_url ? asset('storage/' . $good->image_url) : asset('images/no-image.png') }}"
                    class="product-image"
                    id="preview-image">

                <label class="image-upload-label">
                    画像を選択する
                    <input type="file" name="image" id="product_image" hidden>
                </label>
            </div>
        </div>

        <h2 class="product_information">商品の詳細</h2>

        {{-- カテゴリー（複数選択） --}}
        <div class="category-container">
            <h2 class="category-title">カテゴリー</h2>
            <div class="category-list">
                @foreach($categories as $category)
                <label class="category-tag {{ in_array($category->id, old('category_ids', [])) ? 'selected' : '' }}">
                    <input type="checkbox" name="category_ids[]" value="{{ $category->id }}" hidden
                        {{ in_array($category->id, old('category_ids', [])) ? 'checked' : '' }}>
                    {{ $category->content }}
                </label>
                @endforeach
            </div>
        </div>

        {{-- 商品の状態 --}}
        <div class="form-group">
            <label for="condition">商品の状態</label>
            <select name="condition" id="condition">
                <option value="">選択してください</option>
                <option value="新品" {{ old('condition') == '新品' ? 'selected' : '' }}>新品</option>
                <option value="未使用に近い" {{ old('condition') == '未使用に近い' ? 'selected' : '' }}>未使用に近い</option>
                <option value="目立った傷や汚れなし" {{ old('condition') == '目立った傷や汚れなし' ? 'selected' : '' }}>目立った傷や汚れなし</option>
                <option value="やや傷や汚れあり" {{ old('condition') == 'やや傷や汚れあり' ? 'selected' : '' }}>やや傷や汚れあり</option>
                <option value="状態が悪い" {{ old('condition') == '状態が悪い' ? 'selected' : '' }}>状態が悪い</option>
            </select>
        </div>

        <h2 class="product_information">商品名と説明</h2>

        {{-- 商品名・ブランド名・説明 --}}
        <div class="form-group">
            <label for="item">商品名</label>
            <input type="text" name="item" id="item" value="{{ old('item') }}">

            <label for="brand_name">ブランド名</label>
            <input type="text" name="brand_name" id="brand_name" value="{{ old('brand_name') }}">

            <label for="explanation">商品の説明</label>
            <textarea name="explanation" id="explanation" rows="4">{{ old('explanation') }}</textarea>
        </div>

        {{-- 販売価格 --}}
        <div class="form-group">
            <label for="price">販売価格</label>
            <div class="price-input">
                <span>¥</span>
                <input type="number" name="price" id="price" min="0" value="{{ old('price') }}">
            </div>
        </div>

        {{-- 出品ボタン --}}
        <div class="form-group">
            <button type="submit" class="submit-button">出品する</button>
        </div>
    </form>
</div>
@endsection

@section('js')
<script>
    document.getElementById('product_image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('preview-image').src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>

<script>
    document.querySelectorAll('.category-tag').forEach(tag => {
        tag.addEventListener('click', () => {
            const checkbox = tag.querySelector('input[type="checkbox"]');
            checkbox.checked = !checkbox.checked;
            tag.classList.toggle('selected', checkbox.checked);
        });
    });
</script>
@endsection