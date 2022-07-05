@extends('layouts.default')

@section('pageCss')
<link rel="stylesheet" href="{{ asset('css/management.css') }}">
@endsection

@section('content')
<h2 class="management__ttl">店舗代表者を登録する</h2>

<div class="create__leader__container">
  <form class="create__leader__form" action="/management/store" method="POST">
    @csrf
    <div class="name__box">
      <label for="name" class="label label--name">名前：</label>
      <input class="input" type="text" id="name" name="name">
    </div>

    @if ($errors->has('name'))
      <p class="error">{{ $errors->first('name') }}</p>
    @endif

    <div class="email__box">
      <label for="email" class="label label--email">メールアドレス：</label>
      <input class="input" type="text" id="email" name="email">
    </div>

    @if ($errors->has('email'))
      <p class="error">{{ $errors->first('email') }}</p>
    @endif

    <div class="password__box">
      <label for="password" class="label label--password">パスワード：</label>
      <input class="input" type="password" id="password" name="password">
    </div>

    @if ($errors->has('password'))
      <p class="error">{{ $errors->first('password') }}</p>
    @endif

    <div class="password__box">
      <label for="repassword" class="label label--password">確認：</label>
      <input class="input" type="password" id="repassword" name="password_confirmation">
    </div>

    @if ($errors->has('password_confirmation'))
      <p class="error">{{ $errors->first('password_confirmation') }}</p>
    @endif

    <input type="hidden" name="role" value=5>

    <button class="create__btn">店舗代表者を登録する</button>
  </form>
</div>

<div class="shop__leader__container">
  <table class="shop__leader__table">
    <tr class="table__recode">
      <th>名前</th>
      <th>メールアドレス</th>
      <th>役職</th>
      <th></th>
    </tr>

    @foreach($users as $user)
    <tr class="table__recode">
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>
        @if($user->role == 5)
          店舗代表者
        @endif
      </td>
      <td>
        <form action="/management/delete" method="POST">
          @csrf
          <input type="hidden" name="user_id" value="{{$user->id}}">
          <button class="delete__btn">削除</button>
        </form>
      </td>
    </tr>
    @endforeach
  </table>
</div>
@endsection