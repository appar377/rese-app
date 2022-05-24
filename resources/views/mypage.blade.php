@extends('layouts.default')

@section('pageCss')
<link rel="stylesheet" href="{{ asset('css/mypage.css')}}">
@endsection

@section('content')
<header class="header">
  <x-menu />
</header>

<h1 class="user__name">{{Auth::user()->name}}さん</h1>

<div class="mypage__container">
  <div class="my__reserve">
    <h2 class="reserve__ttl">予約状況</h2>
    <ul class="reserve__list">
      @foreach(Auth::user()->reserves as $reserve)
      <li class="reserve__item">
        <div class="item--top">

          <div class="timer__img">
            <img src="{{ asset('imges/timer.svg') }}">
          </div>
          <p class="reserve__count">予約{{$loop->iteration}}</p>

          <form class="delete__form" action="/mypage" method="POST">
            @csrf
            <input name="reserve_id" type="hidden" value="{{$reserve->id}}">
            <button class="delete__btn">×</button>
          </form>
        </div>
        <dl class="reserve__item__contents">
          <dt>Shop</dt>
          <dd>{{$reserve->shop->name}}</dd>
          <dt>Date</dt>
          <dd>{{$reserve->date}}</dd>
          <dt>Time</dt>
          <dd>{{$reserve->time}}</dd>
          <dt>Number</dt>
          <dd>{{$reserve->number}}</dd>
        </dl>
      </li>
      @endforeach
    </ul>
  </div>

  <div class="my__favorite">
    <h2 class="favorite__ttl">お気に入り店舗</h2>
    <ul class="shop__list">
    @foreach(Auth::user()->favorites as $favorite)
      <li class="shop__item">
        <div class="shop__item__img">
          <img src="{{$favorite->shop->img}}" alt="">
        </div>
        <div class="text__box">
          <p class="shop__item__ttl">{{$favorite->shop->name}}</p>
          <small class="hash">#{{$favorite->shop->area->area}}</small>
          <small class="hash">#{{$favorite->shop->genre->genre}}</small>

          <div class="btn__box">
            <a class="detail__link" href="/detail/{{$favorite->shop->id}}">詳しくみる</a>

            <form action="/favorite/delete" method="POST">
              @csrf
              <input name="shop_id" type="hidden" value="{{$favorite->shop->id}}"> 

              <button class="favorite_btn">
                <img class="heart" src="{{asset('imges/heart_fill.png')}}" alt="">
              </button>     
            </form>
          </div>
        </div>
      </li>
    @endforeach
    </ul>
  </div>
</div>
@endsection