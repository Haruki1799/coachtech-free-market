@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<div class="purchase-page">
    <div class="purchase-left">
        <div class="product-image">
            <img src="{{ $goods->image_url ?? '/images/placeholder.png' }}" alt="商品画像">
        </div>

        <div class="product-details">
            <h2 class="product-name">{{ $goods->item }}</h2>
            <p class="product-price">¥{{ number_format($goods->price) }}</p>

            <form action="{{ route('purchase.store', ['item_id' => $goods->id]) }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="payment">支払い方法</label>
                    <select name="payment" id="payment" required>
                        <option value="" disabled selected>選択してください</option>
                        <option value="convenience">コンビニ支払い</option>
                        <option value="credit">カード支払い</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="address">配送先</label>
                    <div class="address-display">
                        {{ Auth::user()->address ?? '住所が未登録です' }}
                    </div>
                    <a href="{{ route('mypage_profile') }}" class="change-address">変更する</a>
                </div>

            </form>
        </div>
    </div>

    <div class="purchase-summary">
        <table class="summary-table">
            <tr>
                <td>商品代金</td>
                <td>¥{{ number_format($goods->price) }}</td>
            </tr>
            <tr>
                <td>支払い方法</td>
                <td id="summary-payment">未選択</td>
            </tr>
        </table>

        <button type="submit" class="purchase-button">購入する</button>
    </div>
</div>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paymentSelect = document.getElementById('payment');
        const summaryPayment = document.getElementById('summary-payment');

        paymentSelect.addEventListener('change', function() {
            const selectedText = this.options[this.selectedIndex].text;
            summaryPayment.textContent = '支払い方法: ' + selectedText;
        });
    });
</script>
@endsection