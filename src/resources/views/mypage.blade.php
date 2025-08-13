@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')

<div class="profile-section">
    <img src="{{ asset('storage/' . optional($user->address)->profile_image) }}" alt="プロフィール画像">
    alt="プロフィール画像"
    class="profile-image">
    <h2 class="username">{{ Auth::user()->name }}</h2>
    <a href="{{ route('address.edit.profile') }}" class="edit-button">プロフィールを編集</a>
</div>

<div class="tabs">
    <a href="{{ route('mypage') }}" class="tab {{ request('page') !== 'mylist' ? 'active' : '' }}">出品した商品</a>
    <a href="{{ route('mypage', ['page' => 'mylist']) }}" class="tab {{ request('page') === 'mylist' ? 'active' : '' }}">購入した商品</a>
</div>


<div class="goods-list">
    @foreach($goods as $item)
    <div class="goods-card">
        <a href="{{ route('goods.show', $item->id) }}">
            <div class="goods-image"><img src="{{ $item->image_url }}" alt="{{ $item->item }}"></div>
            <div class="goods-name">{{ $item->item }}</div>
        </a>
    </div>
    @endforeach
</div>
@endsection