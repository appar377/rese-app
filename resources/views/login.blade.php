@extends('layouts.default')

@section('pageCss')
<link rel="stylesheet" href="{{ mix('css/login.css') }}">
@endsection

@section('content')
<div class="container">
  <form class="login__form" action="login" method="POST">
    @csrf
    <p class="form__ttl">Login</p>
    <div class="input__box">
      <div class="email__box">
        <div class="email__img">
          <img src="{{ asset('img/email.svg') }}" alt="">
        </div>
        <input class="email" type="email" name="email" placeholder="Email">
      </div>

      @if ($errors->has('email'))
        <p>{{ $errors->first('email') }}</p>
        @endif

      <div class="password__box">
        <div class="password__img">
          <img src="{{ asset('img/password.svg') }}" alt="">
        </div>
        <input class="password" type="password" name="password" placeholder="Password">
      </div>

      @if ($errors->has('password'))
        <p>{{ $errors->first('password') }}</p>
      @endif

      <button class="login__btn">ログイン</button>
    </div>
  </form>
</div>
@endsection