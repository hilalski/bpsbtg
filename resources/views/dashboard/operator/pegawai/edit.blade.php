<x-dashboard.layouts.layouts :menu="$menu">
    <x-slot name="css">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dashboard/main.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/form-bau.css') }}">
    </x-slot>

    <x-slot name="js_head">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </x-slot>

    <style>
        .readonly-field {
            background-color: #e9e9e9; 
        }
    </style>

    <section class="section">
        <div class="row">
        <div class="col-lg-12">
            <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-bold fs-3 text-center">Silakan Perbarui Data Pegawai</h5>

                <!-- General Form Elements -->
                <form method="POST" action="{{ route('operator.pegawai.update', $user->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label"
                        >Nama</label
                        >
                        <div class="col-sm-10">
                        <input
                            name="name"
                            value="{{ $user->name }}"
                            type="text"
                            class="form-control readonly-field"
                            readonly
                        />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label"
                        >NIP</label
                        >
                        <div class="col-sm-10">
                        <input
                            name="nip"
                            value="{{ $user->nip }}"
                            type="text"
                            class="form-control readonly-field"
                            readonly
                        />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label"
                        >Username</label
                        >
                        <div class="col-sm-10">
                        <input
                            name="username"
                            value="{{ $user->username }}"
                            type="text"
                            class="form-control readonly-field"
                            readonly
                        />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label"
                        >Nomor Telepon</label
                        >
                        <div class="col-sm-10">
                        <input
                            name="phone_number"
                            value="{{ $user->phone_number }}"
                            type="text"
                            class="form-control"
                            placeholder="Masukkan Nomor Telepon Terbaru"
                        />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="role" class="col-sm-2 col-form-label">Role</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="role" id="role">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" {{ (old('role') ?? $user->role) == $role->name ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </div>
                </form>
                <!-- End General Form Elements -->
            </div>
            </div>
        </div>
        </div>
    </section>
    <x-slot name="js_body">
    </x-slot>
</x-dashboard.layouts.layouts>
