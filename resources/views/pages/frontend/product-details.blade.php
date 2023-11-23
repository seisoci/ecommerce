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
{{--        <div class="col-lg-6 mb-5 ftco-animate">--}}
{{--          <a href="{{ asset('storage/images/thumbnail') }}/{{ $data['product']['poster'] ?? '' }}"--}}
{{--             class="image-popup"><img--}}
{{--              src="{{ asset('storage/images/thumbnail') }}/{{ $data['product']['poster'] ?? '' }}"--}}
{{--              class="img-fluid"></a>--}}
{{--        </div>--}}
        <div class="col-lg-6">
          <div class="container">
            <div class="row">
              <div class="col-lg-12 product-left mb-5 mb-lg-0">
                <div class="swiper-container product-slider mb-3">
                  <div class="swiper-wrapper">
                    <div class="swiper-slide">
                      <img src="{{ asset('storage/images/thumbnail') }}/{{ $data['product']['poster'] ?? '' }}" alt="..."  class="img-fluid">
                    </div>
                    @foreach($data['product']['product_images'] ?? [] as $item)
                      <div class="swiper-slide">
                        <img src="{{ asset('storage/images/thumbnail') }}/{{ $item['url'] ?? '' }}" alt="..."  class="img-fluid">
                      </div>
                    @endforeach
                  </div>
                  <div class="swiper-button-next"></div>
                  <div class="swiper-button-prev"></div>
                </div>

                <div class="swiper-container product-thumbs">
                  <div class="swiper-wrapper">
                    <div class="swiper-slide">
                      <img src="{{ asset('storage/images/thumbnail') }}/{{ $data['product']['poster'] ?? '' }}" alt="..."  class="img-fluid">
                    </div>
                    @foreach($data['product']['product_images'] ?? [] as $item)
                      <div class="swiper-slide">
                        <img src="{{ asset('storage/images/thumbnail') }}/{{ $item['url'] ?? '' }}" alt="..."  class="img-fluid">
                      </div>
                    @endforeach
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 product-details pl-md-5 ftco-animate">
          <h3>{{ $data['product']['title'] ?? '' }}</h3>
          <div class="rating d-flex">
            <h6 class="mr-2 fw-bold pt-2">{{ number_format($data['product']['review_avg_score'] ?? 0,1,'.',',') }}</h6>
            <div data-raty></div>
            <p class="text-left ml-4 mr-4">
              <a href="#" class="mr-2" style="color: green;">{{ $data['product']['review_count'] ?? 0 }} <span style="color: green;">Review</span></a>
            </p>
          </div>
          <p class="price"><span>Rp. {{ number_format($data['product']['price'] ?? 0,0,'.',',') }}</span></p>
          {!! $data['product']['description'] ?? '' !!}
          <div class="row mt-4">
            <div class="w-100"></div>
            <div class="input-group col-md-6 d-flex mb-3">
	             	<span class="input-group-btn mr-2">
	                	<button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
	                   <i class="ion-ios-remove"></i>
	                	</button>
	            		</span>
              <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1"
                     max="1000">
              <span class="input-group-btn ml-2">
	                	<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
	                     <i class="ion-ios-add"></i>
	                 </button>
	             	</span>
            </div>
            <div class="w-100"></div>
            <div class="col-md-12">
              @if($data['product']['qty'] > 0)
                <p style="color: #000;">{{ $data['product']['qty'] ?? '' }} Stok Tersedia</p>
              @else
                <p style="color: #ea4242;">{{ $data['product']['qty'] ?? '' }} Stok Habis</p>
              @endif
            </div>
          </div>
          @if($data['product']['qty'] > 0)
            <p><a id="addToCart" data-id="{{ $data['product']['id'] ?? '' }}" href="#" class="btn btn-black py-3 px-5">Masukan
                Keranjang</a></p>
          @endif
        </div>
        <div class="col-md-12">
          <h6>Review</h6>
          <div class="comment-box">
            <div class="comments">
              @foreach($data['product']['review'] ?? [] as $item)
              <div class="comment">
                <p class="comment-name">{{ $item['user']['name'] ?? '' }}</p>
                <p class="comment-text">{{ $item['description'] ?? '' }}</p>
              </div>
              @endforeach
              <!-- Add more comments with the same structure -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@push('head-css')
  <style>
    .comment-box {
      max-height: 300px;
      overflow-y: auto;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      background-color: #f9f9f9;
    }

    .comment {
      margin-bottom: 15px;
    }

    .comment .comment-name {
      margin: 0;
      font-weight: bold;
      color: #333; /* Name color */
    }

    .comment .comment-text {
      margin: 5px 0 0 0;
      padding: 8px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .comment .comment-text:hover {
      background-color: #f0f0f0;
    }

    .product-thumbs .swiper-slide img {
      border:2px solid transparent;
      object-fit: cover;
      cursor: pointer;
    }
    .product-thumbs .swiper-slide-active img {
      border-color: #bc4f38;
    }
    .product-slider .swiper-button-next:after,
    .product-slider .swiper-button-prev:after {
      font-size: 20px;
      color: #000;
      font-weight: bold;
    }
  </style>
  <link rel="stylesheet" href="{{ asset('js/raty/raty.css') }}" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://unpkg.com/swiper@6.5.4/swiper-bundle.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.4/swiper-bundle.min.css" integrity="sha512-1CRCT9P70z3SktzqL7P8o8YvlmT1nXwFeXLBuVBa4mzQJ4fsvpmsObWooerRi4WzQT8QFrBVz/36mt/XGPYVzw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@push('script')
  <script src="{{ asset('js/raty/raty.js') }}"></script>
  <script src="https://unpkg.com/swiper@6.5.4/swiper-bundle.min.js"></script>
  <script>
    $(document).ready(function () {

      /* product left start */
      if($(".product-left").length){
        var productSlider = new Swiper('.product-slider', {
          spaceBetween: 0,
          centeredSlides: false,
          loop:true,
          direction: 'horizontal',
          loopedSlides: 5,
          navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
          },
          resizeObserver:true,
        });
        var productThumbs = new Swiper('.product-thumbs', {
          spaceBetween: 0,
          centeredSlides: true,
          loop: true,
          slideToClickedSlide: true,
          direction: 'horizontal',
          slidesPerView: 5,
          loopedSlides: 5,
        });
        productSlider.controller.control = productThumbs;
        productThumbs.controller.control = productSlider;
      }

      $('[data-raty]').raty({
        readOnly: true,
        numberMax: 5,
        number: 100,
        score: {{ $data['product']['review_avg_score'] ?? 0 }}
      });

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

      $('#addToCart').on('click', function (e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        let qty = $('input[name=quantity]').val();
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          cache: false,
          data: {qty_item: qty},
          dataType: 'json',
          type: "GET",
          url: `{{ route('cart.index') }}/${id}/add-item`,
          success: function (response) {
            if (response == 'success') {
              toastr.success('Barang Berhasil Dimasukan keranjang', 'Success !');
            }
          },
        });
      });

    });
  </script>
@endpush
