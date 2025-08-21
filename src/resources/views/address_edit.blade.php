@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/address_edit.css') }}">
@endsection

@section('content')
<div class="container">
    <h2>住所の変更</h2>

    <form method="POST" action="{{ route('address.update.item', ['item_id' => $good->id]) }}">
        @csrf

        <div class="form-group">
            <label for="post_code">郵便番号</label>
            <input type="text" name="post_code" id="post_code" class="form-control"
                value="{{ old('post_code') }}" required>
            @error('post_code')
            <div class="form__error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="address">住所</label>
            <input type="text" name="address" id="address" class="form-control"
                value="{{ old('address') }}" required>
            @error('address')
            <div class="form__error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="building">建物名</label>
            <input type="text" name="building" id="building" class="form-control"
                value="{{ old('building') }}">
            @error('building')
            <div class="form__error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-danger">更新する</button>
    </form>
</div>
@endsection