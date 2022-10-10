<!DOCTYPE html>
<html lang="en">
<head>
  <title>Jualan</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap"
        rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('frontend/css/open-iconic-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.min.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/css/aos.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap-datepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/css/jquery.timepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/css/flaticon.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/css/icomoon.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">

</head>
<body class="goto-here">
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
  <div class="container">
    <a class="navbar-brand" href="index.html">Vegefoods</a>
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
              <a class="dropdown-item" href="shop.html">Ubah Profile</a>
              <a class="dropdown-item" href="wishlist.html">Keranjang Saya</a>
              <a class="dropdown-item" href="wishlist.html">History Pembelian</a>
            </div>
          </li>
        @else
          <li class="nav-item"><a href="contact.html" class="nav-link">Masuk</a></li>
        @endif
        <li class="nav-item cta cta-colored"><a href="cart.html" class="nav-link"><span
              class="icon-shopping_cart"></span>[0]</a></li>

      </ul>
    </div>
  </div>
</nav>
<!-- END nav -->

<section id="home-section" class="hero">
  <div class="home-slider owl-carousel">
    @foreach($data['slider'] ?? [] as $item)
      <div class="slider-item"
           style="background-image: url({{ asset('storage/images/original') }}{{ '/'.$item['poster'] }});">
        <div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">
            <div class="col-md-12 ftco-animate text-center">
              <h1 class="mb-2">{{ $item['title'] ?? '' }}</h1>
              <h2 class="subheading mb-4">Kami menyedikan barang-barang berkualitas</h2>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</section>

<section class="ftco-section">
  <div class="container">
    <div class="row justify-content-center mb-3 pb-3">
      <div class="col-md-12 heading-section text-center ftco-animate">
        <span class="subheading">Terbaru</span>
        <h2 class="mb-4">Produk Kami</h2>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      @foreach($data['products'] ?? [] as $item)
        <div class="col-md-6 col-lg-3 ftco-animate">
          <div class="product">
            <a href="{{ route('products.show', $item['slug']) }}" class="img-prod">
              <img class="img-fluid" src="{{ asset('storage/images/thumbnail') }}/{{ $item['poster'] ?? '' }}"
                   style="height: 250px !important;">
              <div class="overlay"></div>
            </a>
            <div class="text py-3 pb-4 px-3 text-center">
              <h3><a href="{{ route('products.show', $item['slug']) }}">{{ $item['title'] ?? '' }}</a></h3>
              <div class="d-flex">
                <div class="pricing">
                  <p class="price"><span>Rp. {{ number_format($item['price'],0,'.',',') }}</span></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<!-- loader -->
<div id="ftco-loader" class="show fullscreen">
  <svg class="circular" width="48px" height="48px">
    <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
    <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/>
  </svg>
</div>


<script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery-migrate-3.0.1.min.js') }}"></script>
<script src="{{ asset('frontend/js/popper.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.easing.1.3.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.stellar.min.js') }}"></script>
<script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('frontend/js/aos.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.animatenumber.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('frontend/js/scrollax.min.js') }}"></script>
<script src="{{ asset('frontend/js/google-map.js') }}"></script>
<script src="{{ asset('frontend/js/main.js') }}"></script>
<script src="{{ asset('frontend/js/main.js') }}"></script>

</body>
</html>
