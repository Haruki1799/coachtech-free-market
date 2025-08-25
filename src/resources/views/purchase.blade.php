@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<form action="{{ route('purchase.store', $good->id) }}" method="POST" novalidate>
    @csrf

    <div class="purchase-page">
        <div class="purchase-left">
            <div class="product-section">
                <div class="product-image">
                    @if(Str::startsWith($good->image_url, 'http'))
                    <img src="{{ $good->image_url }}" alt="{{ $good->item }}">
                    @else
                    <img src="{{ asset('storage/' . $good->image_url) }}" alt="{{ $good->item }}">
                    @endif
                </div>

                <div class="product-info">
                    <h2 class="product-name">{{ $good->item }}</h2>
                    <p class="product-price">¥{{ number_format($good->price) }}</p>
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
                    @error('payment')
                    <div class="form__error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group delivery-section">
                    <label for="address">配達先</label>
                    <div class="address-display">
                        @php
                        $temp = session('temp_address');
                        $address = $temp ?? Auth::user()->address;
                        $post_code = $address['post_code'] ?? $address->post_code ?? '';
                        $main_address = $address['address'] ?? $address->address ?? '';
                        $building = $address['building'] ?? $address->building ?? '';
                        @endphp

                        @if($post_code && $main_address)
                        <div class="address-line">
                            <span class="address-label">〒</span>
                            <span class="address-value">{{ $post_code }}</span>
                            <a href="{{ route('address.edit.item', ['item_id' => $good->id]) }}" class="change-address-inline">住所変更</a>
                        </div>
                        <div class="address-line">
                            <span class="address-label">住所</span>
                            <span class="address-value">
                                {{ $main_address }}
                                @if(!empty($building))
                                {{ $building }}
                                @endif
                            </span>
                        </div>

                        <input type="hidden" name="post_code" value="{{ $post_code }}">
                        <input type="hidden" name="address" value="{{ $main_address }}">
                        <input type="hidden" name="building" value="{{ $building }}">
                        @else
                        <div class="form__error">
                            @error('post_code') {{ $message }} @enderror
                            @error('address') {{ $message }} @enderror
                        </div>
                        <a href="{{ route('address.edit.item', ['item_id' => $good->id]) }}" class="change-address-inline">住所変更</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="purchase-right">
            <table class="summary-table">
                <tr>
                    <td>商品代金</td>
                    <td>¥{{ number_format($good->price) }}</td>
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