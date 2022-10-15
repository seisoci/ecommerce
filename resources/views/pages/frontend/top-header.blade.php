<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home.index') }}">Vegefoods</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav"
            aria-expanded="false" aria-label="Toggle navigation">
      <span class="oi oi-menu"></span> Menu
    </button>

    <div class="collapse navbar-collapse" id="ftco-nav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active"><a href="{{ route('home.index') }}" class="nav-link">Beranda</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true"
             aria-expanded="false">Kategori</a>
          <div class="dropdown-menu" aria-labelledby="dropdown04">
            @foreach($data['categoryMenu'] ?? [] as $item)
              <a class="dropdown-item" href="{{ route('products.index', ['category' => $item['name'] ?? '']) }}">{{ $item['name'] ?? [] }}</a>
            @endforeach
          </div>
        </li>
        @if(auth()->check())
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true"
               aria-expanded="false">Akun Saya</a>
            <div class="dropdown-menu" aria-labelledby="dropdown04">
              <a class="dropdown-item" href="{{ route('profiles.index') }}">Ubah Profile</a>
              <a class="dropdown-item" href="{{ route('cart.index') }}">Keranjang Saya</a>
              <a class="dropdown-item" href="{{ route('history.index') }}">History Pembelian</a>
              <form method="POST" action="{{route('logout')}}">
                @csrf
                <li><a href="javascript:void(0)" class="dropdown-item"
                       onclick="event.preventDefault(); this.closest('form').submit();">
                    Keluar
                  </a></li>
              </form>
            </div>
          </li>
        @else
          <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Masuk</a></li>
          <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Registrasi</a></li>
        @endif
      </ul>
    </div>
  </div>
</nav>
