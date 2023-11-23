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
              <th>Resi</th>
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
                  <div class="d-flex">
                    <img class="mr-3" style="border-radius: 30px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);" height="30px" width="30px" src="{{ asset('storage/images/thumbnail') }}/{{ $itemChild['item']['poster'] ?? '' }}" alt="">
                    <a href="{{ route('history.show', $itemChild['item_id']) }}">{{ $itemChild['item']['title'] ?? '' }} - {{ number_format($itemChild['price'] ?? 0, 0,'.',',') ?? '' }} * {{ $itemChild['qty'] ?? '' }}</a>
                  </div>
                @endforeach
              </td>
              <td>{{ $item['resi'] }}</td>
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
