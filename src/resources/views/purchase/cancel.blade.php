@extends('layouts.app')

@section('content')
<h2>決済がキャンセルされました</h2>
<p>お支払いは完了していません。もう一度お試しください。</p>
<a href="{{ route('home') }}" class="btn btn-primary">トップに戻る</a>
@endsection