<x-app-layout title='Form Elements' :config="$config ?? []" :assets="$assets ?? []" :isBanner="false" :isToastr="true"
              :isSelect2="true" :isFlatpickr="true" :isCkeditor="true">
  <div>
    <form id="formStore" action="{{ $config['form']->action }}" method="POST">
      @method($config['form']->method)
      @csrf
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
                      <button type="submit" class="btn btn-sm btn-primary">Simpan <i
                          class="fa-solid fa-floppy-disk"></i></button>
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
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-8">
                  <input type="hidden" name="type" value="posts">
                  <div class="form-group">
                    <label>Judul</label>
                    <input type="text" name="title" class="form-control" value="{{ $data['title'] ?? '' }}">
                  </div>
                  <div class="editor-container">
                    <textarea name="description" id="editor">{{ $data['description'] ?? '' }}</textarea>
                  </div>
                </div>
                <div class="col-sm-12 col-md-4">
                  <div class="form-group">
                    <label for="">Tanggal</label>
                    <div class="input-group">
                      <span class="input-group-text" id="created_at"><i class="fa-regular fa-calendar"></i></span>
                      <input type="text" name="created_at" class="form-control" aria-describedby="publish_at"
                             value="{{ isset($data['created_at']) ? $data['created_at'] : \Carbon\Carbon::now()->toDateTimeString() }}"
                             readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Stok Barang</label>
                    <input type="text" name="qty" class="form-control" value="{{ $data['qty'] ?? '' }}">
                  </div>
                  <div class="form-group">
                    <label>Kategori</label>
                    <select id="select2CategoryItem" class="form-control" name="category_item_id">
                      @if(isset($data['category_item_id']))
                        <option value="{{ $data['category_item_id'] ?? '' }}">{{ $data['category']['name'] ?? '' }}</option>
                      @endif
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="mx-0 text-bold d-block">Gambar Cover</label>
                    <img src="{{ isset($data['poster']) ? asset("storage/images/original/{$data['poster']}")   : asset('images/no-content.svg') }}"
                         style="object-fit: cover; border: 1px solid #d9d9d9" class="mb-2 border-2 mx-auto"
                         height="200px"
                         width="100%" alt="">
                    <input type="file" class="image d-block" name="poster" accept=".jpg, .jpeg, .png">
                    <p class="text-muted ms-75 mt-50"><small>Allowed JPG, JPEG or PNG. Max
                        size of
                        5MB</small></p>
                  </div>
                  <div class="form-group">
                    <label for="">Status</label>
                    <div class="custom-controls-stacked">
                      <label class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" name="published" value="0" {{ isset($data['published']) && $data['published'] == 0 ? 'checked' : ''  }}>
                        <span class="custom-control-label">Draft</span>
                      </label>
                      <label class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" name="published" value="1" {{ isset($data['published']) && $data['published'] == 1 ? 'checked' : ''  }}>
                        <span class="custom-control-label">Publish</span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
           {{--   <div class="row">
                <div class="col-md-3 items" id="items_1">
                  <div class="form-group">
                    <label class="mx-0 text-bold d-block">Isi Gambar</label>
                    <img src="{{ asset('images/no-content.svg') }}"
                         style="
                     background-size: cover;
                     background-position: center center;
                     border: 1px solid #d9d9d9"
                         class="mb-2 border-2 mx-auto"
                         height="150px"
                         width="225px">
                    <input type="file" class="image d-block" name="post_items[]" accept=".jpg, .jpeg, .png">
                    <p class="text-muted ms-75 mt-50"><small>Allowed JPG, JPEG or PNG. Max
                        size of
                        5MB</small></p>
                  </div>
                </div>
                <div class="d-flex justify-content-start pt-2">
                  <button type="button" id="btnAddPhoto" class="btn btn-sm btn-success">Tambah Gambar</button>
                </div>
              </div>--}}
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
  @push('head')
    <style>
      .ck-editor__editable {
        min-height: 300px;
      }

      .grid-square {
        position: relative;
        width: 150px;
        height: 150px;
        display: inline-block;
        background-color: #fff;
        border: solid 1px rgb(0, 0, 0, 0.2);
        margin: 12px;
      }

      .btnDeletePhoto {
        position: absolute;
        top: 4px;
        right: 4px;
      }
    </style>
  @endpush
  @push('scripts')
    <script>
      $(document).ready(function () {
        initImage();
        ClassicEditor.create(document.querySelector("#editor"), {
          ckfinder: {
            uploadUrl: '{{route('items.uploadimagecke').'?_token='.csrf_token()}}'
          },
          toolbar: {
            shouldNotGroupWhenFull: true
          }
        });

        $("#formStore").submit(function (e) {
          e.preventDefault();
          let form = $(this);
          let btnSubmit = form.find("[type='submit']");
          let btnSubmitHtml = btnSubmit.html();
          let url = form.attr("action");
          let data = new FormData(this);
          $.ajax({
            cache: false,
            processData: false,
            contentType: false,
            type: "POST",
            url: url,
            data: data,
            beforeSend: function () {
              btnSubmit.addClass("disabled").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...').prop("disabled", "disabled");
            },
            success: function (response) {
              let errorCreate = $('#errorCreate');
              errorCreate.css('display', 'none');
              errorCreate.find('.alert-text').html('');
              btnSubmit.removeClass("disabled").html(btnSubmitHtml).removeAttr("disabled");
              if (response.status === "success") {
                toastr.success(response.message, 'Success !');
                setTimeout(function () {
                  if (response.redirect === "" || response.redirect === "reload") {
                    location.reload();
                  } else {
                    location.href = response.redirect;
                  }
                }, 1000);
              } else {
                toastr.error((response.message ? response.message : "Please complete your form"), 'Failed !');
                if (response.error !== undefined) {
                  errorCreate.removeAttr('style');
                  $.each(response.error, function (key, value) {
                    errorCreate.find('.alert-text').append('<span style="display: block">' + value + '</span>');
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

        $('#select2CategoryItem').select2({
          dropdownParent: $('#select2CategoryItem').parent(),
          placeholder: "Cari Kategori",
          allowClear: true,
          ajax: {
            url: "{{ route('category-items.select2') }}",
            dataType: "json",
            cache: true,
            data: function (e) {
              return {
                q: e.term || '',
                page: e.page || 1
              }
            },
          },
        });

        $('#btnAddPhoto').on('click', function () {
          let totalItems = $(".items").length;
          if (totalItems < 100) {
            let lastid = $(".items:last").attr("id");
            let split_id = lastid.split("_");
            let nextindex = Number(split_id[1]) + 1;
            $(".items:last").after($(`<div class="col-md-3 items" id="items_${nextindex}">`).append(
              $(`<div class='form-group'>`).append(
                $(`<label class="mx-0 text-bold d-block">Gambar</label>`),
                $(`<img src="{{ asset('assets/img/svgs/no-content.svg') }}" style="background-size: cover; background-position: center center; border: 1px solid #d9d9d9" class="mb-2 border-2 mx-auto" height="150" width="150px">`),
                $(`<input type="file" class="image d-block" name="post_items[]" accept=".jpg, .jpeg, .png">`),
                $(`<p class="text-muted ms-75 mt-50 mb-0"><small>Allowed JPG, JPEG or PNG. Max size of 5MB</small></p>`),
                $(`<button type="button" class="btn btn-sm btn-danger btnDelete">Hapus</button>`),
              )
            ));
            initImage();
          } else {
            toastr.error('Maksimal Upload 100 Gambar', 'Failed !');
          }
        });
        $('div').on('click', '.btnDelete', function () {
          let id = $(this).parent().parent().attr("id");
          let split_id = id.split("_");
          let deleteindex = split_id[1];
          $("#items_" + deleteindex).remove();
        });

        function initImage() {
          $(".image").change(function () {
            let thumb = $(this).parent().find('img');
            thumb.attr('src', '{{ asset('assets/img/svgs/no-content.svg') }}');
            if (this.files && this.files[0]) {
              let reader = new FileReader();
              reader.onload = function (e) {
                thumb.attr('src', e.target.result);
              }
              reader.readAsDataURL(this.files[0]);
            }
          });
        };

        $(".image").change(function () {
          let thumb = $(this).parent().find('img');
          if (this.files && this.files[0]) {
            let reader = new FileReader();
            reader.onload = function (e) {
              thumb.attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
          }
        });


        $('input[name="publish_at"]').flatpickr({
          enableTime: true,
          dateFormat: "Y-m-d H:i:s",
          time_24hr: true,
        });
      });
    </script>
  @endpush
</x-app-layout>
