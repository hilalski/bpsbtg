<x-dashboard.layouts.layouts :menu="$menu">
    <x-slot name="css">
        <style>
            #div-multiple-select-mahasiswa .input-group,
            #div-multiple-select-dosen .input-group {
                display: flex !important;
                flex-wrap: unset;
            }

            #div-multiple-select-mahasiswa .input-group .input-group-text,
            #div-multiple-select-dosen .input-group .input-group-text,
            {
                min-height: 100px;
            }

            #div-multiple-select-mahasiswa .input-group .select2-container .select2-selection--multiple,
            #div-multiple-select-dosen .input-group .select2-container .select2-selection--multiple {
                min-height: 100px !important;
            }

            #div-multiple-select-mahasiswa .select2.select2-container,
            #div-multiple-select-dosen .select2.select2-container {
                width: 1159px !important;
            }
        </style>
    </x-slot>

    <x-slot name="js_head">
    </x-slot>

    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif
    <section class="section dashboard">
        <div class="container p-2">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card p-4">
                        <div class="card-body">
                            <form class="font-form fw-bold" action="{{ route('dashboard-rapat.store') }}" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <label for="inputNamaUnit" class="col-sm-2 col-form-label">Jenis Rapat</label>
                                    <div class="col-sm-10">
                                        <select id="jenisRapat"
                                                class="form-select font-form @error('jenis_rapat_id') is-invalid @enderror"
                                                name="jenis_rapat_id">
                                            <option value="">Pilih Jenis Rapat</option>
                                            @foreach ($filteredRapatJenis as $r)
                                                <option
                                                    value="{{ $r->id }}" {{ old('jenis_rapat_id') == $r->id ? 'selected' : '' }}>{{ $r->nama_jenis_rapat }}</option>
                                            @endforeach
                                        </select>
                                        @error('jenis_rapat_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="namaRapat" class="col-sm-2 col-form-label">Nama Rapat</label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                               class="form-control @error('nama_rapat') is-invalid @enderror"
                                               name="nama_rapat" id="namaRapat" value="{{ old('nama_rapat') }}"/>
                                        @error('nama_rapat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputNamaUnit" class="col-sm-2 col-form-label">
                                        Koordinator
                                    </label>
                                    <div class="col-sm-10 form-disable-siagau">
                                        <input type="text" class="form-control" id="koordinator"
                                               value="{{ $ketuaRapatNim->nama }}" readonly name="risetName">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputNamaUnit" class="col-sm-2 col-form-label">
                                        Penyelenggara
                                    </label>
                                    <div class="col-sm-10 form-disable-siagau">
                                        <input type="text" class="form-control" id="inputNamaUnit"
                                               value="{{ $penyelenggara->nama_riset_bidang }}" readonly
                                               name="risetName">
                                    </div>
                                </div>

                                {{-- Menampilkan Informasi Tambahan berdasarkan Jabatan --}}
                                @if(isset($additionalInfo['seksi']))
                                    <div class="row mb-3 form-disable-siagau">
                                        <label class="col-sm-2 col-form-label">Nama Seksi</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control"
                                                   value="{{ $additionalInfo['seksi']}}" readonly name="seksiName">
                                        </div>
                                    </div>
                                @endif

                                @if(isset($additionalInfo['subseksi']))
                                    <div class="row mb-3 form-disable-siagau">
                                        <label class="col-sm-2 col-form-label">Nama Subseksi</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control"
                                                   value="{{ $additionalInfo['subseksi'] }}" readonly
                                                   name="subseksiName">
                                        </div>
                                    </div>
                                @endif

                                <div class="{{ old('jenis_rapat_id') == $idRapatBagian ? '' : 'd-none' }}"
                                     id="namaBagian">
                                    @if(isset($additionalInfo['bagian']))
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label">Nama Bagian</label>
                                            <div class="col-sm-10">
                                                <select class="form-select @error('bagianName') is-invalid @enderror"
                                                        name="bagianName"
                                                        id="inputBagianName" {{ old('jenis_rapat_id') != $idRapatBagian ? 'disabled' : '' }}>
                                                    <option>Choose...</option>
                                                    @foreach($additionalInfo['bagian'] as $r)
                                                        <option
                                                            value="{{ $r->nama_bagian }}" {{ old('bagianName') == $r->nama_bagian ? 'selected' : '' }}>{{ $r->nama_bagian }}</option>
                                                    @endforeach
                                                </select>
                                                @error('bagianName')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="row mb-3 form-disable-siagau">
                                    <label class="col-sm-2 col-form-label">Jabatan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="{{ $labelJabatan }}" readonly>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputDate" class="col-sm-2 col-form-label">Tanggal</label>
                                    <div class="col-sm-10">
                                        <input type="date"
                                               class="form-control font-form @error('tanggal') is-invalid @enderror"
                                               name="tanggal" id="tanggal" value="{{ old('tanggal') }}"/>
                                        @error('tanggal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="waktuMulai" class="col-sm-2 col-form-label">Waktu Mulai</label>
                                    <div class="col-sm-10">
                                        <input type="time"
                                               class="form-control font-form @error('waktu_mulai') is-invalid @enderror"
                                               name="waktu_mulai" id="waktuMulai" value="{{ old('waktu_mulai') }}"/>
                                        @error('waktu_mulai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="waktuSelesai" class="col-sm-2 col-form-label">Waktu Selesai</label>
                                    <div class="col-sm-10">
                                        <input type="time"
                                               class="form-control font-form @error('waktu_selesai') is-invalid @enderror"
                                               name="waktu_selesai" id="waktuSelesai"
                                               value="{{ old('waktu_selesai') }}"/>
                                        @error('waktu_selesai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputPelaksanaan" class="col-sm-2 col-form-label">Pelaksanaan</label>
                                    <div class="col-sm-10">
                                        <select id="inputPelaksanaan" class="form-select font-form @error('pelaksanaan') is-invalid @enderror" name="pelaksanaan">
                                            <option value="null">Pilih Pelaksanaan</option>
                                            <option value="Offline" @if (old('pelaksanaan') == "Offline") selected @endif>Offline</option>
                                            <option value="Online" @if (old('pelaksanaan') == "Online") selected @endif>Online</option>
                                        </select>
                                        @error('pelaksanaan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Bagian Tempat -->
                                <div class="row mb-3">
                                    <label for="inputNamaTempat" class="col-sm-2 col-form-label">Tempat</label>
                                    <div class="col-sm-10">
                                        <select id="inputNamaTempat"
                                                class="form-select font-form @error('tempat') is-invalid @enderror"
                                                name="tempat">
                                                <option value="">Pilih Tempat</option>
                                            <!-- Opsi tempat akan diisi oleh script JS -->
                                        </select>
                                        @error('tempat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Bagian Detail Tempat -->
                                <div class="row mb-3 {{ old('tempat') == 'OF002' ? '' : 'd-none' }}" id="detailTempat">
                                    <label for="inputDetailTempat" class="col-sm-2 col-form-label">Detail Tempat</label>
                                    <div class="col-sm-10">
                                        <input id="inputDetailTempat" type="text"
                                               class="form-control @error('detail_tempat') is-invalid @enderror" value="{{ old('detail_tempat') }}"
                                               name="detail_tempat" {{ old('tempat') != 'OF002' ? 'disabled' : '' }}/>
                                        @error('detail_tempat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="agenda" class="col-sm-2 col-form-label">Agenda</label>
                                    <div class="col-sm-10">
                                        <textarea id="agenda" name="agenda"
                                                  class="form-control @error('agenda') is-invalid @enderror" rows="7"
                                                  placeholder="Klik disini untuk menambahkan agenda">{{ old('agenda') }}</textarea>
                                        @error('agenda')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Peserta Rapat Mahasiswa</label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <select id="list_risbid" name="risetName" class="form-control">
                                                    <option value="null">Pilih Riset/Bidang</option>
                                                    @foreach ($risetBidang as $rb)
                                                        <option
                                                            value="{{ $rb->id }}">{{ $rb->nama_riset_bidang }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <select id="list_seksi" name="seksiName" class="form-control">
                                                    <option value="null">Pilih Seksi</option>
                                                    <!-- Additional options here -->
                                                    @foreach ($seksi as $s)
                                                        <option value="{{ $s->id }}">{{ $s->nama_seksi }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <select id="list_subseksi" name="subseksiName" class="form-control">
                                                    <option value="null">Pilih Subseksi</option>
                                                    <!-- Additional options here -->
                                                    @foreach($subseksi as $ss)
                                                        <option value="{{ $ss->id }}">{{ $ss->nama_subseksi }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <select id="list_bagian" name="bagianName" class="form-control">
                                                    <option value="null">Pilih Bagian</option>
                                                    <!-- Additional options here -->
                                                    @foreach($bagian as $b)
                                                        <option value="{{ $b->id }}">{{ $b->nama_bagian }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- logic label penjelas selected risbid/seksi/sub/bagian --}}
                                <p id="label-selected-peserta">Tambah Peserta Rapat</p>

                                <div id="div-multiple-select-mahasiswa" class="mt-3">
                                    <div class="input-group mb-3">
                                    <span class="input-group-text" id="add-mahasiswa" role="button">
                                        <i class="bi bi-plus-square-fill"></i>
                                    </span>
                                        <!-- Pilihan-pilihan Mahasiswa -->
                                        <select id="multiple-select-mahasiswa" name="select_mahasiswa[]"
                                                class="form-select" multiple>
                                        </select>
                                        <span class="input-group-text" id="remove-mahasiswa" role="button">
                                        <i class="bi bi-trash-fill"></i>
                                    </span>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">
                                        Keikutsertaan Dosen
                                    </label>

                                    {{-- toggle dengan/tanpa dosen --}}
                                    <input id="switch-dosen" type="checkbox" data-toggle="toggle"
                                           data-onlabel="<i class='bi bi-person-check'></i> Dengan Dosen"
                                           data-offlabel="<i class='bi bi-person-dash'></i> Tanpa Dosen">
                                </div>

                                {{-- show / hide saat toggle dengan/tanpa dosen --}}
                                <div id="div-multiple-select-dosen" class="mt-3">
                                    <div class="input-group mb-3">
                                    <span class="input-group-text" id="add-dosen" role="button">
                                        <i class="bi bi-plus-square-fill"></i>
                                    </span>
                                        <!-- Pilihan-pilihan Dosen -->
                                        <select id="multiple-select-dosen" name="select_dosen[]"
                                                class="form-select col-sm-9" multiple>
                                            @foreach($userDosen as $ud)
                                                <option value="{{ $ud->nip }}">{{ $ud->nama }}</option>
                                            @endforeach
                                        </select>
                                        <span class="input-group-text" id="remove-dosen" role="button"><i
                                                class="bi bi-trash-fill"></i>
                                    </span>
                                    </div>
                                </div>

                                {{-- submit or not --}}
                                <div class="row mb-3">
                                    <div class="text-end">
                                        <a href="{{ route('dashboard-rapat.index') }}" class="btn btn-danger">Batal</a>
                                        <button type="submit" class="btn btn-primary" id="submitButton">Kirim</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-slot name="js_body">
        <script src = "{{ asset('assets/js/dashboard/tambah-rapat.js') }}"></script>
    </x-slot>
</x-dashboard.layouts.layouts>
