<nav class="nav" id="nav">
  <ul>
    @if(Auth::check())
      <li><a href="/">Home</a></li>
      <li>
        <form action="/logout" method="POST">
          @csrf
          <button class="logout_btn" type="submit">Logout</button>
        </form>
      </li>
      <li><a href="/mypage">Mypage</a></li>
    @else
      <li><a href="/">Home</a></li>
      <li><a href="/register">Registation</a></li>
      <li><a href="/mypage">Mypage</a></li>
    @endif
  </ul>
</nav>

<div class="header__logo">
  <div class="menu" id="menu">
    <span class="menu__line--top"></span>
    <span class="menu__line--middle"></span>
    <span class="menu__line--bottom"></span>
  </div>

  <h1 class="logo__ttl">Rese</h1>
</div>