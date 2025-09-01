@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

@if(request('keyword'))
<div class="tabs">
    <a href="{{ route('search', ['tab' => null, 'keyword' => request('keyword')]) }}"
        class="tab {{ request('tab') !== 'mylist' ? 'active' : '' }}">おすすめ</a>

    <a href="{{ route('search', ['tab' => 'mylist', 'keyword' => request('keyword')]) }}"
        class="tab {{ request('tab') === 'mylist' ? 'active' : '' }}">マイリスト</a>
</div>
@else
<div class="tabs">
    <a href="{{ route('home') }}"
        class="tab {{ request('tab') !== 'mylist' ? 'active' : '' }}">おすすめ</a>

    <a href="{{ route('home', ['tab' => 'mylist']) }}"
        class="tab {{ request('tab') === 'mylist' ? 'active' : '' }}">マイリスト</a>
</div>
@endif

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