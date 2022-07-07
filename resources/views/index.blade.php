@extends('layouts.default')

@section('pageCss')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="header__right">
  <form id="search__form" class="search__form" action="/search" method="GET">
    @csrf
    <select class="area search__input" name="area_id" value="">
      <option value="" hidden>All area</option>
      @foreach($areas as $area)
        <option value="{{ $area->id }}" {{ ($area_id ?? '') == $area->id ? 'selected' : '' }}>{{ $area->area }}</option>
      @endforeach
    </select>

    <select class="genre search__input" name="genre_id">
      <option value="" hidden>All genre</option>
      @foreach($genres as $genre)
        <option value="{{ $genre->id }}" {{ ($genre_id ?? '') == $genre->id ? 'selected' : '' }}>{{ $genre->genre }}</option>
      @endforeach
    </select>

    <div class="search__box">
      <div class="search__img">
        <img src="{{ asset('img/search.svg') }}" alt="">
      </div>

      <input name="search" id="search__change" class="search" type="search" placeholder="Search ..." value="{{ $search ?? '' }}">
    </div>
  </form>
</div>

<div class="container">
  <ul class="shop__list">
    @foreach($shops as $shop)
    <li class="shop__item">
      <div class="shop__item__img">
        <img src="{{ secure_url('storage/'.$shop->img) }}" alt="">
      </div>
      <div class="text__box">
        <p class="shop__item__ttl">{{ $shop->name }}</p>
        <small class="hash">#{{ $shop->area->area }}</small>
        <small class="hash">#{{ $shop->genre->genre }}</small>

        <div class="btn__box">
          <a class="detail__link" href="detail/{{ $shop->id }}">詳しくみる</a>

          @if(Auth::check())
            @if($shop->is_liked_by_auth_user())
              <form action="/favorite/delete" method="POST">
                @csrf
                <button class="favorite_btn">
                  <img class="heart" src="{{ asset('img/heart_fill.png') }}" alt="">
                </button>
                
                <input name="shop_id" type="hidden" value="{{ $shop->id }}">      
              </form>
            @else
              <form action="/favorite" method="POST">
                @csrf
                <button class="favorite_btn">
                  <img class="heart" src="{{ asset('img/heart_empty.png') }}" alt="">
                </button>
                
                <input name="shop_id" type="hidden" value="{{ $shop->id }}">
              </form>
            @endif
          @endif
        </div>
      </div>
    </li>
    @endforeach
  </ul>
</div>

<script>
  var search__input = document.getElementsByClassName('search__input');

  for(let i=0; i<search__input.length; i++) {
    search__input[i].addEventListener('input', function() {
      search__form.submit();
    });
	}

  var search__change = document.getElementById('search__change');

  search__change.addEventListener('change', function () {
    search__form.submit();
  })
</script>
@endsection