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
                    <input type="hidden" name="items[{{ $loop->iteration }}][gram]" class="form-control autoNumeric"
                           value="{{ $item['item']['gram'] ?? '' }}">
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
                        <button type="button" class="quantity-left-minus btn" data-id="{{ $loop->iteration }}"
                                data-type="minus" data-field="">
                         <i class="ion-ios-remove"></i>
                        </button>
                      </span>
                        <input type="text" name="items[{{ $loop->iteration }}][qty]" class="qty form-control"
                               value="{{ $item['qty'] ?? 1 }}">
                        <span class="input-group-btn ml-2">
                          <button type="button" class="quantity-right-plus btn" data-id="{{ $loop->iteration }}"
                                  data-type="plus" data-field="">
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
                        <input type="hidden" name="items[{{ $loop->iteration }}][total_gram]"
                               class="total_gram form-control autoNumeric"
                               value="{{ ($item['qty'] ?? 1) * ($item['item']['gram']) }}">
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
                  <label for="streetaddress">Alamat</label>
                  <input type="text" name="address" class="form-control"
                         value="{{ $data['profile']['profile']['address'] ?? '' }}" readonly>
                </div>
              </div>
              <div class="w-100"></div>
              <div class="w-100"></div>
              <div class="w-100"></div>
            </div>
            <div class="row">
              <div class="row mb-3" style="width: 100%">
                <div class="col-md-12">
                  <strong>Ongkir</strong>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="origin_province" class="form-label" style="display: block">Province</label>
                    <select name="origin_province" id="origin_province" class="form-control"
                            style="width: 100% !important;">
                      <option>Choose Province</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="origin_city" class="form-label" style="display: block">City</label>
                    <select name="origin_city" id="origin_city" class="form-control" style="width: 100% !important;">
                      <option>Choose City</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row mb-3" style="width: 100%">
                <div class="col-md-12">
                  <strong>Destination</strong>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="destination_province" class="form-label" style="display: block">Province</label>
                    <select name="destination_province" id="destination_province" class="form-control"
                            style="width: 100% !important;">
                      <option>Choose Province</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="destination_city" class="form-label" style="display: block">City</label>
                    <select name="destination_city" id="destination_city" class="form-control"
                            style="width: 100% !important;">
                      <option>Choose City</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row mb-3" style="width: 100%">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="courier" class="form-label">Courier</label>
                    <select name="courier" id="courier" class="form-control">
                      <option>Choose Courier</option>
                      <option value="jne">JNE</option>
                      <option value="pos">POS</option>
                      <option value="tiki">TIKI</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="weight" class="form-label">Weight (Gram)</label>
                  <input type="text" name="weight" id="weight" class="form-control" readonly>
                </div>
              </div>
              <div class="col-12">
                <div id="result" class="mt-3 d-none"></div>
                <button class="btn btn-primary px-4 mt-4" id="checkBtn">Cek Ongkir</button>
              </div>
            </div>
          </div>
          <div class="col-lg-4 mt-5 cart-wrap ftco-animate fadeInUp ftco-animated">
            <div class="cart-total mb-3">
              <h3>Total Pembelian</h3>
              <p class="d-flex total-price">
                <span>Total Ongkir</span>
                <input type="hidden" name="total_ongkir" class="total_ongkir_data autoNumeric">
                <span class="total_ongkir text-end autoNumeric"></span>
              </p>
              <p class="d-flex total-price">
                <span>Total Pembelian</span>
                <span class="total_purchase text-end autoNumeric"></span>
              </p>
              <p class="d-flex total-price">
                <span>Grand Total</span>
                <span class="grand_total text-end autoNumeric"></span>
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
@push('head-css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"/>
@endpush
@push('script')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js"
          integrity="sha512-RtZU3AyMVArmHLiW0suEZ9McadTdegwbgtiQl5Qqo9kunkVg1ofwueXD8/8wv3Af8jkME3DDe3yLfR8HSJfT2g=="
          crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/4.6.0/autoNumeric.min.js"
          integrity="sha512-6j+LxzZ7EO1Kr7H5yfJ8VYCVZufCBMNFhSMMzb2JRhlwQ/Ri7Zv8VfJ7YI//cg9H5uXT2lQpb14YMvqUAdGlcg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    $(document).ready(function () {
      initDom();
      initCalculate();
      initStart();
      initOngkir();
      let totalOngkir = 0;

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
          AutoNumeric.getAutoNumericElement(`input[name="items[${idx}][qty]"]`).set(qty + 1)
          initCalculateData(idx);
        });

        $('.quantity-left-minus').click(function (e) {
          e.preventDefault();
          let idx = $(this).data('id');
          let qty = parseInt(AutoNumeric.getAutoNumericElement(`input[name="items[${idx}][qty]"]`).getNumber()) || 0;
          if (qty > 1) {
            AutoNumeric.getAutoNumericElement(`input[name="items[${idx}][qty]"]`).set(qty - 1)
          }
          initCalculateData(idx);
        });
      }

      function initCalculate() {
        $('.autoNumeric, .qty').on('keyup change', function () {
          let id = $(this).parent().parent().parent().attr("id");
          let itemTotalHarga = 0;
          let totalPembelian = 0;
          let totalGram = 0;

          if (id) {
            let split_id = id.split("_");
            let idx = split_id[1];
            let item_id = $(`input[name="items[${idx}][item_id]"]`).val();
            let qty = parseInt(AutoNumeric.getAutoNumericElement(`input[name="items[${idx}][qty]"]`).getNumber()) || 0;
            let harga = parseFloat(AutoNumeric.getAutoNumericElement(`input[name="items[${idx}][price]"]`).getNumber()) || 0;
            let gram = parseFloat(AutoNumeric.getAutoNumericElement(`input[name="items[${idx}][gram]"]`).getNumber()) || 0;
            itemTotalHarga = harga * qty;
            itemTotalGram = gram * qty;
            AutoNumeric.getAutoNumericElement(`input[name="items[${idx}][total_price]"]`).set(itemTotalHarga);
            AutoNumeric.getAutoNumericElement(`input[name="items[${idx}][total_gram]"]`).set(itemTotalGram);

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

          document.querySelectorAll('.total_gram').forEach(function (el) {
            let nameEl = el.getAttribute('name');
            totalGram += parseInt(AutoNumeric.getAutoNumericElement(`input[name="${nameEl}`).getNumber()) || 0;
          });

          totalPembelian += totalOngkir;
          $('#weight').val(totalGram);
          AutoNumeric.getAutoNumericElement(`.total_purchase`).set(totalPembelian);
        });
      }

      function initCalculateData(idx) {
        let itemTotalHarga = 0;
        let totalPembelian = 0;
        let totalGram = 0;

        if (idx) {
          let item_id = $(`input[name="items[${idx}][item_id]"]`).val();
          let qty = parseInt(AutoNumeric.getAutoNumericElement(`input[name="items[${idx}][qty]"]`).getNumber()) || 0;
          let harga = parseFloat(AutoNumeric.getAutoNumericElement(`input[name="items[${idx}][price]"]`).getNumber()) || 0;
          let gram = parseFloat(AutoNumeric.getAutoNumericElement(`input[name="items[${idx}][gram]"]`).getNumber()) || 0;
          itemTotalHarga = harga * qty;
          itemTotalGram = gram * qty;
          AutoNumeric.getAutoNumericElement(`input[name="items[${idx}][total_price]"]`).set(itemTotalHarga);
          AutoNumeric.getAutoNumericElement(`input[name="items[${idx}][total_gram]"]`).set(itemTotalGram);

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

        document.querySelectorAll('.total_gram').forEach(function (el) {
          let nameEl = el.getAttribute('name');
          totalGram += parseInt(AutoNumeric.getAutoNumericElement(`input[name="${nameEl}`).getNumber()) || 0;
        });

        totalPembelian += totalOngkir;
        $('#weight').val(totalGram);
        AutoNumeric.getAutoNumericElement(`.total_purchase`).set(totalPembelian);
      }

      function initStart() {
        let totalPembelian = 0;
        let totalGram = 0;

        document.querySelectorAll('.total_price').forEach(function (el) {
          let nameEl = el.getAttribute('name');
          totalPembelian += parseInt(AutoNumeric.getAutoNumericElement(`input[name="${nameEl}`).getNumber()) || 0;
        });

        document.querySelectorAll('.total_gram').forEach(function (el) {
          let nameEl = el.getAttribute('name');
          console.log(el)
          totalGram += parseInt(AutoNumeric.getAutoNumericElement(`input[name="${nameEl}`).getNumber()) || 0;
        });

        $('#weight').val(totalGram);
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

      function initOngkir() {
        $('#origin_province, #destination_province').select2({
          width: '100%',
          ajax: {
            url: "{{ route('provinces') }}",
            type: 'GET',
            dataType: 'json',
            delay: 250,
            data: function (params) {
              return {
                keyword: params.term
              }
            },
            processResults: function (response) {
              return {
                results: response
              }
            },
          }
        });

        $('#origin_city, #destination_city').select2({width: '100%'});

        $('#origin_province').on('change', function () {
          $('#origin_city').empty();
          $('#origin_city').append('<option>Choose City</option>');
          $('#origin_city').select2('close');
          $('#origin_city').select2({
            ajax: {
              url: "{{ route('cities') }}",
              type: 'GET',
              dataType: 'json',
              delay: 250,
              data: function (params) {
                return {
                  keyword: params.term,
                  province_id: $('#origin_province').val()
                }
              },
              processResults: function (response) {
                return {
                  results: response
                }
              },
            }
          });
        });

        $('#destination_province').on('change', function () {
          $('#destination_city').empty();
          $('#destination_city').append('<option>Choose City</option>');
          $('#destination_city').select2('close');
          $('#destination_city').select2({
            ajax: {
              url: "{{ route('cities') }}",
              type: 'GET',
              dataType: 'json',
              delay: 250,
              data: function (params) {
                return {
                  keyword: params.term,
                  province_id: $('#destination_province').val()
                }
              },
              processResults: function (response) {
                return {
                  results: response
                }
              },
            }
          });
        });

        $('#checkBtn').on('click', function (e) {
          e.preventDefault();
          let origin = $('#origin_city').val();
          let destination = $('#destination_city').val();
          let courier = $('#courier').val();
          let weight = $('#weight').val();
          $.ajax({
            url: "{{ route('check-ongkir') }}",
            type: 'POST',
            dataType: 'json',
            data: {
              _token: "{{ csrf_token() }}",
              origin: origin,
              destination: destination,
              courier: courier,
              weight: weight
            },
            beforeSend: function () {
              $('#checkBtn').html('Loading...');
              $('#checkBtn').attr('disabled', true);
            },
            success: function (response) {
              $('#result').removeClass('d-none');
              $('#checkBtn').html('Cek Ongkir');
              $('#checkBtn').attr('disabled', false);
              $('#result').empty();
              $('#result').append(`
                                <div class="col-12">
                                    <div class="border rounded">
                                        <div class="">
                                            <table class="table table-borderless" style="min-width: 0% !important;">
                                                <thead>
                                                    <tr>
                                                        <th>Service</th>
                                                        <th>Cost</th>
                                                        <th>ETD</th>
                                                        <th>Pilih</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="resultBody">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            `);
              $.each(response, function (i, val) {
                $('#resultBody').append(`
                    <tr>
                        <td>${val.service}</td>
                        <td>${val.cost[0].value}</td>
                        <td>${val.cost[0].etd}</td>
                        <td><button type="button" class="btn btn-primary clickOngkir" style="padding:0 30px" data-cost="${val.cost[0].value}">Pilih</button></td>
                    </tr>
                `);
              });

              $('.clickOngkir').on('click', function (e) {
                e.preventDefault();
                $('#result').addClass('d-none');

                totalOngkir = 0;
                totalOngkir = $(this).data('cost');
                let totalPembelian = 0;
                let grandTotal = 0;

                document.querySelectorAll('.total_price').forEach(function (el) {
                  let nameEl = el.getAttribute('name');
                  totalPembelian += parseInt(AutoNumeric.getAutoNumericElement(`input[name="${nameEl}`).getNumber()) || 0;
                });

                grandTotal = totalPembelian + totalOngkir;
                AutoNumeric.getAutoNumericElement(`.total_ongkir`).set(totalOngkir);
                AutoNumeric.getAutoNumericElement(`.total_ongkir_data`).set(totalOngkir);
                AutoNumeric.getAutoNumericElement(`.total_purchase`).set(totalPembelian);
                AutoNumeric.getAutoNumericElement(`.grand_total`).set(grandTotal);
              });
            },
            error: function (xhr) {
              console.log(xhr.responseText);
            }
          });
        });
      }

    });
  </script>
@endpush
