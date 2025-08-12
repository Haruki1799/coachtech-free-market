@extends('layouts.app')

@section('content')
{{-- CSSの読み込み --}}
<link rel="stylesheet" href="{{ asset('css/address_edit.css') }}">

<div class="container">
    <h2>住所の変更</h2>

    <form method="POST" action="{{ route('address.update.item', ['item_id' => $goods->id]) }}">
        @csrf

        <div class="form-group">
            <label for="post_code">郵便番号</label>
            <input type="text" name="post_code" id="post_code" class="form-control"
                value="{{ old('post_code') }}" required>
        </div>

        <div class="form-group">
            <label for="address">住所</label>
            <input type="text" name="address" id="address" class="form-control"
                value="{{ old('address') }}" required>
        </div>

        <div class="form-group">
            <label for="building">建物名</label>
            <input type="text" name="building" id="building" class="form-control"
                value="{{ old('building') }}">
        </div>

        <button type="submit" class="btn btn-danger">更新する</button>
    </form>
</div>
@endsection