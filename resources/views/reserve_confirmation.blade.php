@extends('layouts.default')

@section('pageCss')
<link rel="stylesheet" href="{{ asset('css/reserve_confirmation.css') }}">
@endsection

@section('content')
<table class="reserve__table">
  <tr>
    <th>名前</th>
    <th>人数</th>
    <th>日付</th>
    <th>時間</th>
  </tr>

  @foreach($reserves as $reserve)
    <tr>
      <td>{{ $reserve->user->name }}</td>
      <td>{{ $reserve->number }}</td>
      <td>{{ $reserve->date }}</td>
      <td>{{ date('H:i', strtotime($reserve->time)) }}</td>
    </tr>
  @endforeach
</table>
@endsection