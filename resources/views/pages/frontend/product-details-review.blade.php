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
          <a href="{{ asset('storage/images/thumbnail') }}/{{ $data['product']['poster'] ?? '' }}"
             class="image-popup"><img
              src="{{ asset('storage/images/thumbnail') }}/{{ $data['product']['poster'] ?? '' }}"
              class="img-fluid"></a>
        </div>
        <form id="formStore" action="{{ route('review')}}" method="POST">
          @method('POST')
          @csrf

          <div class="col-lg-12 product-details pl-md-5 ftco-animate">
            <h3>{{ $data['product']['title'] ?? '' }}</h3>
            <div class="rating d-flex">
              <h6 class="mr-2 fw-bold pt-2">Rating</h6>
              <div data-raty></div>
              <input type="hidden" name="item_id" value="{{ $data['product']['id'] }}">
            </div>
            <div class="row">
              <div class="form-group" style="width: 100%">
                <label for="postcodezip">Tulis Review</label>
                <textarea class="form-control" name="description" rows="5"
                          style="width: 100%; height: auto !important; text-align: left"></textarea>
              </div>
              <button class="btn btn-outline-primary" type="submit">Submit Review</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </section>
@endsection
@push('head-css')
  <link rel="stylesheet" href="{{ asset('js/raty/raty.css') }}" crossorigin="anonymous" referrerpolicy="no-referrer"/>
@endpush
@push('script')
  <script src="{{ asset('js/raty/raty.js') }}"></script>
  <script>
    $(document).ready(function () {
      $('[data-raty]').raty({
        numberMax: 5,
        number: 100
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

      $("#formStore").submit(function (e) {
        e.preventDefault();
        let form = $(this);
        let btnSubmit = form.find("[type='submit']");
        let btnSubmitHtml = btnSubmit.html();
        let url = form.attr("action");
        let data = new FormData(this);
        $.ajax({
          cache: false,
          processData: false,
          contentType: false,
          type: "POST",
          url: url,
          data: data,
          beforeSend: function () {
            btnSubmit.addClass("disabled").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...').prop("disabled", "disabled");
          },
          success: function (response) {
            let errorCreate = $('#errorCreate');
            errorCreate.css('display', 'none');
            errorCreate.find('.alert-text').html('');
            btnSubmit.removeClass("disabled").html(btnSubmitHtml).removeAttr("disabled");
            if (response.status === "success") {
              toastr.success(response.message, 'Success !');
              setTimeout(function () {
                if (response.redirect === "" || response.redirect === "reload") {
                  location.reload();
                } else {
                  location.href = response.redirect;
                }
              }, 1000);
            } else {
              toastr.error((response.message ? response.message : "Please complete your form"), 'Failed !');
              if (response.error !== undefined) {
                errorCreate.removeAttr('style');
                $.each(response.error, function (key, value) {
                  errorCreate.find('.alert-text').append('<span style="display: block">' + value + '</span>');
                });
              }
            }
          },
          error: function (response) {
            btnSubmit.removeClass("disabled").html(btnSubmitHtml).removeAttr("disabled");
            toastr.error(response.responseJSON.message, 'Failed !');
          }
        });
      });


    });
  </script>
@endpush
