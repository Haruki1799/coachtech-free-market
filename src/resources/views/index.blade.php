@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="tabs">
    <a href="{{ route('home') }}" class="tab {{ request('page') !== 'mylist' ? 'active' : '' }}">おすすめ</a>
    <a href="{{ route('home', ['page' => 'mylist']) }}" class="tab {{ request('page') === 'mylist' ? 'active' : '' }}">マイリスト</a>
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