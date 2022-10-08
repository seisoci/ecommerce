<x-app-layout title='Roles' :config="$config ?? []" :isToastr="true" :isSweetalert="true" :assets="$assets ?? []"
              :isBanner="false">
  <div>
    <div class="row">
      <div class="col-sm-12 col-lg-12">
        <div class="card">
          <div class="card-header justify-content-between">
            <div class="header-title">
              <div class="row">
                <div class="col-sm-6 col-lg-6">
                  <h4 class="card-title">Data {{ $config['title'] ?? '' }} </h4>
                </div>
                <div class="col-sm-6 col-lg-6">
                  <a href="{{ route('items.create') }}" class="btn btn-primary float-end">
                    <i class="fa-solid fa-plus"></i> Tambah
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="dataTable" class="table table-bordered w-100">
                <thead>
                <tr>
                  <th>Cover</th>
                  <th>Judul</th>
                  <th>Stok</th>
                  <th>Kategori</th>
                  <th>Status</th>
                  <th>Tgl Dibuat</th>
                  <th data-priority="1">Aksi</th>
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
          ajax: {url: `{{ route('items.index') }}`},
          order: [[5, 'desc']],
          lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
          pageLength: 10,
          columns: [
            {
              data: 'poster',
              name: 'poster',
              render: function (data, type, full, meta) {
                if (data !== null) {
                  return `<img src="/storage/images/thumbnail/${data}" style="max-width:100px; max-height: 100px;">`
                }
                return `<img src="/images/no-content.svg" style="max-width:100px; max-height: 100px;">`
              },
            },
            {data: 'title', name: 'title'},
            {data: 'qty', name: 'qty', className: 'text-center'},
            {data: 'category.name', name: 'category.name'},
            {
              data: 'published',
              name: 'published',
              className: 'text-center',
              render: function (data, type, full, meta) {
                let status = {
                  0: {'title': 'Draft', 'class': ' bg-primary'},
                  1: {'title': 'Published', 'class': ' bg-success'},
                };
                if (typeof status[data] === 'undefined') {
                  return data;
                }
                return '<span class="badge bg-pill' + status[data].class + '">' + status[data].title +
                  '</span>';
              },
            },
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
          ],
          rowCallback: function (row, data) {
            let api = this.api();
            $(row).find('.btn-delete').click(function () {
              let pk = $(this).data('id'),
                url = `{{ route("users.index") }}/` + pk;
              Swal.fire({
                title: "Anda Yakin ?",
                text: "Data tidak dapat dikembalikan setelah di hapus!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Tidak, Batalkan",
              }).then((result) => {
                if (result.value) {
                  $.ajax({
                    url: url,
                    type: "DELETE",
                    data: {
                      _token: '{{ csrf_token() }}',
                      _method: 'DELETE'
                    },
                    error: function (response) {
                      toastr.error(response, 'Failed !');
                    },
                    success: function (response) {
                      if (response.status === "success") {
                        toastr.success(response.message, 'Success !');
                        api.draw();
                      } else {
                        toastr.error((response.message ? response.message : "Please complete your form"), 'Failed !');
                      }
                    }
                  });
                }
              });
            });
          }
        });

      });
    </script>
  @endpush
</x-app-layout>
