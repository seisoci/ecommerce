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
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="Datatable" class="table table-bordered w-100">
                <thead>
                <tr>
                  <th>Nama Pembeli</th>
                  <th>Grand Total</th>
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
  {{--  Modal --}}
  <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalmodalEdit" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ubah</h5>
          <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
        </div>
        <form id="formUpdate" action="#">
          @method('PUT')
          <meta name="csrf-token" content="{{ csrf_token() }}">
          <div class="modal-body">
            <div id="errorEdit" class="form-control" style="display:none;">
              <div class="alert alert-danger" role="alert">
                <div class="alert-text">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Status <span class="text-danger">*</span></label>
              <select name="status" class="form-select">
                <option value="pending">Pending</option>
                <option value="success">Berhasil</option>
                <option value="cancel">Gagal</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  @push('scripts')
    <script>
      $(document).ready(function () {
        let modalEdit = document.getElementById('modalEdit');
        const bsEdit = new bootstrap.Modal(modalEdit);
        let dataTable = $('#Datatable').DataTable({
          responsive: true,
          serverSide: true,
          processing: true,
          ajax: {url: `{{ route('backend.history.index') }}`},
          order: [[3, 'desc']],
          lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
          pageLength: 10,
          columns: [
            {data: 'user.name', name: 'user.name'},
            {
              data: 'grand_total',
              name: 'grand_total',
              className: 'text-right',
              render: $.fn.dataTable.render.number(',', '.', 0, '')
            },
            {
              data: 'status',
              name: 'status',
              className: 'text-center',
              render: function (data, type, full, meta) {
                let status = {
                  'pending': {'title': 'Pending', 'class': ' bg-primary'},
                  'success': {'title': 'Berhasil', 'class': ' bg-success'},
                  'cancel': {'title': 'Gagal', 'class': ' bg-danger'},
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

        modalEdit.addEventListener('show.bs.modal', function (event) {
          let status = event.relatedTarget.getAttribute('data-bs-status');
          $('select[name=status]').val(status);
          this.querySelector('#formUpdate').setAttribute('action', '{{ route("backend.history.index") }}/' + event.relatedTarget.getAttribute('data-bs-id'));
        });
        modalEdit.addEventListener('hidden.bs.modal', function (event) {
          $('select[name=status]').val('');
          this.querySelector('#formUpdate').setAttribute('href', '');
        });

        $("#formUpdate").submit(function (e) {
          e.preventDefault();
          let form = $(this);
          let btnSubmit = form.find("[type='submit']");
          let btnSubmitHtml = btnSubmit.html();
          let url = form.attr("action");
          let data = new FormData(this);
          $.ajax({
            beforeSend: function () {
              btnSubmit.addClass("disabled").html("<i class='spinner-border spinner-border-sm font-size-16 align-middle me-2'></i> Loading ...").prop("disabled", "disabled");
            },
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            cache: false,
            processData: false,
            contentType: false,
            type: "POST",
            url: url,
            data: data,
            success: function (response) {
              let errorEdit = $('#errorEdit');
              errorEdit.css('display', 'none');
              errorEdit.find('.alert-text').html('');
              btnSubmit.removeClass("disabled").html(btnSubmitHtml).removeAttr("disabled");
              if (response.status === "success") {
                toastr.success(response.message, 'Success !');
                bsEdit.hide();
                dataTable.draw();
              } else {
                toastr.error((response.message ? response.message : "Gagal mengubah data"), 'Failed !');
                if (response.error !== undefined) {
                  errorEdit.removeAttr('style');
                  $.each(response.error, function (key, value) {
                    errorEdit.find('.alert-text').append('<span style="display: block">' + value + '</span>');
                  });
                }
              }
            },
            error: function (response) {
              btnSubmit.removeClass("disabled").html(btnSubmitHtml).removeAttr("disabled");
              toastr.error(response.responseJSON.message, 'Failed !');
            }
          });
        });

      });
    </script>
  @endpush
</x-app-layout>
