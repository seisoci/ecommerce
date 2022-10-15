@extends('pages.frontend.template')
@section('content')
  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-12 ftco-animate">
          <h3 class="mb-4 billing-heading text-center">Pembayaran Detail</h3>
          <h6 class="mb-4 text-center">{{ number_format($grandTotal ?? 0, 0,'.',',') }}</h6>
          <h6 class="mb-4 text-center">Silakan Lakukan pembayan ke nomor rekening dibawah dan lakukan konfirmasi ke no hp: <b>08123456</b></h6>
          <div class="row align-items-end">
            <div class="col-md-4">
              <div class="card">
                <div class="card-header">
                  <h6 class="text-center">Bank BCA</h6>
                </div>
                <div class="card-body">
                  123456789
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card">
                <div class="card-header">
                  <h6 class="text-center">Bank BNI</h6>
                </div>
                <div class="card-body">
                  123456789
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card">
                <div class="card-header">
                  <h6 class="text-center">Bank BSI</h6>
                </div>
                <div class="card-body">
                  123456789
                </div>
              </div>
            </div>
          </div>
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
