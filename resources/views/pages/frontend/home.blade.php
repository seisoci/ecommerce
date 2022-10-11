@extends('pages.frontend.template')
@section('content')
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
@endsection
