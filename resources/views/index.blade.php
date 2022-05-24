@extends('layouts.default')

@section('pageCss')
<link rel="stylesheet" href="{{ asset('css/index.css')}}">
@endsection

@section('content')
<header class="header">
  <div class="header__left">
    <x-menu />
  </div>
  <div class="header__right">
    <form id="search__form" class="search__form" action="/search" method="GET">
      @csrf
      <select class="area search__input" name="area_id" value="">
        <option value="" hidden>All area</option>
        @foreach($areas as $area)
        <option value="{{$area->id}}" {{ session('area') == $area->id ? 'selected' : '' }}>{{$area->area}}</option>
        @endforeach
      </select>

      <select class="genre search__input" name="genre_id">
        <option value="" hidden>All genre</option>
        @foreach($genres as $genre)
        <option value="{{$genre->id}}" {{ session('genre') == $genre->id ? 'selected' : '' }}>{{$genre->genre}}</option>
        @endforeach
      </select>

      <div class="search__img">
        <img src="{{ asset('img/search.svg') }}" alt="">
      </div>

      <input name="search" id="search__change" class="search" type="search" placeholder="Search ...">
    </form>
  </div>
</header>

<div class="container">
  <ul class="shop__list">
    @foreach($items as $item)
    <li class="shop__item">
      <div class="shop__item__img">
        <img src="{{$item->img}}" alt="">
      </div>
      <div class="text__box">
        <p class="shop__item__ttl">{{$item->name}}</p>
        <small class="hash">#{{$item->area->area}}</small>
        <small class="hash">#{{$item->genre->genre}}</small>

        <div class="btn__box">
          <a class="detail__link" href="detail/{{$item->id}}">詳しくみる</a>

          @if(Auth::check())
            @foreach(Auth::user()->favorites as $favorite)
              @if($favorite->shop_id == $item->id)
                <form action="/favorite/delete" method="POST">
                  @csrf
                  <button class="favorite_btn">
                    <img class="heart" src="{{asset('img/heart_fill.png')}}" alt="">
                  </button>
                  
                  <input name="shop_id" type="hidden" value="{{$item->id}}">      
                </form>
                    @break
              @elseif($loop->last)
                <form action="/favorite" method="POST">
                  @csrf
                  <button class="favorite_btn">
                    <img class="heart" src="{{asset('img/heart_empty.png')}}" alt="">
                  </button>
                  
                  <input name="shop_id" type="hidden" value="{{$item->id}}">
                </form>
              @endif       
            @endforeach
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