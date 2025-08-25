@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')

<div class="profile-section">
    <div class="profile-image-wrapper">
        <img src="{{ asset('storage/' . optional($user->address)->profile_image) }}"
            alt="プロフィール画像"
            class="profile-image"
            id="preview-image">
    </div>

    <h2 class="username">{{ Auth::user()->name }}</h2>
    <a href="{{ route('address.edit.profile') }}" class="edit-button">プロフィールを編集</a>
</div>

<div class="tabs">
    <a href="{{ route('mypage') }}" class="tab {{ request('page') !== 'mylist' ? 'active' : '' }}">出品した商品</a>
    <a href="{{ route('mypage', ['page' => 'mylist']) }}" class="tab {{ request('page') === 'mylist' ? 'active' : '' }}">購入した商品</a>
</div>


<div class="goods-list">
    @foreach($goods as $good)
    <div class="goods-card">
        <a href="{{ route('goods.show', $good->id) }}">
            <div class="goods-image">
                @if(Str::startsWith($good->image_url, 'http'))
                <img src="{{ $good->image_url }}" alt="{{ $good->item }}">
                @else
                <img src="{{ asset('storage/' . $good->image_url) }}" alt="{{ $good->item }}">
                @endif

                @if($good->isSold())
                <div class="sold-label">SOLD</div>
                @endif
            </div>
            <div class="goods-name">{{ $good->item }}</div>
        </a>
    </div>
    @endforeach
</div>
@endsection