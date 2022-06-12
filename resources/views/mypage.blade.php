@extends('layouts.default')

@section('pageCss')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<h1 class="user__name">{{ $user->name }}さん</h1>

<div class="mypage__container">
  <div class="my__reserve">
    <h2 class="reserve__ttl">予約状況</h2>
    <ul class="reserve__list">
      @foreach($user->reserves as $reserve)
        @if($reserve->date > now()->format('Y-m-d'))
          <li class="reserve__item">
            <div class="item--top">

              <div class="timer__img">
                <img src="{{ asset('img/timer.svg') }}">
              </div>
              <p class="reserve__count">予約{{ $loop->iteration }}</p>

              <form class="delete__form" action="/reserve/delete" method="POST">
                @csrf
                <input name="reserve_id" type="hidden" value="{{ $reserve->id }}">
                <button class="delete__btn">×</button>
              </form>
            </div>

            <form class="update__form" action="/reserve/update" method="POST">
              @csrf
              <dl class="reserve__item__contents">
                <dt>Shop</dt>
                <dd>{{ $reserve->shop->name }}</dd>

                <dt>Date</dt>
                <dd><input class="update__input"  type="date" name="date" value="{{ $reserve->date }}"></dd>

                <dt>Time</dt>
                <dd>
                  <select class="update__input"  name="time">
                    <option value="{{ $reserve->time }}" hidden>{{ date('H:i', strtotime($reserve->time)) }}</option>
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
                </dd>

                <dt>Number</dt>
                <dd>
                  <select class="update__input" name="number">
                    <option value="{{ $reserve->number }}" hidden>{{ $reserve->number }}人</option>
                    @for($i=1;$i<=10;$i++)
                      <option value="{{ $i }}">{{ $i }}人</option>
                    @endfor
                  </select>
                </dd>
              </dl>

              <input name="reserve_id" type="hidden" value="{{ $reserve->id }}">

              @if ($errors->has('date'))
                <p>{{ $errors->first('date') }}</p>
              @endif

              <button class="update__btn">変更する</button>
            </form>
          </li>
        @endif
      @endforeach
    </ul>
  </div>

  <div class="my__favorite">
    <h2 class="favorite__ttl">お気に入り店舗</h2>
    <ul class="shop__list">
    @foreach($user->favorites as $favorite)
      <li class="shop__item">
        <div class="shop__item__img">
          <img src="{{ $favorite->shop->img }}" alt="">
        </div>
        <div class="text__box">
          <p class="shop__item__ttl">{{ $favorite->shop->name }}</p>
          <small class="hash">#{{ $favorite->shop->area->area }}</small>
          <small class="hash">#{{ $favorite->shop->genre->genre }}</small>

          <div class="btn__box">
            <a class="detail__link" href="/detail/{{ $favorite->shop->id }}">詳しくみる</a>

            <form action="/favorite/delete" method="POST">
              @csrf
              <input name="shop_id" type="hidden" value="{{ $favorite->shop->id }}"> 

              <button class="favorite_btn">
                <img class="heart" src="{{ asset('img/heart_fill.png') }}" alt="">
              </button>     
            </form>
          </div>
        </div>
      </li>
    @endforeach
    </ul>
  </div>

  <div class="review">
    <h2 class="review__ttl">評価</h2>

    <ul class="review__list">
      @foreach($user->reserves as $reserve)
        @if($reserve->date < now()->format('Y-m-d'))
          <li class="review__item">
            <dl class="reserve__item__contents">
              <dt>Shop</dt>
              <dd>{{ $reserve->shop->name }}</dd>

              <dt>Date</dt>
              <dd>{{ $reserve->date }}</dd>

              <dt>Time</dt>
              <dd>{{ date('H:i', strtotime($reserve->time)) }}</dd>

              <dt>Number</dt>
              <dd>{{ $reserve->number }}人</dd>
            </dl>

            <form action="/review" method="POST">
              @csrf
              <div class="stars" id="stars">
                  <span class="star" data-star="1">☆</span>
                  <span class="star" data-star="2">☆</span>
                  <span class="star" data-star="3">☆</span>
                  <span class="star" data-star="4">☆</span>
                  <span class="star" data-star="5">☆</span>
              </div>

              <input id="star__input" type="hidden" name="star" value="">

              <input type="hidden" name="reserve_id" value="{{ $reserve->id }}">

              <textarea class="comment" name="comment" cols="30" rows="10"></textarea>


              @if(count($errors) > 0)
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              @endif

              <button class="review__btn">評価する</button>
            </form>
          </li>
        @endif
      @endforeach
    </ul>
  </div>
</div>

<script>
  const reviewItem = document.getElementsByClassName('review__item');

  const stars = document.getElementsByClassName('star');

  const starInput = document.getElementById('star__input');

  // 星マークにマウスオーバーした時のイベント
    const starMouseover = (e) => {
    const index = Number(e.toElement.getAttribute('data-star'));
    for(let j=0; j < index; j++) {
        stars[j].textContent = '★';
    }
  }

  // 星マークからマウスが離れた時のイベント
  const starMouseout = (e) => {
    for (let j=0; j < stars.length; j++) {
        stars[j].textContent = '☆';
    }
  }

  for (let k = 0; k < reviewItem.length; k++) {
    for (let i=0; i < stars.length; i++) {
      stars[i].addEventListener('mouseover', starMouseover);
      stars[i].addEventListener('mouseout',starMouseout);

      // 星マークをクリックした時のイベント
      stars[i].addEventListener('click', e => {
        for (let j=0; j < stars.length; j++) {
            stars[j].textContent = '☆';

            console.log(stars);
        }

        const index = Number(e.target.getAttribute('data-star'));
        
        starInput.value = index;

        for(let j=0; j<index; j++) {
          stars[j].textContent = '★';
        }
        // マウスオーバーとマウスアウトのイベント解除
        for(let j=0; j<stars.length; j++) {
          stars[j].removeEventListener('mouseover', starMouseover);
          stars[j].removeEventListener('mouseout', starMouseout);
        }
      });
    }
  }  
</script>
@endsection