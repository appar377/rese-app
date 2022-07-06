@extends('layouts.default')

@section('pageCss')
<link rel="stylesheet" href="{{ mix('css/create_shop.css') }}">
@endsection

@section('content')
<h2 class="create__shop__ttl">店舗を作成する</h2>

<div class="create__shop__container">
  <form class="create__shop__form" action="/shop/store" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="name__box">
      <label class="label label--name" for="name">店舗名</label>
      <input class="input" type="text" id="name" name="name">
    </div>

    @if ($errors->has('name'))
      <p class="error">{{ $errors->first('name') }}</p>
    @endif

    <div class="img__box">
      <label class="label label--img">画像</label>
      <input id="create__img" class="input" type="file" name="img">
    </div>

    <div class="selected__create__img">
      <img id="show__create__img" src="" alt="">
    </div>

    @if ($errors->has('img'))
      <p class="error">{{ $errors->first('img') }}</p>
    @endif

    <div class="area__box">
      <label class="label label--area" for="area">地域</label>

      <select class="select" name="area_id" id="area">
        <option value="" hidden>地域を選択してください</option>
        @foreach($areas as $area)
          <option value="{{ $area->id }}" >{{ $area->area }}</option>
        @endforeach
      </select>
    </div>

    @if ($errors->has('area_id'))
      <p class="error">{{ $errors->first('area_id') }}</p>
    @endif

    <div class="genre__box">
      <label class="label label--genre" for="genre">ジャンル</label>
      <select class="select" name="genre_id" id="genre">
        <option value="" hidden>ジャンルを選択してください</option>
          @foreach($genres as $genre)
            <option value="{{ $genre->id }}" >{{ $genre->genre }}</option>
          @endforeach
      </select>
    </div>

    @if ($errors->has('genre_id'))
      <p class="error">{{ $errors->first('genre_id') }}</p>
    @endif

    <div class="course__box">
      <label class="label label--course">コース名</label>

      <input class="input" type="text" name="course">
    </div>

    @if ($errors->has('course'))
      <p class="error">{{ $errors->first('course') }}</p>
    @endif

    <div class="price__box">
      <label class="label label--price">価格</label>

      <input class="input" type="text" name="price">
    </div>

    @if ($errors->has('price'))
      <p class="error">{{ $errors->first('price') }}</p>
    @endif

    <div class="text__box">
      <label class="label label--text" for="content">店舗紹介文</label>
      <textarea class="textarea" name="content" id="content" cols="30" rows="10"></textarea>
    </div>

    @if ($errors->has('content'))
      <p class="error">{{ $errors->first('content') }}</p>
    @endif

    <button class="create__shop__btn">店舗を登録する</button>
  </form>

  <ul class="shop__list">
    @foreach($shops as $shop)
      <li class="shop__item">
        <div class="delete__btn__box">
          <form class="shop__delete__form" action="/shop/delete" method="POST">
            @csrf
            <input type="hidden" name="shop_id" value="{{ $shop->id }}">
            <button class="delete__btn">❌</button>
          </form>
        </div>

        <form class="shop__update" action="/shop/update" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="shop__img">
            <img id="show__update__img" src="{{ asset('storage/'.$shop->img) }}">
          </div>

          <div class="img__update__btn">
            <input id="update__img" type="file" name="img">
            <input type="hidden" value="{{$shop->img}}" name="oldImg">
          </div>

          <div class="shop__contents">

            <dl class="shop__contents__dl">
              <dt>店舗名</dt>
              <dd>
                <input class="input--update" type="text" name="name" value="{{ $shop->name }}">
              </dd>

              <dt>地域</dt>
              <dd>
                <select class="select--update" name="area_id">
                  <option value="{{ $area->id }}" hidden>{{ $shop->area->area }}</option>

                  @foreach($areas as $area)
                    <option value="{{ $area->id }}" >{{ $area->area }}</option>
                  @endforeach
                </select> 
              </dd>

              <dt>ジャンル</dt>
              <dd>
                <select class="select--update" name="genre_id">
                  <option value="{{ $genre->id }}" hidden>{{ $shop->genre->genre }}</option>

                  @foreach($genres as $genre)
                    <option value="{{ $genre->id }}" >{{ $genre->genre }}</option>
                  @endforeach
                </select>
              </dd>

              <dt>コース名</dt>
              <dd>
                <input class="input--update" type="text" name="course" value="{{ $shop->course }}">
              </dd>

              <dt>店舗名</dt>
              <dd>
                <input class="input--update" type="text" name="price" value="{{ $shop->price }}">
              </dd>

              <dt>店舗紹介文</dt>
              <dd>
                <textarea class="textarea--update" name="content" cols="30" rows="10">{{ $shop->content }}</textarea>
              </dd>
            </dl>

            <div class="btn__box">

              <input type="hidden" name="shop_id" value="{{ $shop->id }}">

              <a class="reserve__confirmation__link" href="reserve/{{ $shop->id }}">予約情報の確認</a>

              <button type="submit" class="update__btn">更新する</button>
            </div>
          </div>
        </form>
      </li>
    @endforeach
  </ul>
</div>

<script>
  const CreateImg = document.getElementById("create__img");
  const ShowCreateImg = document.getElementById("show__create__img");

  const UpdateImg = document.getElementById("update__img");
  const ShowUpdateImg = document.getElementById("show__update__img");

  CreateImg.addEventListener('change', function() {
    const file = CreateImg.files[0];
    
    const url = URL.createObjectURL(file);

    ShowCreateImg.src = url;
  });

  UpdateImg.addEventListener('change', function() {
    const file = UpdateImg.files[0];
    
    const url = URL.createObjectURL(file);

    ShowUpdateImg.src = url;
  });
</script>
@endsection