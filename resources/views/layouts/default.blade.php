<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/menu.css')}}">
  @yield('pageCss')
</head>
<style>
  body {
    height: 100vh;
    background-color: #eeeeee;
  }
</style>
<body>
  <div class="content">
    @yield('content')
  </div>

<script>
  const target = document.getElementById("menu");
  target.addEventListener('click', () => {
  target.classList.toggle('open');
  const nav = document.getElementById("nav");
  nav.classList.toggle('in');
  });
</script>
</body>
</html>