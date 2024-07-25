<x-auth.layouts.layouts>
    <x-slot name="css">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/auth/login.css') }}">
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
                        <img src="{{ asset('assets/img/logo2.png') }}" alt="Logo Polstat STIS">
                        <span class="d-lg-block">Sistem-3325</span>
                    </span>
                  </div><!-- End Logo -->
                  <div class="card mb-3">
                    <div class="card-body">
                        <div class="pt-4 pb-2">
                            <h5 id="title-login" class="card-title text-center pb-0 fs-4">Masuk</h5>
                            <p class="text-center small">Masukkan Username dan Password Anda</p>
                        </div>
    
                        <form class="row g-3 needs-validation" novalidate method="POST" action="{{ route('login') }}">
                            @csrf
                            <x-elements.input id="inputNip" name="username" placeholder="Username" :value="old('username', $request->username ?? '')" />

                            <x-elements.input-password id="inputPassword" name="password" placeholder="Password" />
    
                            {{-- <div class="col-12 d-flex justify-content-between">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">Ingat Saya</label>
                                </div>
                                <a href="{{ route('password.request') }}" class="text-decoration-none">Lupa Password?</a>
                            </div> --}}
                            <div class="col-12" id="submit-login">
                                <button class="btn btn-primary w-100" type="submit">Masuk</button>
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
        <script type="text/javascript" src="{{ asset('assets/js/auth/login.js') }}"></script>
    </x-slot>
</x-auth.layouts.layouts>
