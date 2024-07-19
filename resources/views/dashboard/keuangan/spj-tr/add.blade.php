<x-dashboard.layouts.layouts :menu="$menu">
    <x-slot name="css">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dashboard/main.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/form-bau.css') }}">
    </x-slot>

    <x-slot name="js_head">
    </x-slot>
    <style>
        .readonly-field {
            background-color: #cacaca; 
        }
    </style>

    <section class="section draft-pengajuan bg-white">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="py-5 text-center">Silakan Lengkapi Formulir</h1>

                    <form action="/dashboard/spj/pengajuan-translok" method="POST" enctype="multipart/form-data" class="row">
                        @csrf
                        <div class="col-sm-12">
                            <label for="inputText" class="col-sm-12 col-form-label">Biaya Perjalanan Dinas Dalam Rangka</label>
                            <div class="col-sm-11">
                                <input
                                type="text"
                                class="form-control"
                                value=""
                                placeholder="CONTOH: PKL (ISI DENGAN KAPITAL)" 
                                name="judul"
                                required
                                />
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="inputText" class="col-sm-2 col-form-label">Program</label>
                                <div class="col-sm-10">
                                    <input
                                    type="text"
                                    class="form-control readonly-field"
                                    value="(054.01.WA)  PROGRAM DUKUNGAN MANAJEMEN"
                                    readonly
                                    name="program"
                                    />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="inputText" class="col-sm-2 col-form-label">Kegiatan</label>
                                <div class="col-sm-10">
                                    <input
                                    type="text"
                                    class="form-control readonly-field"
                                    value="(2888)   PENYELENGGARAAN SEKOLAH TINGGI ILMU STATISTIK (STIS)"
                                    readonly
                                    name="kegiatan"
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="inputText" class="col-sm-2 col-form-label">KRO</label>
                                <div class="col-sm-10">
                                    <input
                                      type="text"
                                      class="form-control readonly-field"
                                      value="(EBC)    LAYANAN MANAJEMEN SDM INTERNAL"
                                      readonly
                                      name="kro"
                                    />
                                  </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <label for="inputText" class="col-sm-7 col-form-label">Rencana Output</label>
                                </div>
                                <div class="col-sm-10">
                                    <input
                                    type="text"
                                    class="form-control"
                                    value="(U06)    PERJALANAN DINAS"
                                    name="rencana_output"
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="inputText" class="col-sm-2 col-form-label">Komponen</label>
                                <div class="col-sm-10">
                                    <input
                                    type="text"
                                    class="form-control readonly-field"
                                    value="(052)    PELAKSANAAN PENDIDIKAN"
                                    readonly
                                    name="komponen"
                                    />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="inputText" class="col-sm-2 col-form-label">Akun</label>
                                <div class="col-sm-10">
                                    <input
                                    type="text"
                                    class="form-control readonly-field"
                                    value="(524113)    BELANJA PERJALANAN DINAS DALAM KOTA"
                                    readonly
                                    name="akun"
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <div class="row">
                                    <label for="inputText" class="col-sm-12 col-form-label">Bulan</label>
                                </div>
                                <div class="col-sm-10">
                                <select class="form-select" name="bulan" required>
                                    <option selected>Pilih Bulan</option>
                                    <option value="JANUARI">JANUARI</option>
                                    <option value="FEBRUARI">FEBRUARI</option>
                                    <option value="MARET">MARET</option>
                                    <option value="APRIL">APRIL</option>
                                    <option value="MEI">MEI</option>
                                    <option value="JUNI">JUNI</option>
                                    <option value="JULI">JULI</option>
                                    <option value="AGUSTUS">AGUSTUS</option>
                                    <option value="SEPTEMBER">SEPTEMBER</option>
                                    <option value="OKTOBER">OKTOBER</option>
                                    <option value="NOVEMBER">NOVEMBER</option>
                                    <option value="DESEMBER">DESEMBER</option>
                                </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <label for="inputText" class="col-sm-7 col-form-label">Tanggal Kegiatan</label>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-10">
                                        <input type="date" name="tanggal_kegiatan" class="form-control font-form" style="font-size: 16px;"required/>
                                      </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="inputText" class="col-sm-2 col-form-label">Jenis SPJ</label>
                                <div class="col-sm-10">
                                    <input
                                    type="text"
                                    class="form-control readonly-field"
                                    value="SPJ Translok"
                                    readonly
                                    name="jenis_spj"
                                    required
                                    />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <label for="inputText" class="col-sm-12 col-form-label">Bendahara Pengeluaran</label>
                                </div>
                                <div class="col-sm-10">
                                <input
                                    type="text"
                                    class="form-control readonly-field"
                                    value="Rina Hardiyanti, SST"
                                    readonly
                                    name="bendahara"
                                />
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <div class="row">
                                    <label for="inputText" class="col-sm-12 col-form-label">Pejabat Pembuat Komitmen</label>
                                </div>
                                <div class="col-sm-10">
                                <select class="form-select" name="ppk" required>
                                    <option selected>Pilih Penandatangan</option>
                                    <option value="Luci Wulansari, S.Si, MSE.">Luci Wulansari, S.Si, MSE.</option>
                                    <option value="Nurseto Wisnumurti, S.Si., M.Stat.">Nurseto Wisnumurti, S.Si., M.Stat.</option>
                                </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-10">
                                    <input
                                      type="hidden"
                                      class="form-control"
                                      value="Menunggu Persetujuan"
                                      readonly
                                      name="status"
                                    />
                                  </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center py-3">
                            <div class="col-4 d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary float-right">Tambahkan Dokumen Excel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
      
    <x-slot name="js_body">
    </x-slot>
</x-dashboard.layouts.layouts>