@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage_profile.css') }}">
@endsection

@section('content')
<div class="mypage-form__content">
    <div class="mypage-form__heading">
        <h2>プロフィール設定</h2>
    </div>

    <form class="form" action="/mypage/profile" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form__group">
            <div class="profile-image-section">
                <div class="profile-image-wrapper">
                    <img src="{{ asset('storage/' . optional($user->address)->profile_image) }}"
                        alt="プロフィール画像"
                        class="profile-image"
                        id="preview-image">
                </div>

                <label class="image-upload-label">
                    画像を選択する
                    <input type="file" name="profile_image" id="profile_image" hidden>
                </label>
            </div>

            <div class="form__group-title">
                <span class="form__label--item">ユーザー名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" />
                </div>
                <div class="form__error">
                    @error('name') {{ $message }} @enderror
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">郵便番号</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="post_code" value="{{ old('post_code', $address->post_code ?? '') }}" />
                </div>
                <div class="form__error">
                    @error('post_code') {{ $message }} @enderror
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="address" value="{{ old('address', $address->address ?? '') }}" />
                </div>
                <div class="form__error">
                    @error('address') {{ $message }} @enderror
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">建物名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="building" value="{{ old('building', $address->building ?? '') }}" />
                </div>
            </div>
        </div>

        <div class="form__button">
            <button class="form__button-submit" type="submit">更新する</button>
        </div>
    </form>
</div>
@endsection

@section('js')
<script>
    document.getElementById('profile_image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('preview-image').src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection