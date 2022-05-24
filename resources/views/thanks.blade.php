@extends('layouts.default')

@section('pageCss')
<link rel="stylesheet" href="{{ asset('css/thanks.css')}}">
@endsection

@section('content')
<div class="container">
  <header>
    <x-menu />
  </header>

  <div class="text__box">
    <p class="register__message">会員登録ありがとうございます</p>
    <a class="login__link" href="/login">ログインする</a>
  </div>
</div>
@endsection