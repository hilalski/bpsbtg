<x-dashboard.layouts.layouts :menu="$menu">
    <x-slot name="css">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dashboard/main.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/form-bau.css') }}">
    </x-slot>

    <x-slot name="js_head">
    </x-slot>

    @if (session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif
    <section class="section draft-pengajuan">
        <div class="">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-bold fs-3 text-center">Form Pengajuan Pengadaan</h5>
                            <br>

                            <!-- General Form Elements -->
                            <form method="POST" action="{{ route('unit.pengajuan.kirim-form') }}"
                                class="font-form fw-bold" enctype="multipart/form-data">
                                @csrf

                                <!-- Nama Unit -->
                                <div class="row mb-3">
                                    <label for="inputNamaUnit" class="col-sm-2 col-form-label">Nama Unit</label>
                                    <div class="col-sm-10">
                                        <select name="role_id" id="inputNamaUnit" class="form-select font-form">
                                            <option selected>Choose...</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('role_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Nama Paket Pengadaan -->
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Nama Paket Pengadaan</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama_pengadaan" class="form-control" value="{{ old('nama_pengadaan') }}"/>
                                        @error('nama_pengadaan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Tanggal Pengadaan -->
                                <div class="row mb-3">
                                    <label for="inputDate" class="col-sm-2 col-form-label">Tanggal Pengadaan</label>
                                    <div class="col-sm-10">
                                        <input type="date" name="tanggal_pengadaan" class="form-control font-form" value="{{ old('tanggal_pengadaan') }}" min="{{ now()->toDateString() }}"/>
                                        @error('tanggal_pengadaan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Unduh Template Dokumen KAK -->
                                <div class="mb-1">
                                    <a href="{{ route('template.download', ['filename' => 'dokumen-kak.docx']) }}"
                                        class="btn-link btn-sm fw-bold text-decoration-none
                                        "><small>Unduh Template Dokumen KAK</small></a>
                                </div>

                                <!-- Upload Dokumen KAK -->
                                <div class="row mb-3">
                                    <label for="formFileKak" class="col-sm-2 col-form-label">Upload Dokumen KAK (PDF)</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <input name="dokumen_kak" class="form-control font-form" type="file" id="formFileKak" onchange="showRemoveButton()"/>
                                            <button type="button" class="btn btn-danger" id="removeButton"
                                                style="display:none;" onclick="removeFile()">Remove</button>
                                        </div>
                                        <div id="fileErrorMessage" class="text-danger"></div>
                                        @error('dokumen_kak')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Unduh Template Memo -->
                                <div class="mb-1">
                                    <a href="{{ route('template.download', ['filename' => 'dokumen-kak.docx']) }}"
                                        class="btn-link btn-sm btn-link btn-sm fw-bold text-decoration-none"><small>Unduh Template Memo</small></a>
                                </div>

                                <!-- Upload Dokumen Memo -->
                                <div class="row mb-3">
                                    <label for="formFileMemo" class="col-sm-2 col-form-label">Upload Dokumen Memo (PDF)</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <input name="dokumen_memo" class="form-control font-form" type="file" id="formFileMemo" onchange="showRemoveButton()"/>
                                            <button type="button" class="btn btn-danger" id="removeButton"
                                                style="display:none;" onclick="removeFile()">Remove</button>
                                        </div>
                                        <div id="fileErrorMessage" class="text-danger"></div>
                                        @error('dokumen_memo')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                <!-- Tombol Aksi -->
                                <div class="row mb-3">
                                    <div class="text-end">
                                        <button type="button" class="btn btn-danger"
                                            onclick="window.location.href='{{ route('unit.pengajuan.index') }}'">Batal</button>
                                        <button type="submit" class="btn btn-primary">Kirim</button>
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
        <script src="{{ asset('assets/js/script.js') }}"></script>
    </x-slot>
</x-dashboard.layouts.layouts>
