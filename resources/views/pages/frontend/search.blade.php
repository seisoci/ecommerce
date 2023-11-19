@extends('pages.frontend.template')
@section('content')
  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center mb-3 pb-3">
        <div class="col-md-12 heading-section text-center ftco-animate">
          <h2 class="mb-4">Pencarian</h2>
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
