<x-app-layout title='Form Elements' :config="$config ?? []" :assets="$assets ?? []" :isBanner="false" :isToastr="true"
              :isSelect2="true">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header justify-content-between">
          <div class="header-title">
            <div class="row">
              <div class="col-sm-6 col-lg-6">
                <h4 class="card-title">{{ $config['title'] }}</h4>
              </div>
              <div class="col-sm-6 col-lg-6">
                <div class="btn-group float-end" role="group" aria-label="Basic outlined example">
                  <a onclick="history.back()" class="btn btn-sm btn-outline-primary"><i
                      class="fa-solid fa-rotate-left"></i> Kembali</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="form-group">
            <div id="errorCreate" class="mb-3" style="display:none;">
              <div class="alert alert-danger" role="alert">
                <div class="alert-icon"><i class="flaticon-danger text-danger"></i></div>
                <div class="alert-text">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label col-sm-3 align-self-center mb-0" for="old_password">Email</label>
                  <div class="col-sm-9">
                    <h6>: {{ $data['user']['email'] ?? '' }}</h6>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label col-sm-3 align-self-center mb-0" for="old_password">Username</label>
                  <div class="col-sm-9">
                    <h6>: {{ $data['user']['username'] ?? '' }}</h6>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label col-sm-3 align-self-center mb-0" for="old_password">Nama Lengkap</label>
                  <div class="col-sm-9">
                    <h6>: {{ $data['user']['name'] ?? '' }}</h6>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label col-sm-3 align-self-center mb-0" for="old_password">No HP</label>
                  <div class="col-sm-9">
                    <h6>: {{ $data['user']['profile']['phone'] ?? '' }}</h6>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label col-sm-3 align-self-center mb-0" for="old_password">Kota</label>
                  <div class="col-sm-9">
                    <h6>: {{ $data['user']['profile']['city'] ?? '' }}</h6>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label col-sm-3 align-self-center mb-0" for="old_password">Alamat</label>
                  <div class="col-sm-9">
                    <h6>: {{ $data['user']['profile']['address'] ?? '' }}</h6>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label col-sm-3 align-self-center mb-0" for="old_password">Kode Pos</label>
                  <div class="col-sm-9">
                    <h6>: {{ $data['user']['profile']['postcode'] ?? '' }}</h6>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="table table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>No.</th>
                      <th>Gambar</th>
                      <th>Nama Barang</th>
                      <th>Haga</th>
                      <th>Jumlah</th>
                      <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data['purchase_order_item'] ?? [] as $item)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="image-prod">
                          <img src="{{ asset('storage/images/thumbnail') }}/{{ $item['item']['poster'] ?? '' }}" height="200px" width="200px"></img>
                        </td>
                        <td>{{ $item['item']['title'] ?? '' }}</td>
                        <td class="text-end">{{ number_format($item['item']['price'] ?? 0,0,'.',',') }}</td>
                        <td class="text-center">{{ $item['qty'] ?? '' }}</td>
                        <td class="text-end">{{ number_format(($item['qty'] ?? 1) * ($item['item']['price']),0,'.',',') }}</td>
                      </tr>
                    @endforeach
                    </tbody>
                    <thead>
                    <tr>
                      <td colspan="5" class="text-end">Total Ongkir</td>
                      <td class="text-end">{{ number_format($data['total_ongkir'] ?? 0,0,'.',',') }}</td>
                    </tr>
                    <tr>
                      <td colspan="5" class="text-end">Total Pembelian</td>
                      <td class="text-end">{{ number_format($data['total_pembelian'] ?? 0,0,'.',',') }}</td>
                    </tr>
                      <tr>
                        <td colspan="5" class="text-end">Grand Total</td>
                        <td class="text-end">{{ number_format($data['grand_total'] ?? 0,0,'.',',') }}</td>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @push('scripts')
    <script>
      $(document).ready(function () {
      });
    </script>
  @endpush
</x-app-layout>
