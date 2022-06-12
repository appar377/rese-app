@extends('layouts.default')

@section('pageCss')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="container">
  <div class="text__box">
    <p class="register__message">確認メールを送信しました。</p>
  </div>
</div>
@endsection