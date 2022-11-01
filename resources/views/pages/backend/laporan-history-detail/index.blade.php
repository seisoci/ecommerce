<x-app-layout title='Roles' :config="$config ?? []" :isToastr="true" :isSweetalert="true" :assets="$assets ?? []"
              :isBanner="false" :isFlatpickr="true" >
  <div>
    <div class="row">
      <div class="col-sm-12 col-lg-12">
        <div class="card">
          <div class="card-header justify-content-between">
            <div class="header-title">
              <div class="row">
                <div class="col-sm-12 mb-4">
                  <h4 class="card-title">{{ $config['title'] }} </h4>
                </div>

                <div class="col-sm-4">
                  <div class="d-flex justify-content-between">
                    <div class="form-group">
                      <label class="form-label">Filter Tanggal</label>
                      <div class="input-group">
                        <input class="form-control datePicker" name="tgl_awal"
                               type="text" readonly>
                        <span class="input-group-text" id="basic-addon2">-</span>
                        <input class="form-control datePicker" name="tgl_akhir"
                               type="text" readonly>
                      </div>
                    </div>
                  </div>
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
                  <th>Nama Barang</th>
                  <th>Qty</th>
                  <th>Harga Satuan</th>
                  <th>Harga Total</th>
                  <th>Tgl Transaksi</th>
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
        let dataTable = $('#Datatable').DataTable({
          lengthChange: false,
          buttons: ['pageLength', {
            extend: 'copy',
          }, {
            extend: 'csv',
          }, {
            extend: 'excel',
          }, {
            extend: 'print',
          }, {
            extend: 'pdf',
          },],
          responsive: true,
          serverSide: true,
          processing: true,
          ajax: {
            url: `{{ route('laporan-history-detail.index') }}`,
            data: function (d) {
              d.tgl_awal = $('input[name=tgl_awal]').val();
              d.tgl_akhir = $('input[name=tgl_akhir]').val();
            }
          },

          order: [[5, 'desc']],
          lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
          pageLength: 10,
          columns: [
            {data: 'po.user.name', name: 'po.user.name'},
            {data: 'item.title', name: 'item.title'},
            {
              data: 'qty',
              name: 'qty',
              className: 'text-right',
              render: $.fn.dataTable.render.number(',', '.', 0, '')
            },
            {
              data: 'price',
              name: 'price',
              className: 'text-right',
              render: $.fn.dataTable.render.number(',', '.', 0, '')
            },
            {
              data: 'total_price',
              name: 'total_price',
              className: 'text-right',
              render: $.fn.dataTable.render.number(',', '.', 0, '')
            },
            {data: 'created_at', name: 'created_at'},
          ],
          initComplete: function (settings, json) {
            dataTable.buttons().container().appendTo('#Datatable_wrapper .col-md-6:eq(0)')
          }
        });

        $(".datePicker").flatpickr({
          disableMobile: true,
          dateFormat: 'Y-m-d',
          onChange: function (selectedDates, date_str, instance) {
            dataTable.draw();
          },
          onReady: function (dateObj, dateStr, instance) {
            const $clear = $('<button class="btn btn-danger btn-sm flatpickr-clear mb-2">Clear</button>')
              .on('click', () => {
                instance.clear();
                instance.close();
              })
              .appendTo($(instance.calendarContainer));
          }
        });


      });
    </script>
  @endpush
</x-app-layout>
