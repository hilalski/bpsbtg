<x-dashboard.layouts.layouts :menu="$menu">
    <x-slot name="css">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dashboard/main.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/form-bau.css') }}">
    </x-slot>

    <x-slot name="js_head">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </x-slot>

    <section class="section">
        <div class="row">
        <div class="col-lg-12">
            <div class="card">
            <div class="card-body">
                <h5 class="card-title">Silakan Update Gaji</h5>

                <!-- General Form Elements -->
                <form method="POST" action="{{ route('updategaji.update', ['id' => $user->id]) }}">
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
                            class="form-control"
                            placeholder="Masukkan nama lengkap dan gelar terbaru"
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
                            value=" {{ $user->nip }} "
                            type="text"
                            class="form-control"
                            placeholder="Masukkan NIP terbaru"
                            readonly
                        />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label"
                        >Gaji</label
                        >
                        <div class="col-sm-10">
                        <input
                            name="gaji"
                            value=" {{ $user->gaji }} "
                            type="text"
                            class="form-control"
                            placeholder="Masukkan Gaji terbaru"
                        />
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </div>


                </form>
                <!-- End General Form Elements -->

                @if(Session::has('success'))
                    <script>
                        swal('Berhasil', '{{ Session::get('success') }}', 'success', {
                            button: {
                                text: "OK",
                                value: true,
                                visible: true,
                                className: "btn-primary",
                                closeModal: true
                            },
                        }).then((value) => {
                            // Redirect ke halaman 'infopengajuansurtug.index' jika tombol OK ditekan
                            if (value) {
                                window.location.href = '{{ route('updategaji.index') }}';
                            }
                        });
                    </script>
                @endif

            </div>
            </div>
        </div>
        </div>
    </section>
    <x-slot name="js_body">
    </x-slot>
</x-dashboard.layouts.layouts>
