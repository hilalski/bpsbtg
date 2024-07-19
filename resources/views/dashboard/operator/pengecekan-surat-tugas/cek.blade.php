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
                <h5 class="card-title">Silakan Cek dan Lengkapi Surat Tugas Berikut Ini</h5>

                <!-- General Form Elements -->
                <form method="POST" action="{{ route('pengecekansurtug.update', ['id' => $detailPengecekanSuratTugas->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label"
                        >Nama</label
                        >
                        <div class="col-sm-10">
                        <input
                            name="name"
                            value="{{ $detailPengecekanSuratTugas->name }}"
                            type="text"
                            class="form-control"
                            placeholder="Masukkan nama lengkap dan gelar Anda"
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
                            value="{{ $detailPengecekanSuratTugas->nip }}"
                            type="text"
                            class="form-control"
                            placeholder="Masukkan NIP Anda"
                            pattern="[0-9]+"
                            title="NIP hanya boleh berisi angka"
                        />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Golongan</label>
                        <div class="col-sm-10">
                            <select
                                name="golongan"
                                class="form-select"
                                aria-label="Default select example"
                            >
                                <option selected>Pilih golongan</option>
                                <option value="II/A" {{ $detailPengecekanSuratTugas->golongan == 'II/A' ? 'selected' : '' }} >II/A</option>
                                <option value="II/B" {{ $detailPengecekanSuratTugas->golongan == 'II/B' ? 'selected' : '' }} >II/B</option>
                                <option value="II/C" {{ $detailPengecekanSuratTugas->golongan == 'II/C' ? 'selected' : '' }} >II/C</option>
                                <option value="II/D" {{ $detailPengecekanSuratTugas->golongan == 'II/D' ? 'selected' : '' }} >II/D</option>
                                <option value="III/A" {{ $detailPengecekanSuratTugas->golongan == 'III/A' ? 'selected' : '' }} >III/A</option>
                                <option value="III/B" {{ $detailPengecekanSuratTugas->golongan == 'III/B' ? 'selected' : '' }} >III/B</option>
                                <option value="III/C" {{ $detailPengecekanSuratTugas->golongan == 'III/C' ? 'selected' : '' }} >III/C</option>
                                <option value="III/D" {{ $detailPengecekanSuratTugas->golongan == 'III/D' ? 'selected' : '' }} >III/D</option>
                                <option value="IV/A" {{ $detailPengecekanSuratTugas->golongan == 'IV/A' ? 'selected' : '' }} >IV/A</option>
                                <option value="IV/B" {{ $detailPengecekanSuratTugas->golongan == 'IV/B' ? 'selected' : '' }} >IV/B</option>
                                <option value="IV/C" {{ $detailPengecekanSuratTugas->golongan == 'IV/C' ? 'selected' : '' }} >IV/C</option>
                                <option value="IV/D" {{ $detailPengecekanSuratTugas->golongan == 'IV/D' ? 'selected' : '' }}>IV/D</option>
                                <option value="IV/E" {{ $detailPengecekanSuratTugas->golongan == 'IV/E' ? 'selected' : '' }} >IV/E</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label"
                        >Jabatan</label
                        >
                        <div class="col-sm-10">
                        <input
                            name="jabatan"
                            value="{{ $detailPengecekanSuratTugas->jabatan }}"
                            type="text"
                            class="form-control"
                            placeholder="Masukkan jabatan Anda sesuai sk penyelenggara akademik"
                        />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label"
                        >Nama Kegiatan</label
                        >
                        <div class="col-sm-10">
                        <input
                            name="nama_kegiatan"
                            value="{{ $detailPengecekanSuratTugas->nama_kegiatan }}"
                            type="text"
                            class="form-control"
                            placeholder="Masukkan nama kegiatan"
                        />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label"
                        >Lokasi</label
                        >
                        <div class="col-sm-10">
                        <input
                            name="lokasi"
                            value="{{ $detailPengecekanSuratTugas->lokasi }}"
                            type="text"
                            class="form-control"
                            placeholder="Masukkan lokasi perjalanan dinas (e.g. Surabaya, Jawa Timur)"
                        />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputDate" class="col-sm-2 col-form-label">Tanggal Perjalanan Dinas</label>
                        <div class="col-sm-10">
                            <div class="col-sm-11">
                                <input name="tanggal_perdin_mulai" type="date" class="form-control1" id="tanggal_mulai" />
                                <h6>s.d.</h6>
                                <input name="tanggal_perdin_selesai" type="date" class="form-control2" id="tanggal_selesai"/>
                            </div>
                        </div>
                    </div>

                    <script>
                        // Ambil data tanggal dari model (misalnya, format 'YYYY-MM-DD')
                        var tanggalMulai = '{{ $detailPengecekanSuratTugas->tanggal_perdin_mulai }}';
                        var tanggalSelesai = '{{ $detailPengecekanSuratTugas->tanggal_perdin_selesai }}';
                    
                        // Set nilai field tanggal menggunakan data dari model
                        document.getElementById('tanggal_mulai').value = tanggalMulai;
                        document.getElementById('tanggal_selesai').value = tanggalSelesai;
                    </script>
                    
                    <script>
                        // Ambil elemen input untuk tanggal_mulai dan tanggal_selesai
                        var tanggalMulai = document.querySelector('.form-control1');
                        var tanggalSelesai = document.querySelector('.form-control2');

                        // Tambahkan event listener ketika nilai pada input tanggal_mulai atau tanggal_selesai berubah
                        tanggalMulai.addEventListener('change', function() {
                            if (new Date(tanggalMulai.value) > new Date(tanggalSelesai.value)) {
                                alert('Tanggal Perjalanan Dinas Selesai harus setelah Tanggal Perjalanan Dinas Mulai atau sama dengannya.');
                                tanggalMulai.value = ''; // Reset nilai tanggal_mulai jika tidak valid
                            }
                        });

                        tanggalSelesai.addEventListener('change', function() {
                            if (new Date(tanggalSelesai.value) < new Date(tanggalMulai.value)) {
                                alert('Tanggal Perjalanan Dinas Selesai harus setelah Tanggal Perjalanan Dinas Mulai atau sama dengannya.');
                                tanggalSelesai.value = ''; // Reset nilai tanggal_selesai jika tidak valid
                            }
                        });
                    </script>

                    <script>
                        // Ambil elemen input untuk tanggal_mulai dan tanggal_selesai
                        var tanggalMulai = document.querySelector('.form-control1');
                        var tanggalSelesai = document.querySelector('.form-control2');

                        // Mendapatkan tanggal hari ini
                        var today = new Date();
                        var dd = String(today.getDate()).padStart(2, '0');
                        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                        var yyyy = today.getFullYear();

                        today = yyyy + '-' + mm + '-' + dd;

                        // Set tanggal hari ini sebagai nilai minimum pada input tanggal_mulai dan tanggal_selesai
                        tanggalMulai.setAttribute('min', today);
                        tanggalSelesai.setAttribute('min', today);

                        // Tambahkan event listener ketika nilai pada input tanggal_mulai berubah
                        tanggalMulai.addEventListener('change', function() {
                            if (new Date(tanggalMulai.value) < new Date(today)) {
                                alert('Tanggal Perjalanan Dinas Mulai harus di hari ini atau setelah hari ini.');
                                tanggalMulai.value = today; // Set nilai tanggal_mulai kembali ke hari ini jika tidak valid
                            }
                        });

                        // Tambahkan event listener ketika nilai pada input tanggal_selesai berubah
                        tanggalSelesai.addEventListener('change', function() {
                            if (new Date(tanggalSelesai.value) < new Date(today)) {
                                alert('Tanggal Perjalanan Dinas Selesai harus di hari ini atau setelah hari ini.');
                                tanggalSelesai.value = today; // Set nilai tanggal_selesai kembali ke hari ini jika tidak valid
                            }
                        });
                    </script>

                    <div class="row mb-3">
                        <label for="inputDate" class="col-sm-2 col-form-label">Tanggal Penandatanganan</label>
                        <div class="col-sm-10">
                            <input name="tanggal_ttd" type="date" value="{{ $detailPengecekanSuratTugas->tanggal_ttd }}" class="form-control" id="tanggal_ttd" required/>
                        </div>
                    </div>
                    
                    <script>
                        // Ambil data tanggal dari model (misalnya, format 'YYYY-MM-DD')
                        var tanggalTtd = '{{ $detailPengecekanSuratTugas->tanggal_ttd }}';
                    
                        // Set nilai field tanggal menggunakan data dari model
                        document.getElementById('tanggal_ttd').value = tanggalTtd;
                    </script>
                    
                    
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Jabatan Penandatangan</label>
                        <div class="col-sm-10">
                            <select
                                id="jabatan_pejabat_ttd"
                                name="jabatan_pejabat_ttd"
                                class="form-select"
                                aria-label="Default select example"
                            >
                                <option selected>
                                Pilih jabatan pejabat penandatangan
                                </option>
                                <option value="Direktur" {{ $detailPengecekanSuratTugas->jabatan_pejabat_ttd == 'Direktur' ? 'selected' : '' }} >Direktur</option>
                                <option value="Wakil Direktur I" {{ $detailPengecekanSuratTugas->jabatan_pejabat_ttd == 'Wakil Direktur I' ? 'selected' : '' }} >Wakil Direktur I</option>
                                <option value="Wakil Direktur II" {{ $detailPengecekanSuratTugas->jabatan_pejabat_ttd == 'Wakil Direktur II' ? 'selected' : '' }} >Wakil Direktur II</option>
                                <option value="Wakil Direktur III" {{ $detailPengecekanSuratTugas->jabatan_pejabat_ttd == 'Wakil Direktur III' ? 'selected' : '' }} >Wakil Direktur III</option>
                                <option value="Kepala Bagian Administrasi Umum" {{ $detailPengecekanSuratTugas->jabatan_pejabat_ttd == 'Kepala Bagian Administrasi Umum' ? 'selected' : '' }} >Kepala Bagian Adminitrasi Umum</option>
                                <option value="Kepala Pusat Penelitian dan Pengabdian Kepada Masyarakat" {{ $detailPengecekanSuratTugas->jabatan_pejabat_ttd == 'Kepala Pusat Penelitian dan Pengabdian Kepada Masyarakat' ? 'selected' : '' }} >Kepala Pusat Penelitian dan Pengabdian Kepada Masyarakat</option>
                                <option value="Ketua Program Studi Statistika Program Diploma III" {{ $detailPengecekanSuratTugas->jabatan_pejabat_ttd == 'Ketua Program Studi Statistika Program Diploma III' ? 'selected' : '' }} >Ketua Program Studi Statistika Program Diploma III</option>
                                <option value="Ketua Program Studi Statistika Program Diploma IV" {{ $detailPengecekanSuratTugas->jabatan_pejabat_ttd == 'Ketua Program Studi Statistika Program Diploma IV' ? 'selected' : '' }} >Ketua Program Studi Statistika Program Diploma IV</option>
                                <option value="Ketua Program Studi Komputasi Statistik Program Diploma IV" {{ $detailPengecekanSuratTugas->jabatan_pejabat_ttd == 'Ketua Program Studi Komputasi Statistik Program Diploma IV' ? 'selected' : '' }} >Ketua Program Studi Komputasi Statistik Program Diploma IV</option>
                                <option value="Ketua Satuan Penjaminan Mutu" {{ $detailPengecekanSuratTugas->jabatan_pejabat_ttd == 'Ketua Satuan Penjaminan Mutu' ? 'selected' : '' }} >Ketua Satuan Penjaminan Mutu</option>
                                <option value="Ketua Tim Kepegawaian" {{ $detailPengecekanSuratTugas->jabatan_pejabat_ttd == 'Ketua Tim Kepegawaian' ? 'selected' : '' }} >Ketua Tim Kepegawaian</option>
                                <option value="Ketua Tim Tata Usaha dan Rumah Tangga" {{ $detailPengecekanSuratTugas->jabatan_pejabat_ttd == 'Ketua Tim Tata Usaha dan Rumah Tangga' ? 'selected' : '' }} >Ketua Tim Tata Usaha dan Rumah Tangga</option>
                                <option value="Ketua Unit Pembinaan Kemahasiswaan" {{ $detailPengecekanSuratTugas->jabatan_pejabat_ttd == 'Ketua Unit Pembinaan Kemahasiswaan' ? 'selected' : '' }} >Ketua Unit Pembinaan Kemahasiswaan</option>
                                <option value="Ketua Unit Perpustakaan" {{ $detailPengecekanSuratTugas->jabatan_pejabat_ttd == 'Ketua Unit Perpustakaan' ? 'selected' : '' }} >Ketua Unit Perpustakaan</option>
                                <option value="Ketua Unit Teknologi Informasi" {{ $detailPengecekanSuratTugas->jabatan_pejabat_ttd == 'Ketua Unit Teknologi Informasi' ? 'selected' : '' }} >Ketua Unit Teknologi Informasi</option>
                                <option value="Koordinator Fungsi Bagian Administrasi Akademik dan Kemahasiswaan" {{ $detailPengecekanSuratTugas->jabatan_pejabat_ttd == 'Koordinator Fungsi Bagian Administrasi Akademik dan Kemahasiswaan' ? 'selected' : '' }} >Koordinator Fungsi Bagian Administrasi Akademik dan Kemahasiswaan</option>

                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label"
                        >Nama Pejabat Penandatangan</label
                        >
                        <div class="col-sm-10">
                        <input
                            id="nama_pejabat_ttd"
                            name="nama_pejabat_ttd"
                            value="{{ $detailPengecekanSuratTugas->nama_pejabat_ttd }}"
                            type="text"
                            class="form-control"
                            placeholder="Masukkan nama pejabat penandatangan"
                            readonly
                        />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Jenis Lampiran</label>
                        <div class="col-sm-10">
                            <select
                                name="lampiran"
                                class="form-select"
                                aria-label="Default select example"
                            >
                                <option selected>
                                Pilih jenis lampiran
                                </option>
                                <option value="0" {{ $detailPengecekanSuratTugas->lampiran == 0 ? 'selected' : '' }} >Tanpa lampiran perjalanan dinas</option>
                                <option value="1" {{ $detailPengecekanSuratTugas->lampiran == 1 ? 'selected' : '' }} >Dengan lampiran perjalanan dinas dalam kota</option>
                                <option value="2" {{ $detailPengecekanSuratTugas->lampiran == 2 ? 'selected' : '' }} >Dengan lampiran perjalanan dinas luar kota</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label"
                        >Gaji Pokok</label
                        >
                        <div class="col-sm-10">
                        <input
                            name=""
                            value="{{ $detailPengecekanSuratTugas->user->gaji }}"
                            type="text"
                            class="form-control"
                            placeholder="Masukkan nama pejabat penandatangan (tanpa gelar)"
                        />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Moda Transportasi</label>
                        <div class="col-sm-10">
                            <select name="moda_transportasi" class="form-select" aria-label="Default select example">
                                <option value="" selected>
                                Pilih jenis moda transportasi
                                </option>
                                <option value="Kendaraan dinas" {{ $detailPengecekanSuratTugas->moda_transportasi == 'Kendaraan dinas' ? 'selected' : '' }} >Kendaraan dinas</option>
                                <option value="Kendaraan umum" {{ $detailPengecekanSuratTugas->moda_transportasi == 'Kendaraan umum' ? 'selected' : '' }} >Kendaraan umum</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label"
                        >Kode Program</label
                        >
                        <div class="col-sm-10">
                        <input
                            name="kode_program"
                            value="{{ $detailPengecekanSuratTugas->kode_program }}"
                            type="text"
                            class="form-control"
                            placeholder="Masukkan program"
                            required
                        />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label"
                        >Kode Kegiatan</label
                        >
                        <div class="col-sm-10">
                        <input
                            name="kode_kegiatan"
                            value="{{ $detailPengecekanSuratTugas->kode_kegiatan }}"
                            type="text"
                            class="form-control"
                            placeholder="Masukkan kode kegiatan"
                            required
                        />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label"
                        >Kode Output</label
                        >
                        <div class="col-sm-10">
                        <input
                            name="kode_output"
                            value="{{ $detailPengecekanSuratTugas->kode_output}}"
                            type="text"
                            class="form-control"
                            placeholder="Masukkan kode output"
                            required
                        />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label"
                        >Kode Komponen</label
                        >
                        <div class="col-sm-10">
                        <input
                            name="kode_komponen"
                            value="{{ $detailPengecekanSuratTugas->kode_komponen }}"
                            type="text"
                            class="form-control"
                            placeholder="Masukkan kode komponen"
                            required
                        />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label"
                        >Kode Sub Komponen</label
                        >
                        <div class="col-sm-10">
                        <input
                            name="kode_sub_komponen"
                            value="{{ $detailPengecekanSuratTugas->kode_sub_komponen }}"
                            type="text"
                            class="form-control"
                            placeholder="Masukkan kode sub komponen"
                            required
                        />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Pejabat Pembuat Komitmen</label>
                        <div class="col-sm-10">
                            <select name="ppk" class="form-select" aria-label="Default select example" required>
                                <option value="" selected>
                                Pilih nama pejabat pembuat komitmen
                                </option>
                                <option value="Luci Wulansari, S.Si., M.S.E" {{ $detailPengecekanSuratTugas->ppk == 'Luci Wulansari, S.Si., M.S.E' ? 'selected' : '' }} >Luci Wulansari, S.Si., M.S.E</option>
                                <option value="Nurseto Wisnumurti, S.Si., M.Stat" {{ $detailPengecekanSuratTugas->ppk == 'Nurseto Wisnumurti, S.Si., M.Stat' ? 'selected' : '' }} >Nurseto Wisnumurti, S.Si., M.Stat</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-10">
                        <button id="updateButton" type="submit" class="btn btn-primary" onclick="return validateForm()">
                            Update
                        </button>
                        </div>
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
                            if (value) {
                                window.location.href = '{{ route('pengecekansurtug.index') }}';
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
        <script>
            const jabatanSelect = document.getElementById('jabatan_pejabat_ttd');
            const namaPejabatInput = document.getElementById('nama_pejabat_ttd');

            jabatanSelect.addEventListener('change', function() {
                // Mendapatkan nilai jabatan yang dipilih
                const selectedJabatan = jabatanSelect.value;

                // Lakukan pengecekan nilai jabatan dan sesuaikan dengan nama pejabat yang sesuai
                switch (selectedJabatan) {
                    case 'Direktur':
                        namaPejabatInput.value = 'Dr. Erni Tri Astuti, M. Math';
                        break;
                    case 'Wakil Direktur I':
                        namaPejabatInput.value = 'Prof. Setia Pramana, S.Si, M.Sc, Ph.D';
                        break;
                    case 'Wakil Direktur II':
                        namaPejabatInput.value = 'Prof. Dr. Hardius Usman, S.Si. M.Si';
                        break;
                    case 'Wakil Direktur III':
                        namaPejabatInput.value = 'Dr. Yunarso Anang Sulistiadi, M.Eng.';
                        break;
                    case 'Kepala Bagian Administrasi Umum':
                        namaPejabatInput.value = 'Bambang Nurcahyo, SE.,M.M.';
                        break;
                    case 'Kepala Pusat Penelitian dan Pengabdian Kepada Masyarakat':
                        namaPejabatInput.value = 'Dr. Eng. Arie Wahyu Wijayanto, SST., M.T';
                        break;
                    case 'Ketua Program Studi Statistika Program Diploma III':
                        namaPejabatInput.value = 'Ibnu Santoso, SST.,MT';
                        break;
                    case 'Ketua Program Studi Statistika Program Diploma IV':
                        namaPejabatInput.value = 'Agung Priyo Utomo, S.Si, M.T';
                        break;
                    case 'Ketua Program Studi Komputasi Statistik Program Diploma IV':
                        namaPejabatInput.value = 'Dr. Azka Ubaidillah, SST.,M.Si';
                        break;
                    case 'Ketua Satuan Penjaminan Mutu':
                        namaPejabatInput.value = 'Nucke Widowati Kusumo Projo, S.Si, M.Sc, Ph.D';
                        break;
                    case 'Ketua Tim Kepegawaian':
                        namaPejabatInput.value = 'Toza Sathia Utiayarsih, SST., M.Stat.';
                        break;
                    case 'Ketua Tim Tata Usaha dan Rumah Tangga':
                        namaPejabatInput.value = 'Sri Widaryani, SE.,M.Si';
                        break;
                    case 'Ketua Unit Pembinaan Kemahasiswaan':
                        namaPejabatInput.value = 'Wahyudin, S.Si., MAP, MPP';
                        break;
                    case 'Ketua Unit Perpustakaan':
                        namaPejabatInput.value = 'Achmad Prasetyo, S.Si, MM';
                        break;
                    case 'Ketua Unit Teknologi Informasi':
                        namaPejabatInput.value = 'Farid Ridho, SST.,MT';
                        break;
                    case 'Koordinator Fungsi Bagian Administrasi Akademik dan Kemahasiswaan':
                        namaPejabatInput.value = 'Nurseto Wisnumurti, S.Si., M.Stat';
                        break;
                    default:
                        namaPejabatInput.value = ''; // Atau kosongkan jika tidak ada yang dipilih
                        break;
                }
            });

            function focusOnFirstInvalidField() {
                var elements = document.querySelectorAll('[required]');
                for (var i = 0; i < elements.length; i++) {
                    if (!elements[i].value) {
                        elements[i].focus();
                        return;
                    }
                }
            }

            function validateForm() {
                var elements = document.querySelectorAll('[required]');
                for (var i = 0; i < elements.length; i++) {
                    if (!elements[i].value) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: 'Terdapat field wajib yang belum diisi, harap cek kembali isian Anda',
                        }).then(() => {
                            focusOnFirstInvalidField();
                        });
                        return false;
                    }
                }
                return true;
            }
        </script>

    </x-slot>
</x-dashboard.layouts.layouts>