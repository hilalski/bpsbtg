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
                            <h5 id="title-login" class="card-title text-center pb-0 fs-4">Lupa Password</h5>
                            <p class="text-center small">Masukkan Email Anda untuk Mereset Kata Sandi Anda</p>
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
                           
                        <form class="row g-3 needs-validation" novalidate method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <x-elements.input id="inputEmail" name="email" placeholder="Email" :value="old('email', $request->email ?? '')" />

                            <div class="col-12" id="submit-forgot-password">
                                <button class="btn btn-primary w-50" type="submit">Kirim Email Reset Password</button>
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
        <script type="text/javascript" src="{{ asset('assets/js/auth/forgot-password.js') }}"></script>
    </x-slot>
</x-auth.layouts.layouts>
