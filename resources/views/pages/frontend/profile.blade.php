@extends('pages.frontend.template')
@section('content')
  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-7 ftco-animate">
          <form id="formStore" action="{{ $config['form']->action }}" method="POST">
            @method($config['form']->method)
            @csrf
            <h3 class="mb-4 billing-heading">Billing Details</h3>
            <div class="row align-items-end">
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
                  <input type="text" name="name" class="form-control" value="{{ $data['profile']['name'] ?? '' }}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="lastname">No HP</label>
                  <input type="phone" name="phone" class="form-control" value="{{ $data['profile']['profile']['phone'] ?? '' }}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="lastname">Kota</label>
                  <input type="text" name="city" class="form-control" value="{{ $data['profile']['profile']['city'] ?? '' }}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="streetaddress">Alamat</label>
                  <input type="text" name="address" class="form-control" value="{{ $data['profile']['profile']['address'] ?? '' }}">
                </div>
              </div>
              <div class="w-100"></div>
              <div class="w-100"></div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="postcodezip">Kode Pos</label>
                  <input type="text" name="postcode" class="form-control" value="{{ $data['profile']['profile']['postcode'] ?? '' }}">
                </div>
              </div>
              <div class="w-100"></div>
            </div>
            <div class="d-flex justify-content-center">
              <button type="submit" class="btn btn-success">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section> <!-- .section -->

@endsection
@push('script')
  <script>
    $(document).ready(function () {
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
    });
  </script>
@endpush
