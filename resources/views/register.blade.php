@extends('layouts.default')

@section('pageCss')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="container">
  <form class="register__form" action="/register" method="POST">
    @csrf
    <p class="form__ttl">Registration</p>
    <div class="input__box">
      <div class="name__box">
        <div class="person__img">
          <img src="{{ asset('img/person.svg') }}" alt="">
        </div>
        <input class="name" type="text" name="name" placeholder="Username">
      </div>

      @if ($errors->has('name'))
        <p>{{ $errors->first('name') }}</p>
      @endif

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
        <p>{{$errors->first('password')}}</p>
      @endif

      <div class="password__box">
        <div class="password__img">
          <img src="{{ asset('img/password.svg') }}" alt="">
        </div>
        <input class="password" type="password" name="password_confirmation" placeholder="Password Confirm">
      </div>

      <button class="register__btn">登録</button>
    </div>
  </form>
</div>
@endsection