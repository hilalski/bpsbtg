<x-dashboard.layouts.layouts :menu="$menu">
    <x-slot name="css">
    </x-slot>

    <x-slot name="js_head">
    </x-slot>

    <section class="section dashboard">
        <div class="">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-bold fs-3 text-center mb-3">Surat Izin</h5>
                            <!-- General Form Elements -->
                            <form class="font-form fw-bold p-3" method="POST" action="{{ route('submit-form') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="{{$nama}}"  disabled/>
                                </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">NIM</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" value="{{$nim}}" disabled/>
                                    <input type="hidden" name="nim" value="{{$nim}}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Jenis Rapat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="{{$namaJenisRapat}}" disabled/>
                                </div>
                                </div>
                                
                                <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Nama Rapat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="{{$namaRapat}}" disabled/>
                                    <input type="hidden" name="namaRapat" value="{{$namaRapat}}">
                                </div>
                                </div>
                                
                                <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Tanggal Rapat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="{{$formattedTanggal}}" disabled/>
                                </div>
                                </div>

                                <div class="row mb-3">
                                <label for="inputNamaUnit" class="col-sm-2 col-form-label">Jenis Izin</label>
                                <div class="col-sm-10">
                                    <select id="inputNamaUnit" class="form-select font-form" name="jenisIzin">
                                    <option value="Terlambat" selected>Izin Terlambat</option>
                                    <option value="Tidak Hadir" >Izin Tidak Hadir</option>
                                    </select>
                                </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Alasan</label>
                                    <div class="col-sm-10">
                                    <input type="text" name="alasan" class="form-control" />
                                    </div>
                                </div>

                                {{-- <div class="row mb-3">
                                <label for="inputNamaUnit" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select id="inputNamaUnit" class="form-select font-form">
                                    <option selected>Menunggu</option>
                                    <option>Diterima</option>
                                    <option>Ditolak</option>
                                    </select>
                                </div>
                                </div> --}}

                                <div class="">
                                <a href="" class="col-sm-10"><small>Unduh Template Izin Di Sini</small></a>
                                </div>

                                <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Upload Izin</label>
                                <div class="col-sm-10">
                                    <input class="form-control font-form" type="file" name="formFile" id="formFile" />
                                </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="text-end">
                                    <button type="button" class="btn btn-danger" onclick="window.location.href='{{route('jadwal-rapat.index')}}'">Batal</button>
                                    <button type="submit" class="btn btn-primary" onclick="window.location.href='{{route('jadwal-rapat.index')}}'">Kirim</button>
                                    </div>
                                </div>
                            </form>
                            <!-- End General Form Elements -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

      </section>

    <x-slot name="js_body">
    </x-slot>
</x-dashboard.layouts.layouts>


