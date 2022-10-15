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
  </div>
@endsection
@push('script')
  <script>
    $(document).ready(function () {
    });
  </script>
@endpush
