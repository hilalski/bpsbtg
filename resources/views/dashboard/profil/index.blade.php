<x-dashboard.layouts.layouts :menu="$menu">
    <x-slot name="css">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/form-bau.css') }}">
    </x-slot>

    <x-slot name="js_head">
    </x-slot>
    
    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div
                    class="card-body profile-card pt-4 d-flex flex-column align-items-center"
                    >
                    {{-- @if($user->picture)
                        <img src="{{ asset('storage/profile_pictures/'.$user->picture) }}" alt="Profile Picture" class="img-fluid rounded-circle" style="width: 100%; height: 100%; object-fit: cover;">
                    @else --}}
                        <i class="bi bi-person-circle" style="font-size: 120px;"></i>
                    {{-- @endif --}}
                    {{-- <h2>Otong Surotong</h2> --}}
                    <h2 class="text-center">{{ auth()->user()->name }}</h2>
                    <h3 class="text-center">{{ auth()->user()->nip }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">
                        <li class="nav-item">
                        <button
                            class="nav-link active"
                            data-bs-toggle="tab"
                            data-bs-target="#profile-overview"
                        >
                            Overview
                        </button>
                        </li>

                        {{-- <li class="nav-item">
                        <button
                            class="nav-link"
                            data-bs-toggle="tab"
                            data-bs-target="#profile-edit"
                        >
                            Edit Profile
                        </button>
                        </li> --}}

                        <li class="nav-item">
                        <button
                            class="nav-link"
                            data-bs-toggle="tab"
                            data-bs-target="#profile-change-password"
                        >
                            Ubah Password
                        </button>
                        </li>
                    </ul>
                    <div class="tab-content pt-2">
                        <div
                        class="tab-pane fade show active profile-overview"
                        id="profile-overview"
                        >
                        <h5 class="card-title">Detail Profil</h5>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Nama Lengkap</div>
                            <div class="col-lg-9 col-md-8">{{ auth()->user()->name }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">NIP</div>
                            <div class="col-lg-9 col-md-8">{{ auth()->user()->nip }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Email</div>
                            <div class="col-lg-9 col-md-8">
                                {{ auth()->user()->email }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Role</div>
                            <div class="col-lg-9 col-md-8">
                                @foreach(auth()->user()->roles as $role)
                                    <button class="btn btn-sm btn-primary disabled">{{ $role->name }}</button>
                                @endforeach
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Alamat</div>
                            <div class="col-lg-9 col-md-8">
                                {{ auth()->user()->address }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">No Telepon</div>
                            <div class="col-lg-9 col-md-8">{{ auth()->user()->phone_number }}</div>
                        </div>
                    </div>

                    <div
                        class="tab-pane fade profile-edit pt-3"
                        id="profile-edit"
                        >
                        <!-- Profile Edit Form -->
                        {{-- <form method="POST" action="{{ route('profil.update') }} " enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="row mb-3">
                                <label
                                    for="profileImage"
                                    class="col-md-4 col-lg-3 col-form-label"
                                    >Gambar Profil</label
                                >
                                <div class="col-md-8 col-lg-9">
                                    <div class="d-flex justify-content-center align-items-center" style="width: 120px; height: 120px; border-radius: 50%;">
                                        @if($user->picture)
                                            <img src="{{ asset('storage/profile_pictures/'.$user->picture) }}" alt="Profile Picture" class="img-fluid rounded-circle" style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            <i class="bi bi-person-circle" style="font-size: 120px;"></i>
                                        @endif
                                    
                                    </div>
                                    <div class="pt-2">
                                        <input type="file" class="form-control mb-2" name="picture" id="profileImage" accept=".jpg, .jpeg, .png">
                                        <img id="previewImage" style="max-width: 120px; max-height: 120px; border-radius: 50%;" />
                                    </div>
                                </div>
                            </div> --}}

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Nama Lengkap</div>
                                <div class="col-lg-9 col-md-8">{{ auth()->user()->name }}</div>
                            </div>
    
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">NIP</div>
                                <div class="col-lg-9 col-md-8">{{ auth()->user()->nip }}</div>
                            </div>
                            
                            <div class="row mb-3">
                                <label
                                    for="email"
                                    class="col-md-4 col-lg-3 col-form-label"
                                    >Email</label
                                >
                                <div class="col-md-8 col-lg-9">
                                    <input
                                    name="email"
                                    type="email"
                                    class="form-control"
                                    id="email"
                                    value="{{ auth()->user()->email }}"
                                    />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Role</div>
                                <div class="col-lg-9 col-md-8">
                                    @foreach(auth()->user()->roles as $role)
                                        <button class="btn btn-sm btn-primary disabled">{{ $role->name }}</button>
                                    @endforeach
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label
                                    for="address"
                                    class="col-md-4 col-lg-3 col-form-label"
                                    >Alamat</label
                                >
                                <div class="col-md-8 col-lg-9">
                                    <textarea
                                    name="address"
                                    class="form-control"
                                    id="address"
                                    style="height: 100px"
                                    >{{ auth()->user()->address }}</textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label
                                    for="phone_number"
                                    class="col-md-4 col-lg-3 col-form-label"
                                    >No Telepon</label
                                >
                                <div class="col-md-8 col-lg-9">
                                    <input
                                    name="phone_number"
                                    type="text"
                                    class="form-control"
                                    id="phone_number"
                                    value="{{ auth()->user()->phone_number }}"
                                    />
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                            </div>
                        {{-- </form> --}}
                        <!-- End Profile Edit Form -->
                        </div>

                        <div class="tab-pane fade pt-3" id="profile-change-password">
                        <!-- Change Password Form -->
                        <form action="{{ route('password.update') }}" method="POST" id="formChangePassword">
                            @csrf
                            @method('PUT')

                            <x-elements.input-password id="inputOldPassword" name="current_password" placeholder="Password Lama" toggle="-1" />

                            <x-elements.input-password id="inputNewPassword" name="password" placeholder="Password Baru" toggle="-2" />

                            <x-elements.input-password id="inputConfirmNewPassword" name="password_confirmation" placeholder="Konfirmasi Password Baru" toggle="-3" />

                            <div class="text-center">
                            <button type="submit" class="btn btn-primary">
                                Ubah Password
                            </button>
                            </div>
                        </form>
                        <!-- End Change Password Form -->
                        </div>
                    </div>
                    <!-- End Bordered Tabs -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-slot name="js_body">
        <script type="text/javascript" src="{{ asset('assets/js/dashboard/profile/change-password-profile.js') }}"></script>
        <script>
            document.getElementById('profileImage').onchange = function (event) {
                var reader = new FileReader();
                reader.onload = function(){
                    var output = document.getElementById('previewImage');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            };
        </script>
    </x-slot>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.input-group-text').forEach(function(toggle) {
                toggle.addEventListener('click', function() {
                    let inputGroup = toggle.closest('.input-group');
                    let passwordInput = inputGroup.querySelector('input');
        
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        toggle.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
                    } else {
                        passwordInput.type = 'password';
                        toggle.innerHTML = '<i class="bi bi-eye-fill"></i>';
                    }
                });
            });
        });
        </script>
        
</x-dashboard.layouts.layouts>