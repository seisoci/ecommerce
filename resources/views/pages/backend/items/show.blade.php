<x-app-layout title='Roles' :config="$config ?? []" :isToastr="true" :isSweetalert="true" :assets="$assets ?? []"
              :isBanner="false">
  <div>
    <div class="row">
      <div class="col-sm-12 col-lg-12">
        <a onclick="history.back()" class="btn btn-primary mb-2"><svg class="svg-inline--fa fa-rotate-left" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="rotate-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M480 256c0 123.4-100.5 223.9-223.9 223.9c-48.84 0-95.17-15.58-134.2-44.86c-14.12-10.59-16.97-30.66-6.375-44.81c10.59-14.12 30.62-16.94 44.81-6.375c27.84 20.91 61 31.94 95.88 31.94C344.3 415.8 416 344.1 416 256s-71.69-159.8-159.8-159.8c-37.46 0-73.09 13.49-101.3 36.64l45.12 45.14c17.01 17.02 4.955 46.1-19.1 46.1H35.17C24.58 224.1 16 215.5 16 204.9V59.04c0-24.04 29.07-36.08 46.07-19.07l47.6 47.63C149.9 52.71 201.5 32.11 256.1 32.11C379.5 32.11 480 132.6 480 256z"></path></svg><!-- <i class="fa-solid fa-rotate-left"></i> --> Kembali</a>
        <div class="card">
          <div class="card-header justify-content-between">
            <div class="header-title">
              <div class="row">
                <div class="col-sm-6 col-lg-6">
                  <h4 class="card-title">Data {{ $config['title'] ?? '' }} </h4>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="dataTable" class="table table-bordered w-100">
                <thead>
                <tr>
                  <th>Komentar</th>
                  <th>Rating</th>
                  <th>Tgl Rating</th>
                </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@push('scripts')
    <script>
      $(document).ready(function () {
        $('#dataTable').dataTable({
          responsive: true,
          serverSide: true,
          processing: true,
          ajax: {url: `{{ url()->current() }}`},
          order: [[2, 'desc']],
          lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
          pageLength: 10,
          columns: [
            {data: 'description', name: 'description'},
            {data: 'score', name: 'score', width: '50px', className: 'text-center'},
            {data: 'created_at', name: 'created_at', width: '100px'},
          ],
        });
      });
    </script>
  @endpush
</x-app-layout>
