<p>{{ $reserve->user->name }}様　以下の内容のご予約が近づきましたのでお知らせします。</p>

<dl>
  <dt>店名</dt>
  <dd>{{ $reserve->shop->name }}</dd>

  <dt>日付</dt>
  <dd>{{ $reserve->date }}</dd>

  <dt>時間</dt>
  <dd>{{ date('H:i', strtotime($reserve->time)) }}</dd>

  <dt>人数</dt>
  <dd>{{ $reserve->number }}</dd>
</dl>