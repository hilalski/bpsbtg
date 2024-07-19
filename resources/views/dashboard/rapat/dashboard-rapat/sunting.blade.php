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

    <section class="section dashboard">
        <div class="container p-2">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card p-4">
                        <div class="card-body">
                            <form class="font-form fw-bold"
                                  action="{{ route('dashboard-rapat.update', ['id_rapat' => $rapat->id]) }}"
                                  method="POST">
                                @csrf
                                @method('PATCH')

                                <div class="row mb-3">
                                    <label for="inputNamaUnit" class="col-sm-2 col-form-label">
                                        Jenis Rapat
                                    </label>
                                    <div class="col-sm-10">
                                        <select id="inputNamaUnit" name="jenis_rapat_id"
                                                class="form-select font-form @error('jenis_rapat_id') is-invalid @enderror ">
                                            @foreach ($filteredRapatJenis as $r)
                                                <option
                                                    value="{{ $r->id }}" {{$rapat->jenis_rapat_id == $r->id ? 'selected' : (old('jenis_rapat_id') == $r->id ? 'selected' : '')}} > {{$r->nama_jenis_rapat}}</option>
                                            @endforeach
                                        </select>
                                        @error('jenis_rapat_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">
                                        Nama Rapat
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama_rapat"
                                               class="form-control @error('nama_rapat') is-invalid @enderror"
                                               value="{{old('nama_rapat') ?? $rapat->nama_rapat}}"/>
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

                                <div class="d-none" id="namaBagian">
                                    @if(isset($additionalInfo['bagian']))
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label">Nama Bagian</label>
                                            <div class="col-sm-10">
                                                <select class="form-select  @error('bagianName') is-invalid @enderror"
                                                        name="bidangName"
                                                        id="inputBagianName" {{ old('jenis_rapat_id') != $idRapatBagian ? 'disabled' : '' }}>
                                                    <option>Choose...</option>
                                                    @foreach($additionalInfo['bagian'] as $r)
                                                        <option value="{{ $r->id }}">{{ $r->nama_bagian }}</option>
                                                    @endforeach
                                                </select>
                                                @error('bagianName')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif
                                </div>


                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Jabatan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="{{ $labelJabatan }}" disabled>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputDate" class="col-sm-2 col-form-label">Tanggal</label>
                                    <div class="col-sm-10">
                                        <input type="date"
                                               class="form-control font-form @error('tanggal') is-invalid @enderror"
                                               name="tanggal"
                                               name="tanggal" id="tanggal" value="{{ old('tanggal') ?? $tanggal }}"/>
                                        @error('tanggal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputDate" class="col-sm-2 col-form-label">
                                        Waktu Mulai
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="time"
                                               class="form-control font-form @error('waktu_mulai') is-invalid @enderror"
                                               name="waktu_mulai" id="waktuMulai"
                                               value="{{ old('waktu_mulai') ?? $waktu_mulai }}"/>
                                        @error('waktu_mulai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputDate" class="col-sm-2 col-form-label">
                                        Waktu Selesai
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="time"
                                               class="form-control font-form @error('waktu_selesai') is-invalid @enderror"
                                               name="waktu_selesai" id="waktuSelesai"
                                               value="{{old('waktu_selesai') ?? $waktu_selesai }}"/>
                                        @error('waktu_selesai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputPelaksanaan" class="col-sm-2 col-form-label">
                                        Pelaksanaan
                                    </label>
                                    <div class="col-sm-10">
                                        <select id="inputPelaksanaan"
                                                class="form-select font-form @error('pelaksanaan') is-invalid @enderror"
                                                 name="pelaksanaan">
                                            <option value="null">Pilih Pelaksanaan</option>
                                            <option value="Offline" {{ (old('pelaksanaan', $rapat->pelaksanaan) == 'Offline') ? 'selected' : '' }}>Offline</option>
                                            <option value="Online" {{ (old('pelaksanaan', $rapat->pelaksanaan) == 'Online') ? 'selected' : '' }}>Online</option>
                                        </select>
                                        @error('pelaksanaan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputNamaTempat" class="col-sm-2 col-form-label">
                                        Tempat
                                    </label>
                                    <div class="col-sm-10">
                                        <select id="inputNamaTempat"
                                                class="form-select font-form @error('tempat') is-invalid @enderror"
                                                name="tempat">
                                            @if(old('pelaksanaan', $rapat->pelaksanaan) == 'Offline')
                                                @foreach ($tempatOptions['Offline'] as $t)
                                                    <option
                                                        value="{{ $t->id }}" {{ old('tempat', $rapat->tempat_id) == $t->id ? 'selected' : '' }}>{{ $t->nama_tempat }}</option>
                                                @endforeach
                                            @elseif(old('pelaksanaan', $rapat->pelaksanaan) == 'Online')
                                                @foreach ($tempatOptions['Online'] as $t)
                                                    <option
                                                        value="{{ $t->id }}" {{ old('tempat', $rapat->tempat_id) == $t->id ? 'selected' : '' }}>{{ $t->nama_tempat }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('tempat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="row mb-3 d-none " id="detailTempat">
                                    <label for="inputText" class="col-sm-2 col-form-label">
                                        Detail Tempat
                                    </label>
                                    <div class="col-sm-10">
                                        <input id="inputDetailTempat" type="text"
                                               class="form-control @error('detail_tempat') is-invalid @enderror"
                                               name="detail_tempat"
                                               value="{{old('detail_tempat', $rapat->detail_tempat ?? '')}}"/>
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
                                                  placeholder="Klik disini untuk menambahkan agenda">{{old('agenda', $rapat->agenda ?? '')}}</textarea>
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
                                                    @foreach ($riset_bidang as $r)
                                                        <option
                                                            value="{{ $r -> id}}" {{$rapatPenyelenggara->riset_bidang_id == $r->id ? 'selected' : ''}} > {{ $r -> nama_riset_bidang}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <select id="list_seksi" name="seksiName" class="form-control">
                                                    <option value="null">Pilih Seksi</option>
                                                    @foreach ($seksi as $r)
                                                        <option
                                                            value="{{ $r -> id}}" {{$rapatPenyelenggara->seksi_id == $r->id ? 'selected' : ''}} > {{ $r -> nama_seksi}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <select id="list_subseksi" name="subseksiName" class="form-control">
                                                    <option value="null">Pilih Subseksi</option>
                                                    @foreach ($subseksi as $r)
                                                        <option
                                                            value="{{ $r -> id}}" {{$rapatPenyelenggara->subseksi_id == $r->id ? 'selected' : ''}} > {{ $r -> nama_subseksi}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <select id="list_bagian" name="bagianName" class="form-control">
                                                    <option value="null">Pilih Bagian</option>
                                                    @foreach ($bagian as $r)
                                                        <option
                                                            value="{{ $r -> id}}" {{$rapatPenyelenggara->bagian_id == $r->id ? 'selected' : ''}} > {{ $r -> nama_bagian}}</option>
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
                                            @foreach($mahasiswaSelected as $ms)
                                                <option value="{{$ms->nim}}"
                                                        selected>{{$ms->nama}}</option>
                                            @endforeach
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
                                            @if($dosenSelected->isEmpty())
                                                @foreach($dosen as $d)
                                                    <option value="{{$d->nip}}">{{$d->nama}}</option>
                                                @endforeach
                                            @else
                                                @foreach($dosenSelected as $ds)
                                                    <option value="{{$ds->nip}}" selected>
                                                        {{$ds->nama}}
                                                    </option>
                                                @endforeach
                                            @endif

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
                                        <button type="submit" class="btn btn-primary">Update</button>
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
        <script src="{{ asset('assets/js/dashboard/tambah-rapat.js') }}"></script>
    </x-slot>
</x-dashboard.layouts.layouts>
