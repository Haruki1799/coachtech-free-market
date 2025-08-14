@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<form action="{{ route('purchase.store', ['item_id' => $goods->id]) }}" method="POST" novalidate>
    @csrf

    <div class="purchase-page">
        <div class="purchase-left">
            <div class="product-section">
                <div class="product-image">
                    <img src="{{ $goods->image_url ?? '/images/placeholder.png' }}" alt="商品画像">
                </div>

                <div class="product-info">
                    <h2 class="product-name">{{ $goods->item }}</h2>
                    <p class="product-price">¥{{ number_format($goods->price) }}</p>
                </div>
            </div>

            <div class="product-meta">
                <div class="form-group payment-section">
                    <label for="payment">支払い方法</label>
                    <select name="payment" id="payment" required>
                        <option value="" disabled selected>選択してください</option>
                        <option value="convenience">コンビニ支払い</option>
                        <option value="credit">カード支払い</option>
                    </select>
                    <div class="form__error">
                        @error('payment')
                        {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="form-group delivery-section">
                    <label for="address">配達先</label>
                    <div class="address-display">
                        @php
                        $temp = session('temp_address');
                        $address = $temp ?? Auth::user()->address;
                        @endphp

                        @if($address)
                        <div class="address-line">
                            <span class="address-label">〒</span>
                            <span class="address-value">{{ $address['post_code'] ?? $address->post_code }}</span>
                            <a href="{{ route('address.edit.item', ['item_id' => $goods->id]) }}" class="change-address-inline">住所変更</a>
                        </div>
                        <div class="address-line">
                            <span class="address-label">住所</span>
                            <span class="address-value">
                                {{ $address['address'] ?? $address->address }}
                                {{ $address['building'] ?? $address->building ?? '' }}
                            </span>
                        </div>
                        @else
                        <div class="form__error">
                            @error('post_code')
                            {{ $message }}
                            @enderror

                            @error('address')
                            {{ $message }}
                            @enderror

                            @error('building')
                            {{ $message }}
                            @enderror
                        </div>
                        <a href="{{ route('address.edit.item', ['item_id' => $goods->id]) }}" class="change-address-inline">住所変更</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="purchase-right">
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
</form>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paymentSelect = document.getElementById('payment');
        const summaryPayment = document.getElementById('summary-payment');

        paymentSelect.addEventListener('change', function() {
            const selectedText = this.options[this.selectedIndex].text;
            summaryPayment.textContent = selectedText;
        });
    });
</script>
@endsection