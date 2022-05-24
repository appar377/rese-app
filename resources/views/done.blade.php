@extends('layouts.default')

@section('pageCss')
<link rel="stylesheet" href="{{ asset('css/done.css')}}">
@endsection

@section('content')

<div class="container">
  <header>
    <x-menu />
  </header>
  <div class="text__box">
    <p class="reserve__message">ご予約ありがとうございます</p>
    <a class="turn__link" href="/">戻る</a>
  </div>
</div>
@endsection