<x-guest-layout>
  <section class="login-content">
    <div class="row m-0 align-items-center bg-white h-100">
      <div class="col-md-6">
        <div class="row justify-content-center">
          <div class="col-md-10">
            <div class="card card-transparent shadow-none d-flex justify-content-center mb-0 auth-card iq-auth-form">
              <div class="card-body">
                <h2 class="mb-2 text-center">Registrasi</h2>
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form method="POST" action="{{ route('home.register') }}" data-toggle="validator" class="">
                  {{ csrf_field() }}
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label for="email" class="form-label">Nama Lengkap</label>
                        <input id="email" type="text" name="name"  value="{{ old('name') }}"   class="form-control"  placeholder="guest" required autofocus>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="text" name="email"  value="{{ old('email') }}"   class="form-control"  placeholder="guest@example.com" required autofocus>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label for="email" class="form-label">Username</label>
                        <input id="email" type="text" name="username"  value="{{ old('username') }}"   class="form-control"  placeholder="guest" required autofocus>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input class="form-control" type="password" placeholder="********"  name="password" required autocomplete="current-password">
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label for="password" class="form-label">Ulangi Password</label>
                        <input class="form-control" type="password" placeholder="********"  name="password_confirmation" required autocomplete="current-password">
                      </div>
                    </div>
                  </div>
                  <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">{{ __('Registrasi') }}</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="sign-bg">
          <svg width="280" height="230" viewBox="0 0 431 398" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g opacity="0.05">
              <rect x="-157.085" y="193.773" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 -157.085 193.773)" fill="#3B8AFF"/>
              <rect x="7.46875" y="358.327" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 7.46875 358.327)" fill="#3B8AFF"/>
              <rect x="61.9355" y="138.545" width="310.286" height="77.5714" rx="38.7857" transform="rotate(45 61.9355 138.545)" fill="#3B8AFF"/>
              <rect x="62.3154" y="-190.173" width="543" height="77.5714" rx="38.7857" transform="rotate(45 62.3154 -190.173)" fill="#3B8AFF"/>
            </g>
          </svg>
        </div>
      </div>
      <div class="col-md-6 d-md-block d-none bg-primary p-0 mt-n1 vh-100 overflow-hidden">
        <img src="{{asset('images/auth/01.png')}}" class="img-fluid gradient-main animated-scaleX" alt="images">
      </div>
    </div>
  </section>
  @push('scripts')
    <script>
      $(document).ready(function(){
        $('[data-change="email"]').on('change', function(){
          const role = $(this).val();
          const isDemo = $(this).attr('data-demo');
          if(isDemo === 'true') {
            if(role == 'admin'){
              $('#email').val('admin@example.com')
            }else if(role == 'user'){
              $('#email').val('user@example.com')
            }else if(role == 'demo_admin'){
              $('#email').val('demo@example.com')
            }
          }
        });
      });
    </script>
  @endpush

</x-guest-layout>
