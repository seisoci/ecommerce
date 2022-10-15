@extends('pages.frontend.template')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12 ftco-animate fadeInUp ftco-animated">
        <div class="cart-list">
          <table class="table">
            <thead class="thead-primary">
            <tr class="text-center">
              <th>No.</th>
              <th>Barang</th>
              <th>Grand Total</th>
              <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data['purchaseOrder'] ?? [] as $item)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>
                @foreach($item['purchase_order_item'] ?? [] as $itemChild)
                  <p>{{ $itemChild['item']['title'] ?? '' }} - {{ number_format($itemChild['price'] ?? 0, 0,'.',',') ?? '' }} * {{ $itemChild['qty'] ?? '' }}</p>
                @endforeach
              </td>
              <td>{{ number_format($item['grand_total'] ?? 0, 0,'.',',') }}</td>
              <td>{{ ucwords($item['status']) }}</td>
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
                     value="{{ $data['profile']['profile']['name'] ?? '' }}" readonly>
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
@endsection
@push('script')
  <script>
    $(document).ready(function () {
    });
  </script>
@endpush
