@extends('layouts.default')

@section('pageCss')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="detail__container">
  <div class="detail__left">
    <a class="turn__link" href="/"><</a>
    <p class="shop__name">{{ $shop->name }}</p>

    <div class="detail__left__img">
      <img src="{{ asset('storage/'.$shop->img) }}" alt="">
    </div>

    <small class="hash">#{{ $shop->area->area }}</small>
    <small class="hash">#{{ $shop->genre->genre }}</small>
    <p class="text">{{ $shop->content }}</p>
  </div>

  <div class="detail__right">
    <p class="reserve__ttl">予約</p>

    <form action="/reserve" method="POST">
      @csrf
      <div class="input__box">
        <input name="date" id="date__input" class="date" type="date" value="{{ now()->format('Y-m-d') }}">
        @if ($errors->has('date'))
        <p>{{ $errors->first('date') }}</p>
        @endif

        <select name="time" id="time__input">
          <option hidden>時間</option>
          <option value="17:00">17:00</option>
          <option value="17:30">17:30</option>
          <option value="18:00">18:00</option>
          <option value="18:30">18:30</option>
          <option value="19:00">19:00</option>
          <option value="19:30">19:30</option>
          <option value="20:00">20:00</option>
          <option value="20:30">20:30</option>
          <option value="21:00">21:00</option>
        </select>
        @if ($errors->has('time'))
        <p>{{ $errors->first('time') }}</p>
        @endif

        <select name="number" id="number__input">
          <option hidden>人数</option>
          @for($i=1;$i<=10;$i++)
            <option value="{{$i}}">{{ $i }}人</option>
          @endfor
        </select>
        @if ($errors->has('number'))
        <p>{{$errors->first('number')}}</p>
        @endif

        <input name="shop_id" type="hidden" value="{{ $shop->id }}">
        <input name="user_id" type="hidden" value="{{ Auth::id() }}">
      </div>

      <dl class="reserve__contents">
        <dt>Shop</dt>
        <dd>{{ $shop->name }}</dd>
        <dt>Price</dt>
        <dd>{{ $shop->course }}({{ $shop->price }}円)</dd>
        <dt>Date</dt>
        <dd id="date__show">{{ now()->addDay(3)->format('Y-m-d') }}</dd>
        <dt>Time</dt>
        <dd id="time__show">時間</dd>
        <dt>Number</dt>
        <dd id="number__show">人数</dd>
      </dl>

      <button class="reserve__btn">
        <script
          src="https://checkout.stripe.com/checkout.js" class="stripe-button"
          data-key="{{ env('STRIPE_PUBLIC_KEY') }}"
          data-amount="{{ $shop->price }}"
          data-name="Stripe決済デモ"
          data-label="予約(決済)する"
          data-description="これはデモ決済です"
          data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
          data-locale="auto"
          data-currency="JPY">
        </script>
      </button>
    </form>
  </div>
</div>

<script>
  window.addEventListener('DOMContentLoaded', function(){
    addEventListener('input', function() {
      date__show.textContent = date__input.value;
      time__show.textContent = time__input.value;
      number__show.textContent = number__input.value;
    })
  });
</script>
@endsection