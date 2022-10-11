@extends('pages.frontend.template')
@section('content')
  <div class="hero-wrap hero-bread" style="background-image: url('{{ asset('images/bg1.jpeg') }}');">
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center">
          <h1 class="mb-0 bread text-dark">Detail Produk</h1>
        </div>
      </div>
    </div>
  </div>

  <section class="ftco-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 mb-5 ftco-animate">
          <a href="{{ asset('storage/images/thumbnail') }}/{{ $data['peoduct']['poster'] ?? '' }} class=" image-popup"><img
            src="{{ asset('storage/images/thumbnail') }}/{{ $data['peoduct']['poster'] ?? '' }}" class="img-fluid"></a>
        </div>
        <div class="col-lg-6 product-details pl-md-5 ftco-animate">
          <h3>{{ $data['peoduct']['title'] ?? '' }}</h3>
          <p class="price"><span>Rp. {{ number_format($data['peoduct']['price'] ?? 0,0,'.',',') }}</span></p>
          {!! $data['peoduct']['description'] ?? '' !!}
          <div class="row mt-4">
            <div class="w-100"></div>
            <div class="input-group col-md-6 d-flex mb-3">
	             	<span class="input-group-btn mr-2">
	                	<button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
	                   <i class="ion-ios-remove"></i>
	                	</button>
	            		</span>
              <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1"
                     max="100">
              <span class="input-group-btn ml-2">
	                	<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
	                     <i class="ion-ios-add"></i>
	                 </button>
	             	</span>
            </div>
            <div class="w-100"></div>
            <div class="col-md-12">
              <p style="color: #000;">{{ $data['peoduct']['qty'] ?? '' }} Stok Tersedia</p>
            </div>
          </div>
          <p><a href="cart.html" class="btn btn-black py-3 px-5">Add to Cart</a></p>
        </div>
      </div>
    </div>
  </section>
@endsection
@push('script')
  <script>
    $(document).ready(function () {
      var quantitiy = 0;
      $('.quantity-right-plus').click(function (e) {
        e.preventDefault();
        var quantity = parseInt($('#quantity').val());
        $('#quantity').val(quantity + 1);

      });

      $('.quantity-left-minus').click(function (e) {
        e.preventDefault();
        var quantity = parseInt($('#quantity').val());
        if (quantity > 0) {
          $('#quantity').val(quantity - 1);
        }
      });

    });
  </script>
@endpush
