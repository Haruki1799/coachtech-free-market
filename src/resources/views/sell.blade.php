@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
<div class="container">
    <h1>商品の出品</h1>

    <form action="{{ route('goods.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="product_image">商品画像<span class="required-label">【必須】</span></label>
            <div class="product-image-section">
                <img src="{{ isset($good) && $good->image_url ? asset('storage/' . $good->image_url) : asset('images/no-image.png') }}"
                    class="product-image"
                    id="preview-image">

                <label class="image-upload-label">
                    画像を選択する
                    <input type="file" name="image" id="product_image" hidden>
                </label>
            </div>
            @if ($errors->has('image'))
            <div class="error-message">{{ $errors->first('image') }}</div>
            @endif
        </div>

        <h2 class="product_information">商品の詳細</h2>

        <div class="category-container">
            <h2 class="category-title">カテゴリー<span class="required-label">【選択必須】</span></h2>
            <div class="category-list">
                @foreach($categories as $category)
                <label class="category-tag {{ in_array($category->id, old('category_ids', [])) ? 'selected' : '' }}">
                    <input type="checkbox" name="category_ids[]" value="{{ $category->id }}" hidden
                        {{ in_array($category->id, old('category_ids', [])) ? 'checked' : '' }}>
                    {{ $category->content }}
                </label>
                @endforeach
            </div>
            @if ($errors->has('category_ids'))
            <div class="error-message">{{ $errors->first('category_ids') }}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="condition">商品の状態<span class="required-label">【必須】</span></label>
            <select name="condition" id="condition">
                <option value="">選択してください</option>
                <option value="新品" {{ old('condition') == '新品' ? 'selected' : '' }}>新品</option>
                <option value="未使用に近い" {{ old('condition') == '未使用に近い' ? 'selected' : '' }}>未使用に近い</option>
                <option value="目立った傷や汚れなし" {{ old('condition') == '目立った傷や汚れなし' ? 'selected' : '' }}>目立った傷や汚れなし</option>
                <option value="やや傷や汚れあり" {{ old('condition') == 'やや傷や汚れあり' ? 'selected' : '' }}>やや傷や汚れあり</option>
                <option value="状態が悪い" {{ old('condition') == '状態が悪い' ? 'selected' : '' }}>状態が悪い</option>
            </select>
            @if ($errors->has('condition'))
            <div class="error-message">{{ $errors->first('condition') }}</div>
            @endif
        </div>

        <h2 class="product_information">商品名と説明</h2>

        <div class="form-group">
            <label for="item">商品名<span class="required-label">【必須】</span></label>
            <input type="text" name="item" id="item" value="{{ old('item') }}">
            @if ($errors->has('item'))
            <div class="error-message">{{ $errors->first('item') }}</div>
            @endif

            <label for="brand_name">ブランド名</label>
            <input type="text" name="brand_name" id="brand_name" value="{{ old('brand_name') }}">
            @if ($errors->has('brand_name'))
            <div class="error-message">{{ $errors->first('brand_name') }}</div>
            @endif

            <label for="explanation">商品の説明<span class="required-label">【必須】</span></label>
            <textarea name="explanation" id="explanation" rows="4">{{ old('explanation') }}</textarea>
            @if ($errors->has('explanation'))
            <div class="error-message">{{ $errors->first('explanation') }}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="price">販売価格<span class="required-label">【必須】</span></label>
            <div class="price-input">
                <span>¥</span>
                <input type="number" name="price" id="price" min="0" value="{{ old('price') }}">
            </div>
            @if ($errors->has('price'))
            <div class="error-message">{{ $errors->first('price') }}</div>
            @endif
        </div>

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