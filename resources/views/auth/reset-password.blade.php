<x-auth.layouts.layouts>
    <x-slot name="css">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/form-bau.css') }}">
    </x-slot>
    
    <main>
        <div class="container">
          <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-xl-5 col-lg-6 col-md-8 d-flex flex-column align-items-center justify-content-center">
                  <div class="d-flex justify-content-center py-4">
                    <span class="logo d-flex align-items-center w-auto">
                      <img src="{{ asset('assets/img/logo.png') }}" alt="Logo Polstat STIS">
                      <span class="d-lg-block">SIAGA-U</span>
                    </span>
                  </div><!-- End Logo -->
                  <div class="card mb-3">
                    <div class="card-body">
                        <div class="pt-4 pb-2">
                            <h5 id="title-login" class="card-title text-center pb-0 fs-4">Reset Password</h5>
                            <p class="text-center small">Masukkan Kata Sandi Baru Anda</p>
                        </div>

                        <div id="alert-bau">
                            @if (session('status'))
                                <x-elements.alert type="success" title="Success">
                                    {{ session('status') }}
                                </x-elements.alert>
                            @endif
                            
                            @if ($errors->any())
                                <x-elements.alert type="danger" title="Error">
                                    {{ $errors->first() }}
                                </x-elements.alert>
                            @endif
                        </div>
                         
                        <form class="row g-3 needs-validation" novalidate method="POST" action="{{ route('password.store') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <input type="hidden" name="email" value="{{ $request->email }}">

                            <x-elements.input id="inputEmail" placeholder="Email" :value="old('email', $request->email ?? '')" disabled />

                            <x-elements.input-password id="inputNewPassword" name="password" placeholder="Password" toggle="-1" />

                            <x-elements.input-password id="inputConfirmNewPassword" name="password_confirmation" placeholder="Password" toggle="-2" />
    
                            <div class="col-12" id="submit-login">
                                <button class="btn btn-primary w-100" type="submit">Ubah Password</button>
                            </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </main><!-- End #main -->
    
    <x-slot name="js">
        <script type="text/javascript" src="{{ asset('assets/js/auth/reset-password.js') }}"></script>
    </x-slot>
</x-auth.layouts.layouts>
