@extends('pages.frontend.template')
@section('content')
  <section class="ftco-section ftco-cart">
    <form id="formStore" action="{{ $config['form']->action }}" method="POST">
      @method($config['form']->method)
      @csrf
      <div class="container">
        <div class="row">
          <div class="col-md-12 ftco-animate fadeInUp ftco-animated">
            <div class="cart-list">
              <table class="table">
                <thead class="thead-primary">
                <tr class="text-center">
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
                  <th>Nama Produk</th>
                  <th>Haga</th>
                  <th>Jumlah</th>
                  <th>Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data['cart'] ?? [] as $item)
                  <tr class="items" id="items_{{ $loop->iteration }}">
                    <td class="product-remove"><a class="remove-item" data-id="{{ $item['item_id'] ?? '' }}"
                                                  href="#"><span class="ion-ios-close"></span></a></td>
                    <td class="image-prod">
                      <div class="img"
                           style="background-image:url('{{ asset('storage/images/thumbnail') }}/{{ $item['item']['poster'] ?? '' }}');"></div>
                    </td>
                    <input type="hidden" name="items[{{ $loop->iteration }}][item_id]" class="form-control"
                           value="{{ $item['item_id'] ?? '' }}">
                    <td class="product-name">
                      <h3>{{ $item['item']['title'] }}</h3>
                    </td>
                    <td class="price">
                      <div class="input-group mb-3">
                        <input type="text" name="items[{{ $loop->iteration }}][price]"
                               class="qty form-control autoNumeric" value="{{ $item['item']['price'] ?? 0 }}" readonly>
                      </div>
                    </td>
                    <td class="quantity">
                      <div class="input-group mb-3">
                      <span class="input-group-btn mr-2">
                        <button type="button" class="quantity-left-minus btn" data-id="{{ $loop->iteration }}" data-type="minus" data-field="">
                         <i class="ion-ios-remove"></i>
                        </button>
                      </span>
                        <input type="text" name="items[{{ $loop->iteration }}][qty]" class="qty form-control"
                               value="{{ $item['qty'] ?? 1 }}">
                        <span class="input-group-btn ml-2">
                          <button type="button" class="quantity-right-plus btn" data-id="{{ $loop->iteration }}" data-type="plus" data-field="">
                             <i class="ion-ios-add"></i>
                         </button>
                      </span>
                      </div>

                    </td>
                    <td class="total">
                      <div class="input-group mb-3">
                        <input type="text" name="items[{{ $loop->iteration }}][total_price]"
                               class="total_price form-control autoNumeric"
                               value="{{ ($item['qty'] ?? 1) * ($item['item']['price']) }}">
                      </div>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="row justify-content-end">
          <div class="col-xl-8 mt-5 cart-wrap ftco-animate fadeInUp ftco-animated">
            <h3 class="mb-4 billing-heading">Billing Details</h3>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="firstname">Email</label>
                  <input type="text" class="form-control" value="{{ $data['profile']['email'] ?? '' }}" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="firstname">Username</label>
                  <input type="text" class="form-control" value="{{ $data['profile']['username'] ?? '' }}" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="firstname">Nama Lengkap</label>
                  <input type="text" name="name" class="form-control"
                         value="{{ $data['profile']['name'] ?? '' }}" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="lastname">No HP</label>
                  <input type="phone" name="phone" class="form-control"
                         value="{{ $data['profile']['profile']['phone'] ?? '' }}" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="lastname">Kota</label>
                  <input type="text" name="city" class="form-control"
                         value="{{ $data['profile']['profile']['city'] ?? '' }}" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="streetaddress">Alamat</label>
                  <input type="text" name="address" class="form-control"
                         value="{{ $data['profile']['profile']['address'] ?? '' }}" readonly>
                </div>
              </div>
              <div class="w-100"></div>
              <div class="w-100"></div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="postcodezip">Kode Pos</label>
                  <input type="text" name="postcode" class="form-control"
                         value="{{ $data['profile']['profile']['postcode'] ?? '' }}" readonly>
                </div>
              </div>
              <div class="w-100"></div>
            </div>
          </div>
          <div class="col-lg-4 mt-5 cart-wrap ftco-animate fadeInUp ftco-animated">
            <div class="cart-total mb-3">
              <h3>Total Pembelian</h3>
              <p class="d-flex total-price">
                <span>Total</span>
                <span class="total_purchase"></span>
              </p>
            </div>
            <p>
              <button type="submit" class="btn btn-primary py-3 px-4">Checkout</button>
            </p>
          </div>
        </div>
      </div>
    </form>
  </section>
@endsection
@push('script')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/4.6.0/autoNumeric.min.js"
          integrity="sha512-6j+LxzZ7EO1Kr7H5yfJ8VYCVZufCBMNFhSMMzb2JRhlwQ/Ri7Zv8VfJ7YI//cg9H5uXT2lQpb14YMvqUAdGlcg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    $(document).ready(function () {
      initDom();
      initCalculate();
      initStart();

      function initDom() {
        document.querySelectorAll(".autoNumeric, .total_purchase").forEach(function (el) {
          if (AutoNumeric.getAutoNumericElement(el) === null) {
            new AutoNumeric(el, {
              caretPositionOnFocus: "start",
              decimalPlaces: '0',
              unformatOnSubmit: true,
              modifyValueOnWheel: false,
            });
          }
        });

        document.querySelectorAll(".qty").forEach(function (el) {
          if (AutoNumeric.getAutoNumericElement(el) === null) {
            new AutoNumeric(el, {
              caretPositionOnFocus: "start",
              decimalPlaces: '0',
              minimumValue: 1,
              unformatOnSubmit: true,
              modifyValueOnWheel: false,
            });
          }
        });

        $('.quantity-right-plus').click(function (e) {
          e.preventDefault();
          let idx = $(this).data('id');
          let qty = parseInt(AutoNumeric.getAutoNumericElement(`input[name="items[${idx}][qty]"]`).getNumber()) || 0;
          AutoNumeric.getAutoNumericElement(`input[name="items[${idx}][qty]"]`).set(qty+1)
          initCalculateData(idx);
        });

        $('.quantity-left-minus').click(function (e) {
          e.preventDefault();
          let idx = $(this).data('id');
          let qty = parseInt(AutoNumeric.getAutoNumericElement(`input[name="items[${idx}][qty]"]`).getNumber()) || 0;
          if(qty > 1){
            AutoNumeric.getAutoNumericElement(`input[name="items[${idx}][qty]"]`).set(qty-1)
          }
          initCalculateData(idx);
        });
      }

      function initCalculate() {
        $('.autoNumeric, .qty').on('keyup change', function () {
          let id = $(this).parent().parent().parent().attr("id");
          let itemTotalHarga = 0;
          let totalPembelian = 0;

          if (id) {
            let split_id = id.split("_");
            let idx = split_id[1];
            let item_id = $(`input[name="items[${idx}][item_id]"]`).val();
            let qty = parseInt(AutoNumeric.getAutoNumericElement(`input[name="items[${idx}][qty]"]`).getNumber()) || 0;
            let harga = parseFloat(AutoNumeric.getAutoNumericElement(`input[name="items[${idx}][price]"]`).getNumber()) || 0;
            itemTotalHarga = harga * qty;
            AutoNumeric.getAutoNumericElement(`input[name="items[${idx}][total_price]"]`).set(itemTotalHarga);

            $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              cache: false,
              data: {qty_item: qty},
              dataType: 'json',
              type: "GET",
              url: `{{ route('cart.index') }}/${item_id}/update-item`,
              success: function (response) {
              },
            });
          }

          document.querySelectorAll('.total_price').forEach(function (el) {
            let nameEl = el.getAttribute('name');
            totalPembelian += parseInt(AutoNumeric.getAutoNumericElement(`input[name="${nameEl}`).getNumber()) || 0;
          });

          AutoNumeric.getAutoNumericElement(`.total_purchase`).set(totalPembelian);
        });
      }

      function initCalculateData(idx){
        let itemTotalHarga = 0;
        let totalPembelian = 0;

        if (idx) {
          let item_id = $(`input[name="items[${idx}][item_id]"]`).val();
          let qty = parseInt(AutoNumeric.getAutoNumericElement(`input[name="items[${idx}][qty]"]`).getNumber()) || 0;
          let harga = parseFloat(AutoNumeric.getAutoNumericElement(`input[name="items[${idx}][price]"]`).getNumber()) || 0;
          itemTotalHarga = harga * qty;
          AutoNumeric.getAutoNumericElement(`input[name="items[${idx}][total_price]"]`).set(itemTotalHarga);

          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            cache: false,
            data: {qty_item: qty},
            dataType: 'json',
            type: "GET",
            url: `{{ route('cart.index') }}/${item_id}/update-item`,
            success: function (response) {
            },
          });
        }

        document.querySelectorAll('.total_price').forEach(function (el) {
          let nameEl = el.getAttribute('name');
          totalPembelian += parseInt(AutoNumeric.getAutoNumericElement(`input[name="${nameEl}`).getNumber()) || 0;
        });

        AutoNumeric.getAutoNumericElement(`.total_purchase`).set(totalPembelian);
      }

      function initStart() {
        let totalPembelian = 0;

        document.querySelectorAll('.total_price').forEach(function (el) {
          let nameEl = el.getAttribute('name');
          totalPembelian += parseInt(AutoNumeric.getAutoNumericElement(`input[name="${nameEl}`).getNumber()) || 0;
        });

        AutoNumeric.getAutoNumericElement(`.total_purchase`).set(totalPembelian);
      }

      $('.remove-item').on('click', function (e) {
        $selector = $(this);
        e.preventDefault();
        let id = $(this).attr("data-id");
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          cache: false,
          processData: false,
          contentType: false,
          type: "GET",
          url: `{{ route('cart.index') }}/${id}/delete-item`,
          success: function (response) {
            if (response == 'success') {
              $selector.parent().parent().remove();
              initStart();
            }
          },
        });
      });


    });
  </script>
@endpush
