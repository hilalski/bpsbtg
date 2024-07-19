<x-dashboard.layouts.layouts :menu="$menu">
    <x-slot name="css">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dashboard/main.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/form-bau.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/detailppk.css') }}">
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path
                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
            </symbol>
            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                <path
                    d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
            </symbol>
            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path
                    d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </symbol>
        </svg>
    </x-slot>

    <x-slot name="js_head">

    </x-slot>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <section class="section dashboard">
        <div class="container">
            <div class="row">
                <!-- Left side columns -->
                <div class="col-lg-8">
                    <div class="row">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Laporan Dokumen</h5>
                                <div class="row mb-3">
                                    <label for="inputNamaUnit" class="col-sm-2 col-form-label">Nama Unit</label>
                                    <div class="col-sm-10">
                                        <select id="inputNamaUnit" class="form-select">
                                            @foreach ($roles->where('id', '!=', 2) as $role)
                                                <option>
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- tampilan unit --}}
                                <div id="dokumen-unit">
                                    <div class="alert alert-primary d-flex align-items-center" role="alert">
                                        <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Info:"
                                            width="16" height="16">
                                            <use xlink:href="#info-fill" />
                                        </svg>
                                        <div>Untuk mengunduh format laporan, silakan tekan download</div>
                                    </div>
                                    <table
                                        class="table table-hover display responsive nowrap table-striped font-body-table"
                                        style="width: 100%" {{-- id="table-bau" --}}>
                                        <thead class="header-table">
                                            <tr>
                                                <th scope="col" class="text-center align-middle">
                                                    No
                                                </th>
                                                <th scope="col" class="text-center align-middle text-wrap">
                                                    Nama Dokumen
                                                </th>
                                                <th scope="col" class="text-center align-middle text-wrap">
                                                    Template
                                                </th>
                                                <th scope="col" class="text-center align-middle">
                                                    Action
                                                </th>
                                                <th scope="col" class="text-center align-middle">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <tr>
                                                    <td class="text-center fw-bold align-middle">
                                                        1
                                                    </td>
                                                    <td class="fw-bold align-middle text-wrap">
                                                        Dokumen KAK
                                                    </td>

                                                    <td class="text-wrap text-center align-middle">

                                                    </td>
                                                    <td class="text-center align-middle">
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if(!empty($dokumenPengadaans->dokumen_kak))
                                                        <button type="button"
                                                            class="btn-siagau-dashboard btn btn-success rounded-pill fw-bold text-white" data-document="Dokumen KAK"
                                                            onclick="window.location.href='{{ route('downloadFile', ['dokumenId' => $dokumenPengadaans->dokumen_id, 'documentName' => 'dokumen_kak']) }}'">
                                                            Download
                                                        </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @if(!empty($dokumenPengadaans->dokumen_memo))
                                                <tr>
                                                    <td class="text-center fw-bold align-middle">
                                                        2
                                                    </td>
                                                    <td class="fw-bold align-middle text-wrap">
                                                        Dokumen Memo
                                                    </td>

                                                    <td class="text-wrap">

                                                    </td>
                                                    <td class="text-center align-middle">

                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <button type="button"
                                                            class="btn-siagau-dashboard btn btn-success rounded-pill fw-bold text-white" data-document="Dokumen Memo"
                                                            onclick="window.location.href='{{ route('downloadFile', ['dokumenId' => $dokumenPengadaans->dokumen_id, 'documentName' => 'dokumen_memo']) }}'">
                                                            Download
                                                        </button>

                                                    </td>
                                                </tr>
                                                @endif
                                            </table>
                                        </div>


                                {{-- tampilan ppk --}}

                                <div id="dokumen-ppk">
                                    <div class="alert alert-primary d-flex align-items-center" role="alert">
                                        <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Info:"
                                            width="16" height="16">
                                            <use xlink:href="#info-fill" />
                                        </svg>
                                        <div>Untuk mengunduh format laporan, silakan tekan download</div>
                                    </div>
                                    <table
                                        class="table table-hover display responsive nowrap table-striped font-body-table"
                                        style="width: 100%" {{-- id="table-bau" --}}>
                                        <thead class="header-table">
                                            <tr>
                                                <th scope="col" class="text-center align-middle">
                                                    No
                                                </th>
                                                <th scope="col" class="text-center align-middle text-wrap">
                                                    Nama Dokumen
                                                </th>
                                                <th scope="col" class="text-center align-middle text-wrap">
                                                    Template
                                                </th>
                                                <th scope="col" class="text-center align-middle">
                                                    Action
                                                </th>
                                                <th scope="col" class="text-center align-middle">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @php $no = 1; @endphp
                                            @if ($statusesWithDates->has('Diterima PPK'))
                                                <tr>
                                                    <td class="text-center fw-bold align-middle">
                                                        {{ $no++ }}
                                                    </td>
                                                    <td class="fw-bold align-middle text-wrap">
                                                        Dokumen Identifikasi Kebutuhan
                                                    </td>

                                                    <td class="text-wrap text-center align-middle">
                                                        <a
                                                            href="{{ route('template.download', ['filename' => 'dokumen-identifikasi-kebutuhan.docx']) }}">
                                                            Template
                                                        </a>
                                                    </td>

                                                    <td class="text-center align-middle">
                                                        @if(empty($dokumenPengadaans->dokumen_identifikasi_kebutuhan))
                                                            <button type="button"
                                                                class="btn-siagau-dashboard btn btn-primary rounded-pill fw-bold text-white"
                                                                data-bs-toggle="modal" data-bs-target="#uploadFileModal" data-document="Dokumen Identifikasi Kebutuhan">
                                                                Upload
                                                            </button>
                                                        @else
                                                            <button type="button"
                                                                class="btn-siagau-dashboard btn btn-primary rounded-pill fw-bold text-white"
                                                                data-bs-toggle="modal" data-bs-target="#uploadFileModal" data-document="Dokumen Identifikasi Kebutuhan">
                                                                Edit
                                                            </button>
                                                        @endif
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if(!empty($dokumenPengadaans->dokumen_identifikasi_kebutuhan))
                                                            <button type="button"
                                                                class="btn-siagau-dashboard btn btn-success rounded-pill fw-bold text-white" data-document="Dokumen Identifikasi Kebutuhan"
                                                                onclick="window.location.href='{{ route('downloadFile', ['dokumenId' => $dokumenPengadaans->dokumen_id, 'documentName' => 'dokumen_identifikasi_kebutuhan']) }}'">
                                                                Download
                                                            </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center fw-bold align-middle">
                                                        {{ $no++ }}
                                                    </td>
                                                    <td class="fw-bold align-middle text-wrap">
                                                        Dokumen Perencanaan Pengadaan
                                                    </td>

                                                    <td class="text-wrap text-center align-middle">
                                                        <a
                                                            href="{{ route('template.download', ['filename' => 'dokumen-perencanaan-pengadaan.docx']) }}">
                                                            Template
                                                        </a>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if(empty($dokumenPengadaans->dokumen_perencanaan_pengadaan))
                                                            <button type="button"
                                                                class="btn-siagau-dashboard btn btn-primary rounded-pill fw-bold text-white"
                                                                data-bs-toggle="modal" data-bs-target="#uploadFileModal" data-document="Dokumen Perencanaan Pengadaan">
                                                                Upload
                                                            </button>
                                                        @else
                                                            <button type="button"
                                                                class="btn-siagau-dashboard btn btn-primary rounded-pill fw-bold text-white"
                                                                data-bs-toggle="modal" data-bs-target="#uploadFileModal" data-document="Dokumen Perencanaan Pengadaan">
                                                                Edit
                                                            </button>
                                                        @endif
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if(!empty($dokumenPengadaans->dokumen_perencanaan_pengadaan))
                                                        <button type="button"
                                                            class="btn-siagau-dashboard btn btn-success rounded-pill fw-bold text-white" data-document="Dokumen Perencanaan Pengadaan"
                                                            onclick="window.location.href='{{ route('downloadFile', ['dokumenId' => $dokumenPengadaans->dokumen_id, 'documentName' => 'dokumen_perencanaan_pengadaan']) }}'">
                                                            Download
                                                        </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                            @if ($statusesWithDates->has('Diproses'))
                                                <tr>
                                                    <td class="text-center fw-bold align-middle">
                                                        {{ $no++ }}
                                                    </td>
                                                    <td class="fw-bold align-middle text-wrap">
                                                        Dokumen HPS
                                                    </td>

                                                    <td class="text-wrap text-center align-middle">
                                                        <a
                                                            href="{{ route('template.download', ['filename' => 'dokumen-hps.docx']) }}">
                                                            Template
                                                        </a>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if(empty($dokumenPengadaans->dokumen_hps))
                                                            <button type="button"
                                                                class="btn-siagau-dashboard btn btn-primary rounded-pill fw-bold text-white"
                                                                data-bs-toggle="modal" data-bs-target="#uploadFileModal" data-document="Dokumen HPS">
                                                                Upload
                                                            </button>
                                                        @else
                                                            <button type="button"
                                                                class="btn-siagau-dashboard btn btn-primary rounded-pill fw-bold text-white"
                                                                data-bs-toggle="modal" data-bs-target="#uploadFileModal" data-document="Dokumen HPS">
                                                                Edit
                                                            </button>
                                                        @endif
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if(!empty($dokumenPengadaans->dokumen_hps))
                                                        <button type="button"
                                                            class="btn-siagau-dashboard btn btn-success rounded-pill fw-bold text-white" data-document="Dokumen HPS"
                                                            onclick="window.location.href='{{ route('downloadFile', ['dokumenId' => $dokumenPengadaans->dokumen_id, 'documentName' => 'dokumen_hps']) }}'">
                                                            Download
                                                        </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center fw-bold align-middle">
                                                        {{ $no++ }}
                                                    </td>
                                                    <td class="fw-bold align-middle text-wrap">
                                                        Dokumen Nota Dinas
                                                    </td>

                                                    <td class="text-wrap text-center align-middle">
                                                        <a
                                                            href="{{ route('template.download', ['filename' => 'KAK']) }}">
                                                            Template
                                                        </a>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if(empty($dokumenPengadaans->dokumen_nota_dinas))
                                                            <button type="button"
                                                                class="btn-siagau-dashboard btn btn-primary rounded-pill fw-bold text-white"
                                                                data-bs-toggle="modal" data-bs-target="#uploadFileModal" data-document="Dokumen Nota Dinas">
                                                                Upload
                                                            </button>
                                                        @else
                                                            <button type="button"
                                                                class="btn-siagau-dashboard btn btn-primary rounded-pill fw-bold text-white"
                                                                data-bs-toggle="modal" data-bs-target="#uploadFileModal" data-document="Dokumen Nota Dinas">
                                                                Edit
                                                            </button>
                                                        @endif
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if(!empty($dokumenPengadaans->dokumen_nota_dinas))
                                                        <button type="button"
                                                            class="btn-siagau-dashboard btn btn-success rounded-pill fw-bold text-white" data-document="Dokumen Undangan"
                                                            onclick="window.location.href='{{ route('downloadFile', ['dokumenId' => $dokumenPengadaans->dokumen_id, 'documentName' => 'dokumen_undangan']) }}'">
                                                            Download
                                                        </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                            @if ($statusesWithDates->has('Dilaksanakan') && $pengadaan->penyelenggara == 4)
                                                <tr>
                                                    <td class="text-center fw-bold align-middle">
                                                        {{ $no++ }}
                                                    </td>
                                                    <td class="fw-bold align-middle text-wrap">
                                                        Dokumen Undangan
                                                    </td>

                                                    <td class="text-wrap text-center align-middle">
                                                        <a
                                                            href="{{ route('template.download', ['filename' => 'dokumen-undangan.docx']) }}">
                                                            Template
                                                        </a>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if(empty($dokumenPengadaans->dokumen_undangan))
                                                            <button type="button"
                                                                class="btn-siagau-dashboard btn btn-primary rounded-pill fw-bold text-white"
                                                                data-bs-toggle="modal" data-bs-target="#uploadFileModal" data-document="Dokumen Undangan">
                                                                Upload
                                                            </button>
                                                        @else
                                                            <button type="button"
                                                                class="btn-siagau-dashboard btn btn-primary rounded-pill fw-bold text-white"
                                                                data-bs-toggle="modal" data-bs-target="#uploadFileModal" data-document="Dokumen Undangan">
                                                                Edit
                                                            </button>
                                                        @endif
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if(!empty($dokumenPengadaans->dokumen_undangan))
                                                        <button type="button"
                                                            class="btn-siagau-dashboard btn btn-success rounded-pill fw-bold text-white" data-document="Dokumen Undangan"
                                                            onclick="window.location.href='{{ route('downloadFile', ['dokumenId' => $dokumenPengadaans->dokumen_id, 'documentName' => 'dokumen_undangan']) }}'">
                                                            Download
                                                        </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center fw-bold align-middle">
                                                        {{ $no++ }}
                                                    </td>
                                                    <td class="fw-bold align-middle text-wrap">
                                                        Dokumen SSUK SSKK
                                                    </td>

                                                    <td class="text-wrap">
                                                        <a
                                                            href="{{ route('template.download', ['filename' => 'dokumen-ssuk-sskk.docx']) }}">
                                                            Template
                                                        </a>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if(empty($dokumenPengadaans->dokumen_ssuk_sskk))
                                                            <button type="button"
                                                                class="btn-siagau-dashboard btn btn-primary rounded-pill fw-bold text-white"
                                                                data-bs-toggle="modal" data-bs-target="#uploadFileModal" data-document="Dokumen SSUK SSKK">
                                                                Upload
                                                            </button>
                                                        @else
                                                            <button type="button"
                                                                class="btn-siagau-dashboard btn btn-primary rounded-pill fw-bold text-white">
                                                                Edit
                                                            </button>
                                                        @endif
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if(!empty($dokumenPengadaans->dokumen_ssuk_sskk))
                                                        <button type="button"
                                                            class="btn-siagau-dashboard btn btn-success rounded-pill fw-bold text-white" data-document="Dokumen SSUK SSKK"
                                                            onclick="window.location.href='{{ route('downloadFile', ['dokumenId' => $dokumenPengadaans->dokumen_id, 'documentName' => 'dokumen_ssuk_sskk']) }}'">
                                                            Download
                                                        </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center fw-bold align-middle">
                                                        {{ $no++ }}
                                                    </td>
                                                    <td class="fw-bold align-middle text-wrap">
                                                        Dokumen IKP
                                                    </td>

                                                    <td class="text-wrap text-center align-middle">
                                                        <a
                                                            href="{{ route('template.download', ['filename' => 'dokumen-ikp.pdf']) }}">
                                                            Template
                                                        </a>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if(empty($dokumenPengadaans->dokumen_ikp))
                                                            <button type="button"
                                                                class="btn-siagau-dashboard btn btn-primary rounded-pill fw-bold text-white"
                                                                data-bs-toggle="modal" data-bs-target="#uploadFileModal" data-document="Dokumen IKP">
                                                                Upload
                                                            </button>
                                                        @else
                                                            <button type="button"
                                                                class="btn-siagau-dashboard btn btn-primary rounded-pill fw-bold text-white">
                                                                Edit
                                                            </button>
                                                        @endif
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if(!empty($dokumenPengadaans->dokumen_ikp))
                                                        <button type="button"
                                                            class="btn-siagau-dashboard btn btn-success rounded-pill fw-bold text-white" data-document="Dokumen IKP"
                                                            onclick="window.location.href='{{ route('downloadFile', ['dokumenId' => $dokumenPengadaans->dokumen_id, 'documentName' => 'dokumen_ikp']) }}'">
                                                            Download
                                                        </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center fw-bold align-middle">
                                                        {{ $no++ }}
                                                    </td>
                                                    <td class="fw-bold align-middle text-wrap">
                                                        Dokumen LDP dan Spesifikasi
                                                    </td>

                                                    <td class="text-wrap text-center align-middle">
                                                        <a
                                                            href="{{ route('template.download', ['filename' => 'dokumen-ldp-dan-spesifikasi.docx']) }}">
                                                            Template
                                                        </a>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if(empty($dokumenPengadaans->dokumen_ldp_dan_spesifikasi))
                                                            <button type="button"
                                                                class="btn-siagau-dashboard btn btn-primary rounded-pill fw-bold text-white"
                                                                data-bs-toggle="modal" data-bs-target="#uploadFileModal" data-document="Dokumen LDP dan Spesifikasi">
                                                                Upload
                                                            </button>
                                                        @else

                                                            <button type="button"
                                                                class="btn-siagau-dashboard btn btn-primary rounded-pill fw-bold text-white">
                                                                Edit
                                                            </button>
                                                        @endif
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if(!empty($dokumenPengadaans->dokumen_ldp_dan_spesifikasi))
                                                        <button type="button"
                                                            class="btn-siagau-dashboard btn btn-success rounded-pill fw-bold text-white" data-document="Dokumen LDP dan Spesifikasi"
                                                            onclick="window.location.href='{{ route('downloadFile', ['dokumenId' => $dokumenPengadaans->dokumen_id, 'documentName' => 'dokumen_ldp_dan_spesifikasi']) }}'">
                                                            Download
                                                        </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center fw-bold align-middle">
                                                        {{ $no++ }}
                                                    </td>
                                                    <td class="fw-bold align-middle text-wrap">
                                                        Dokumen Penawaran
                                                    </td>

                                                    <td class="text-wrap text-center align-middle">
                                                        <a
                                                            href="{{ route('template.download', ['filename' => 'dokumen-penawaran-pakta-dan-formulir-isian-kualifikasi.docx']) }}">
                                                            Template
                                                        </a>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if(empty($dokumenPengadaans->dokumen_penawaran))
                                                            <button type="button"
                                                                class="btn-siagau-dashboard btn btn-primary rounded-pill fw-bold text-white"
                                                                data-bs-toggle="modal" data-bs-target="#uploadFileModal" data-document="Dokumen Penawaran">
                                                                Upload
                                                            </button>
                                                        @else
                                                            <button type="button"
                                                                class="btn-siagau-dashboard btn btn-primary rounded-pill fw-bold text-white">
                                                                Edit
                                                            </button>
                                                        @endif
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if(!empty($dokumenPengadaans->dokumen_penawaran))
                                                            <button type="button"
                                                            class="btn-siagau-dashboard btn btn-success rounded-pill fw-bold text-white" data-document="Dokumen Penawaran"
                                                            onclick="window.location.href='{{ route('downloadFile', ['dokumenId' => $dokumenPengadaans->dokumen_id, 'documentName' => 'dokumen_penawaran']) }}'">
                                                            Download
                                                        </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center fw-bold align-middle">
                                                        {{ $no++ }}
                                                    </td>
                                                    <td class="fw-bold align-middle text-wrap">
                                                        Dokumen Surat Permintaan
                                                    </td>

                                                    <td class="text-wrap text-center align-middle">
                                                        <a
                                                            href="{{ route('template.download', ['filename' => 'dokumen-surat-permintaan.docx']) }}">
                                                            Template
                                                        </a>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if(empty($dokumenPengadaans->dokumen_surat_permintaan))
                                                            <button type="button"
                                                                class="btn-siagau-dashboard btn btn-primary rounded-pill fw-bold text-white"
                                                                data-bs-toggle="modal" data-bs-target="#uploadFileModal" data-document="Dokumen Surat Permintaan">
                                                                Upload
                                                            </button>
                                                        @else
                                                            <button type="button"
                                                                class="btn-siagau-dashboard btn btn-primary rounded-pill fw-bold text-white">
                                                                Edit
                                                            </button>
                                                        @endif
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if(!empty($dokumenPengadaans->dokumen_surat_permintaan))
                                                            <button type="button"
                                                                class="btn-siagau-dashboard btn btn-success rounded-pill fw-bold text-white" data-document="Dokumen Surat Permintaan"
                                                                onclick="window.location.href='{{ route('downloadFile', ['dokumenId' => $dokumenPengadaans->dokumen_id, 'documentName' => 'dokumen_surat_permintaan']) }}'">
                                                                Download
                                                            </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center fw-bold align-middle">
                                                        {{ $no++ }}
                                                    </td>
                                                    <td class="fw-bold align-middle text-wrap">
                                                        Dokumen Pengadaan Langsung
                                                    </td>

                                                    <td class="text-wrap text-center align-middle">
                                                        <a
                                                            href="{{ route('template.download', ['filename' => 'dokumen-pengadaan-langsung.docx']) }}">
                                                            Template
                                                        </a>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if(empty($dokumenPengadaans->dokumen_pengadaan_langsung))
                                                            <button type="button"
                                                                class="btn-siagau-dashboard btn btn-primary rounded-pill fw-bold text-white"
                                                                data-bs-toggle="modal" data-bs-target="#uploadFileModal" data-document="Dokumen Pengadaan Langsung">
                                                                Upload
                                                            </button>
                                                        @else

                                                            <button type="button"
                                                                class="btn-siagau-dashboard btn btn-primary rounded-pill fw-bold text-white">
                                                                Edit
                                                            </button>
                                                        @endif
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if(!empty($dokumenPengadaans->dokumen_pengadaan_langsung))
                                                            <button type="button"
                                                                class="btn-siagau-dashboard btn btn-success rounded-pill fw-bold text-white" data-document="Dokumen Pengadaan Langsung"
                                                                onclick="window.location.href='{{ route('downloadFile', ['dokumenId' => $dokumenPengadaans->dokumen_id, 'documentName' => 'dokumen_pengadaan_langsung']) }}'">
                                                                Download
                                                            </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                            @if ($statusesWithDates->has('Selesai'))
                                                <tr>
                                                    <td class="text-center fw-bold align-middle">
                                                        {{ $no++ }}
                                                    </td>
                                                    <td class="fw-bold align-middle text-wrap">
                                                        Dokumen BAST
                                                    </td>
                                                    <td class="text-wrap text-center align-middle">
                                                        <a
                                                            href="{{ route('template.download', ['filename' => 'dokumen-bast.docx']) }}">
                                                            Template
                                                        </a>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if(empty($dokumenPengadaans->dokumen_bast))
                                                            <button type="button"
                                                                class="btn-siagau-dashboard btn btn-primary rounded-pill fw-bold text-white"
                                                                data-bs-toggle="modal" data-bs-target="#uploadFileModal" data-document="Dokumen BAST">
                                                                Upload
                                                            </button>
                                                        @else
                                                            <button type="button"
                                                                class="btn-siagau-dashboard btn btn-primary rounded-pill fw-bold text-white">
                                                                Edit
                                                            </button>
                                                        @endif
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if(!empty($dokumenPengadaans->dokumen_bast))
                                                            <button type="button"
                                                                class="btn-siagau-dashboard btn btn-success rounded-pill fw-bold text-white" data-document="Dokumen BAST"
                                                                onclick="window.location.href='{{ route('downloadFile', ['dokumenId' => $dokumenPengadaans->dokumen_id, 'documentName' => 'dokumen_bast']) }}'">
                                                                Download
                                                            </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>

                                    <div class="text-center">
                                        @if (!in_array($pengadaan->status, ['Diajukan', 'Revisi', 'Ditolak','Diserahkan']))
                                            @if ($pengadaan->status == 'Diterima PPK')
                                                <a href="#" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#setujuModalKhusus">Selesai</a>
                                            @else
                                                @if($pengadaan->status !== "Dilaksanakan" && $pengadaan->penyelenggara === 3  )
                                                <a href="#" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#setujuModalL">Selesai</a>
                                                @endif
                                            @endif
                                        @endif
                                    </div>

                                </div>

                                {{-- tampilan pbj --}}
                                <div id="dokumen-pbj">
                                    @php $no = 1; @endphp
                                    @if ($statusesWithDates->has('Dilaksanakan') && $pengadaan->penyelenggara === 3)
                                    <div class="alert alert-primary d-flex align-items-center" role="alert">
                                        <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Info:"
                                            width="16" height="16">
                                            <use xlink:href="#info-fill" />
                                        </svg>
                                        <div>Untuk mengunduh format laporan, silakan tekan download</div>
                                    </div>
                                    <table
                                        class="table table-hover display responsive nowrap table-striped font-body-table"
                                        style="width: 100%" {{-- id="table-bau" --}}>
                                        <thead class="header-table">
                                            <tr>
                                                <th scope="col" class="text-center align-middle">
                                                    No
                                                </th>
                                                <th scope="col" class="text-center align-middle text-wrap">
                                                    Nama Dokumen
                                                </th>
                                                <th scope="col" class="text-center align-middle text-wrap">
                                                    Template
                                                </th>
                                                <th scope="col" class="text-center align-middle">
                                                    Action
                                                </th>
                                                <th scope="col" class="text-center align-middle">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                                <tr>
                                                    <td class="text-center fw-bold align-middle">
                                                        {{ $no++ }}
                                                    </td>
                                                    <td class="fw-bold align-middle text-wrap">
                                                        Dokumen Undangan
                                                    </td>

                                                    <td class="text-wrap text-center align-middle">

                                                    </td>
                                                    <td class="text-center align-middle">
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if(!empty($dokumenPengadaans->dokumen_undangan))
                                                        <button type="button"
                                                            class="btn-siagau-dashboard btn btn-success rounded-pill fw-bold text-white" data-document="Dokumen Undangan"
                                                            onclick="window.location.href='{{ route('downloadFile', ['dokumenId' => $dokumenPengadaans->dokumen_id, 'documentName' => 'dokumen_undangan']) }}'">
                                                            Download
                                                        </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center fw-bold align-middle">
                                                        {{ $no++ }}
                                                    </td>
                                                    <td class="fw-bold align-middle text-wrap">
                                                        Dokumen SSUK SSKK
                                                    </td>

                                                    <td class="text-wrap">

                                                    </td>
                                                    <td class="text-center align-middle">

                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if(!empty($dokumenPengadaans->dokumen_ssuk_sskk))
                                                        <button type="button"
                                                            class="btn-siagau-dashboard btn btn-success rounded-pill fw-bold text-white" data-document="Dokumen SSUK SSKK"
                                                            onclick="window.location.href='{{ route('downloadFile', ['dokumenId' => $dokumenPengadaans->dokumen_id, 'documentName' => 'dokumen_ssuk_sskk']) }}'">
                                                            Download
                                                        </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center fw-bold align-middle">
                                                        {{ $no++ }}
                                                    </td>
                                                    <td class="fw-bold align-middle text-wrap">
                                                        Dokumen IKP
                                                    </td>

                                                    <td class="text-wrap text-center align-middle">
                                                    </td>
                                                    <td class="text-center align-middle">

                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if(!empty($dokumenPengadaans->dokumen_ikp))
                                                        <button type="button"
                                                            class="btn-siagau-dashboard btn btn-success rounded-pill fw-bold text-white" data-document="Dokumen IKP"
                                                            onclick="window.location.href='{{ route('downloadFile', ['dokumenId' => $dokumenPengadaans->dokumen_id, 'documentName' => 'dokumen_ikp']) }}'">
                                                            Download
                                                        </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center fw-bold align-middle">
                                                        {{ $no++ }}
                                                    </td>
                                                    <td class="fw-bold align-middle text-wrap">
                                                        Dokumen LDP dan Spesifikasi
                                                    </td>

                                                    <td class="text-wrap text-center align-middle">

                                                    </td>
                                                    <td class="text-center align-middle">

                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if(!empty($dokumenPengadaans->dokumen_ldp_dan_spesifikasi))
                                                        <button type="button"
                                                            class="btn-siagau-dashboard btn btn-success rounded-pill fw-bold text-white" data-document="Dokumen LDP dan Spesifikasi"
                                                            onclick="window.location.href='{{ route('downloadFile', ['dokumenId' => $dokumenPengadaans->dokumen_id, 'documentName' => 'dokumen_ldp_dan_spesifikasi']) }}'">
                                                            Download
                                                        </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center fw-bold align-middle">
                                                        {{ $no++ }}
                                                    </td>
                                                    <td class="fw-bold align-middle text-wrap">
                                                        Dokumen Penawaran
                                                    </td>

                                                    <td class="text-wrap text-center align-middle">

                                                    </td>
                                                    <td class="text-center align-middle">

                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if(!empty($dokumenPengadaans->dokumen_penawaran))
                                                            <button type="button"
                                                            class="btn-siagau-dashboard btn btn-success rounded-pill fw-bold text-white" data-document="Dokumen Penawaran"
                                                            onclick="window.location.href='{{ route('downloadFile', ['dokumenId' => $dokumenPengadaans->dokumen_id, 'documentName' => 'dokumen_penawaran']) }}'">
                                                            Download
                                                        </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center fw-bold align-middle">
                                                        {{ $no++ }}
                                                    </td>
                                                    <td class="fw-bold align-middle text-wrap">
                                                        Dokumen Surat Permintaan
                                                    </td>

                                                    <td class="text-wrap text-center align-middle">

                                                    </td>
                                                    <td class="text-center align-middle">

                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if(!empty($dokumenPengadaans->dokumen_surat_permintaan))
                                                            <button type="button"
                                                                class="btn-siagau-dashboard btn btn-success rounded-pill fw-bold text-white" data-document="Dokumen Surat Permintaan"
                                                                onclick="window.location.href='{{ route('downloadFile', ['dokumenId' => $dokumenPengadaans->dokumen_id, 'documentName' => 'dokumen_surat_permintaan']) }}'">
                                                                Download
                                                            </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center fw-bold align-middle">
                                                        {{ $no++ }}
                                                    </td>
                                                    <td class="fw-bold align-middle text-wrap">
                                                        Dokumen Pengadaan Langsung
                                                    </td>

                                                    <td class="text-wrap text-center align-middle">

                                                    </td>
                                                    <td class="text-center align-middle">

                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if(!empty($dokumenPengadaans->dokumen_pengadaan_langsung))
                                                            <button type="button"
                                                                class="btn-siagau-dashboard btn btn-success rounded-pill fw-bold text-white" data-document="Dokumen Pengadaan Langsung"
                                                                onclick="window.location.href='{{ route('downloadFile', ['dokumenId' => $dokumenPengadaans->dokumen_id, 'documentName' => 'dokumen_pengadaan_langsung']) }}'">
                                                                Download
                                                            </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Left side columns -->

                <!-- Right side columns -->
                <div class="col-lg-4">
                    <!-- Recent Activity -->
                    <div class="card">

                        <div class="card-body">
                            <h5 class="card-title">
                                Status Pengadaan
                            </h5>
                            <div class="activity">
                                @if($statusesWithDates->has('Diajukan'))
                                <div class="activity-item d-flex">
                                    <div class="activite-label">{{$statusesWithDates->get('Diajukan')}}</div>
                                    <i class="bi bi-circle-fill activity-badge text-success align-self-start"></i>
                                    <div class="activity-content">
                                        Diajukan
                                    </div>
                                </div>
                                <!-- End activity item-->
                                @if($statusesWithDates->has('Diterima PPK'))
                                <div class="activity-item d-flex">
                                    <div class="activite-label">{{$statusesWithDates->get('Diterima PPK')}}</div>
                                    <i class="bi bi-circle-fill activity-badge text-danger align-self-start"></i>
                                    <div class="activity-content">
                                        Diterima PPK
                                    </div>
                                </div>
                                <!-- End activity item-->
                                @if($statusesWithDates->has('Diproses'))
                                <div class="activity-item d-flex">
                                    <div class="activite-label">{{$statusesWithDates->get('Diproses')}}</div>
                                    <i class="bi bi-circle-fill activity-badge text-primary align-self-start"></i>
                                    <div class="activity-content">
                                        Diproses oleh <p class="fw-bold text-dark">{{$pengadaan->role->name}}</p>
                                    </div>
                                </div>
                                <!-- End activity item-->
                                @if($statusesWithDates->has('Dilaksanakan'))
                                <div class="activity-item d-flex">
                                    <div class="activite-label">{{$statusesWithDates->get('Dilaksanakan')}}</div>
                                    <i class="bi bi-circle-fill activity-badge text-info align-self-start"></i>
                                    <div class="activity-content">
                                        Dilaksanakan
                                    </div>
                                </div>
                                <!-- End activity item-->
                                @if($statusesWithDates->has('Selesai'))
                                <div class="activity-item d-flex">
                                    <div class="activite-label">{{$statusesWithDates->get('Selesai')}}</div>
                                    <i class="bi bi-circle-fill activity-badge text-warning align-self-start"></i>
                                    <div class="activity-content">
                                        Selesai
                                    </div>
                                </div>
                                <!-- End activity item-->
                                @if($statusesWithDates->has('Diserahkan'))
                                <div class="activity-item d-flex">
                                    <div class="activite-label">
                                        {{$statusesWithDates->get('Diserahkan')}}
                                    </div>
                                    <i class="bi bi-circle-fill activity-badge text-muted align-self-start"></i>
                                    <div class="activity-content">
                                        Pengadaan telah diserahkan kepada Unit
                                    </div>
                                </div>
                                @endif
                                @endif
                                @endif
                                @endif
                                @elseif($statusesWithDates->has('Revisi'))
                                <div class="activity-item d-flex">
                                    <div class="activite-label">
                                        {{$statusesWithDates->get('Revisi')}}
                                    </div>
                                    <i class="bi bi-circle-fill activity-badge text-muted align-self-start"></i>
                                    <div class="activity-content">
                                        Pengadaan ditolak dengan revisi
                                    </div>
                                </div>
                                @elseif($statusesWithDates->has('Ditolak'))
                                <div class="activity-item d-flex">
                                    <div class="activite-label">
                                        {{$statusesWithDates->get('Ditolak')}}
                                    </div>
                                    <i class="bi bi-circle-fill activity-badge text-muted align-self-start"></i>
                                    <div class="activity-content">
                                        Pengadaan ditolak tanpa revisi
                                    </div>
                                </div>
                                @endif
                                @endif
                                <!-- End activity item-->
                            </div>
                        </div>
                    </div>
                    <!-- End Recent Activity -->
                </div>
                <!-- End Right side columns -->
                @if ($pengadaan->status == 'Diajukan')
                    <div class="text-center">
                        <a href="#" class="btn btn-secondary btn-merah" data-bs-toggle="modal"
                            data-bs-target="#tolakModal">Tolak</a>
                        <a href="#" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#setujuModalL">Setuju</a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="tolakModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="{{ route('tolak')}}" method="post">
                        @csrf
                        <div class="modal-header text-center">
                            <h5 class="modal-title modal-center fw-bolder" id="exampleModalLabel">Alasan Penolakan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-floating">
                                <textarea class="form-control" name="alasan_penolakan" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                <label for="floatingTextarea2">Alasan Penolakan</label>
                            </div>

                            <div class="col-12 mt-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="gridCheck" name="dengan_revisi" />
                                    <label class="form-check-label" for="gridCheck">
                                        Dengan revisi
                                    </label>
                                </div>
                            </div>

                            <input type="hidden" name="pengadaan_id" value="{{$pengadaan->id}}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-secondary btn-merah">Tolak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- Modal untuk Upload File --}}
        <div class="modal fade" id="uploadFileModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="uploadModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="margin: 10px;">
                    <div class="modal-header">
                        <h4 class="alert-heading" id="modalTitle">Upload <span id="documentPlaceholder">[document]</span></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('upload-dokumens') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <input type="file" class="file-upload" name="uploadFile" />
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="documentName" id="documentName">
                            <input type="hidden" name="dokumen_id" id="dokumen_id" value="{{ $dokumenPengadaans->dokumen_id }}">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        {{-- Modal Tombol Selesai --}}
        <div class="modal fade" id="setujuModalL" aria-hidden="true"
            data-bs-keyboard="false" data-bs-backdrop="static"
            aria-labelledby="setujuModalKhususLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title modal-center fw-bolder"
                            id="exampleModalLabel">
                            Konfirmasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin ?
                    </div>
                    <div class="modal-footer">
                        <a href="#" type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Batal</a>
                        <a href="#"  class="btn btn-success"
                            id="confirmButton"
                            data-url="{{ route('update-status', ['pengadaan' => $pengadaan->id, 'penyelenggara' => $pengadaan->penyelenggara]) }}"
                            data-id="{{ $pengadaan->id }}">Yakin</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="setujuModalKhusus" aria-hidden="true"
            data-bs-keyboard="false" data-bs-backdrop="static"
            aria-labelledby="setujuModalKhususLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalToggleLabel">
                            Pelaksana
                            Pengadaan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body mb-3">
                        Tentukan Pelaksana Pengadaan
                    </div>
                    <div class="modal-footer d-flex justify-content-center">

                        <a class="btn btn-primary me-2"
                            id="ppkConfirmButton"
                            data-url="{{ route('update-status', ['pengadaan' => $pengadaan->id, 'penyelenggara' => 4]) }}"
                            data-id="{{ $pengadaan->id }}"
                            >PPK</a>
                        <a class="btn btn-primary"
                            id="pbjConfirmButton"
                            data-url="{{ route('update-status', ['pengadaan' => $pengadaan->id, 'penyelenggara' => 3]) }}"
                            data-id="{{ $pengadaan->id }}">PBJ</a>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <x-slot name="js_body">
        <script src="{{ asset('assets/js/script.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                $('#uploadFileModal').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget);
                    var documentName = button.data('document').replace(/\s/g, '_').toLowerCase();
                    var documentNames = button.data('document');
                    $(this).find('#documentName').val(documentName);
                    $(this).find('#documentPlaceholder').text(documentNames);
                });
            });
        </script>
    </x-slot>
</x-dashboard.layouts.layouts>
