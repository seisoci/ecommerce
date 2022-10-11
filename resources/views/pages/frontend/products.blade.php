@extends('pages.frontend.template')
@section('content')
  <section class="ftco-section">
    <div class="container">
      <h4 class="text-center mb-4">Produk</h4>
      <div class="row">
        @foreach($data['products'] ?? [] as $item)
          <div class="col-md-6 col-lg-3 ftco-animate fadeInUp ftco-animated">
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
      <div class="row mt-5">
        <div class="col text-center">
          <div class="block-27">
            {{ $data['products']->links() }}
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
