@extends('pages.frontend.template')
@section('content')
  <section class="ftco-section ftco-cart">
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
                <tr class="text-center">
                  <td class="product-remove"><a href="#"><span class="ion-ios-close"></span></a></td>
                  <td class="image-prod">
                    <div class="img" style="background-image:url('{{ asset('storage/images/thumbnail') }}/{{ $item['item']['poster'] ?? '' }}');"></div>
                  </td>
                  <td class="product-name">
                    <h3>{{ $item['item']['title'] }}</h3>
                  </td>
                  <td class="price">Rp. {{ number_format($item['item']['price'],0,'.',',') }}</td>
                  <td class="quantity">
                    <div class="input-group mb-3">
                      <input type="text" name="items[{{ $loop->iteration }}][qty]" class="quantity form-control input-number" value="1" min="1"
                             max="100">
                    </div>
                  </td>
                  <input type="hidden" value=name="items[{{ $loop->iteration }}][price]">
                  <input type="hidden" value=name="items[{{ $loop->iteration }}][total]">
                  <td class="total">Rp. {{ number_format($item['item']['price'] * $item['qty'],0,'.',',') }}</td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="row justify-content-end">
        <div class="col-xl-8 mt-5 cart-wrap ftco-animate fadeInUp ftco-animated">
          <form id="formStore" action="{{ $config['form']->action }}" method="POST">
            @method($config['form']->method)
            @csrf
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
                  <input type="text" name="name" class="form-control" value="{{ $data['profile']['profile']['name'] ?? '' }}" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="lastname">No HP</label>
                  <input type="phone" name="phone" class="form-control" value="{{ $data['profile']['profile']['phone'] ?? '' }}" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="lastname">Kota</label>
                  <input type="text" name="city" class="form-control" value="{{ $data['profile']['profile']['city'] ?? '' }}" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="streetaddress">Alamat</label>
                  <input type="text" name="address" class="form-control" value="{{ $data['profile']['profile']['address'] ?? '' }}" readonly>
                </div>
              </div>
              <div class="w-100"></div>
              <div class="w-100"></div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="postcodezip">Kode Pos</label>
                  <input type="text" name="postcode" class="form-control" value="{{ $data['profile']['profile']['postcode'] ?? '' }}" readonly>
                </div>
              </div>
              <div class="w-100"></div>
            </div>
          </form>
        </div>
        <div class="col-lg-4 mt-5 cart-wrap ftco-animate fadeInUp ftco-animated">
          <div class="cart-total mb-3">
            <h3>Cart Totals</h3>
            <p class="d-flex">
              <span>Subtotal</span>
              <span>$20.60</span>
            </p>
            <hr>
            <p class="d-flex total-price">
              <span>Total</span>
              <span>$17.60</span>
            </p>
          </div>
          <p><button type="submit" class="btn btn-primary py-3 px-4">Proceed to Checkout</button></p>
        </div>
      </div>
    </div>
  </section>
@endsection
@push('script')
  <script>
    $(document).ready(function () {

    });
  </script>
@endpush
