<x-dashboard.layouts.layouts :menu="$menu">
    <x-slot name="css">
    </x-slot>

    <x-slot name="js_head">
    </x-slot>

    <section class="section dashboard">
        <div class="row">
{{--            <p>HALOO</p>--}}

            <!-- Kolom bagian kiri -->
            <div class="col-lg-8">
                    {{-- Rapat --}}
                    <x-card.card judul='{{ $rapatDetail->nama_rapat }}'>
                        <div class=" container-fluid p-3">
                            <div class="detail">
                                <i class="bi bi-calendar"></i>
                                <span>{{ $waktuTanggalFormatted }}</span>
                            </div>
                            <div class="detail">
                                <i class="bi bi-clock"></i>
                                <span>{{ $waktuMulaiFormatted }} - {{ $waktuSelesaiFormatted }} WIB</span>
                            </div>
                            <div class="detail">
                                <i class="bi bi-geo-alt"></i>
                                <span>{{ $rapatDetail->tempat->nama_tempat }}</span>
                            </div>
                        </div>
                    </x-card.card>
                    {{-- End Rapat --}}

                    <!-- Presensi -->
                    <x-card.card judul='Presensi Rapat {{ $rapatDetail->nama_rapat }}'>
                        <div class="container-fluid p-3">
                            <!-- Form Presensi 1 -->
                            @if($status == 'berlangsung' || $status == 'selesai')
                                <h6><strong>Presensi 1</strong></h6>
                                @if($presensiRapat && $presensiRapat->waktu_kode_satu)
                                    <div class="alert alert-success">
                                        Presensi 1: Sukses pada {{ \Carbon\Carbon::parse($presensiRapat->waktu_kode_satu)->translatedFormat('l, d F Y') }} pukul {{ \Carbon\Carbon::parse($presensiRapat->waktu_kode_satu)->translatedFormat('H:i') }} WIB
                                    </div>
                                @else
                                    <form action="{{ route('submit-presensi') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="rapat_id" value="{{ $rapatDetail->id }}">
                                        <div class="input-group mb-3 input-kode">
                                            <input type="text" class="form-control" name="kode_presensi" placeholder="Masukkan kode satu ..." aria-label="Masukkan kode satu">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="submit" name="kode_type1"
                                                        value="kode_satu">Submit
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                                <!-- End Form Presensi 1 -->

                                <!-- Form Presensi 2 -->
                            @if(!$isDosen)
                                <h6><strong>Presensi 2</strong></h6>
                                @if($presensiRapat && $presensiRapat->waktu_kode_dua)
                                    <div class="alert alert-success">
                                        Presensi 2: Sukses pada {{
                                        \Carbon\Carbon::parse($presensiRapat->waktu_kode_dua)->translatedFormat('l, d F Y') }}
                                        pukul {{ \Carbon\Carbon::parse($presensiRapat->waktu_kode_dua)->translatedFormat('H:i')
                                        }} WIB
                                    </div>
                            @else
                                @if($waktuKehadiranTerisi)
                                    <div>
                                        <form action="{{ route('submit-presensi') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="rapat_id" value="{{ $rapatDetail->id }}">
                                            <div class="input-group mb-3 input-kode">
                                                <input type="text" class="form-control" name="kode_presensi"
                                                       placeholder="Masukkan kode dua ..." aria-label="Masukkan kode dua">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="submit" name="kode_type2"
                                                            value="kode_dua">Submit
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @else
                                    <div class="alert alert-warning">
                                        Anda perlu mengisi presensi 1 terlebih dahulu.
                                    </div>
                                @endif
                            @endif
                        @endif

                            <!-- End Form Presensi 2 -->

                                {{-- Confirmation message if both presensis are submitted for the specific rapat --}}
                                @if(session("presensi_1_submitted_{$rapatDetail->id}") && session("presensi_2_submitted_{$rapatDetail->id}"))
                                    <div class="alert alert-success">
                                        Terima kasih, presensi Anda telah lengkap.
                                    </div>
                                @endif
                            @else
                                <div class="alert alert-warning">
                                    Rapat belum dimulai.
                                </div>
                            @endif
                    </x-card.card>
                </div>
            </div>
            <!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">
                {{-- Status Kehadiran --}}
                <x-card.card judul='Status Kehadiran'>
                    <div class=" container-fluid p-3">

                        <div class="text-center d-flex align-items-center justify-content-center flex-column">
                            {{-- @if($statusKehadiran == ) --}}

                            @switch($status)
                                @case('sebelum')
                                    <i class="bi bi-hourglass rapat-emoji"></i>
                                    <span>Rapat belum dimulai</span>
                                    @break

                                @case('berlangsung')
                                    <i class="bi bi-hourglass-split rapat-emoji"></i>
                                    <span>Rapat sedang berlangsung</span>
                                    @break

                                @case('selesai')
                                    <i class="bi bi-hourglass-bottom rapat-emoji"></i>
                                    <span>Rapat sudah selesai</span>
                                    @break

                                @default
                                    <p>Rapat Tidak Valid</p>
                            @endswitch
                        </div>
                    </div>
                </x-card.card>
                {{-- End Status Kehadiran--}}

                {{-- Notula Rapat--}}
                <x-card.card judul='Notula Rapat'>
                    <div class=" container-fluid p-3">
                        <div class="text-center d-flex align-items-center justify-content-center flex-row">
                            @if($notula)
                            <button type="button" style="margin-right: 10px;" class="btn btn-primary">
                                <i class="bi bi-eye"></i> Lihat
                            </button>
                            <button type="button" class="btn btn-success">
                                <i class="bi bi-cloud-download"></i> Download
                            </button>
                            @else
                            <h6><strong>Tidak ada notula</strong></h6>
                            @endif
                        </div>
                    </div>
                </x-card.card>
                {{-- End Notula Rapat--}}
            </div>
            <!-- End Right side columns -->

{{--            TODO: Tabel Mahasiswa--}}
            <div class="col-lg-8">
                <div class="card overflow-auto">
                    <div class="card-body">
                        <div class="card-title-card-siagau">
                            <h4><strong>Informasi Kehadiran</strong></h4>
                        </div>
                        {{-- Revisii --}}
                        <div class="container-fluid p-3">
                            <div class="detail">
                                <strong class="col-sm-4">Status Kehadiran</strong>
                                <span class="col-sm-8">
                                    {{$presensiRapat->keterangan}}
                                </span>
                            </div>
                            <div class="detail">
                                <strong class="col-sm-4">Presentase Kehadiran</strong>
                                <span class="col-sm-8">{{$presensiRapat->persentase}}</span>
                            </div>
                            <div class="detail d-flex justify-content-end">
                                @if($rapatIzin)
                                <a href="ganti aja nyesuaiin ygg ditabel sebelumnya" class="btn btn-warning tombol-acc rounded m-1" role="button">
                                    <i class="fa fa-check-circle" style="margin-right: 5px;"></i>Izin
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <x-slot name="js_body">
    </x-slot>
</x-dashboard.layouts.layouts>
