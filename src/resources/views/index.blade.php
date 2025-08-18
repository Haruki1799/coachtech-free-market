@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

@if(request('keyword'))
<div class="tabs">
    <a href="{{ route('search', ['page' => null, 'keyword' => request('keyword')]) }}"
        class="tab {{ request('page') !== 'mylist' ? 'active' : '' }}">おすすめ</a>

    <a href="{{ route('search', ['page' => 'mylist', 'keyword' => request('keyword')]) }}"
        class="tab {{ request('page') === 'mylist' ? 'active' : '' }}">マイリスト</a>
</div>
@else
<div class="tabs">
    <a href="{{ route('home') }}"
        class="tab {{ request('page') !== 'mylist' ? 'active' : '' }}">おすすめ</a>

    <a href="{{ route('home', ['page' => 'mylist']) }}"
        class="tab {{ request('page') === 'mylist' ? 'active' : '' }}">マイリスト</a>
</div>
@endif

<div class="goods-list">
    @foreach($goods as $item)
    <div class="goods-card">
        <a href="{{ route('goods.show', $item->id) }}">
            <div class="goods-image">
                <img src="{{ $item->image_url }}" alt="{{ $item->item }}">
                @if($item->isSold())
                <div class="sold-label">SOLD</div>
                @endif
            </div>
            <div class="goods-name">{{ $item->item }}</div>
        </a>
    </div>
    @endforeach
</div>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('search-input');
        if (!input) return;

        input.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();

                const keyword = input.value.trim();
                let targetUrl = `{{ route('home') }}`;

                if (keyword !== '') {
                    targetUrl = `{{ route('search') }}?keyword=${encodeURIComponent(keyword)}`;
                }

                window.location.href = targetUrl;
            }
        });
    });
</script>
@endsection