<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPJ Perjalanan Dinas</title>
    <link rel="icon" href="../assets/img/logo.png" />
    <style>
        .container {
            width: 100%;
            width: 100%;
        }

        .container .header {
            display: flex;
            border-bottom: 5px solid black;
        }

        .container .header .gambar {
            width: 10%;
            height: 110px;
            padding: 50px;
            box-sizing: content-box;
        }

        .container .header .gambar img {
            width: 100%;
            margin: auto;
        }

        .container .header .text {
            width: 70%;
            margin: auto;
            text-align: center;
            padding-top: 15px;
            line-height: 5px;
        }

        .container .header div {
            width: 20%;
        }

        .container .main .judul {
            display: flex;
        }

        .container .main .judul .kiri {
            width: 25%;
        }

        .container .main .judul .kanan {
            width: 25%;
        }

        .container .main .judul .text {
            /* margin: 25px auto; */
            /* margin: 25px auto; */
            line-height: 1px;
        }

        .container .main .judul .text .atas {
            text-align: center;
            font-size: 15px;
            font-size: 15px;
            line-height: 1px;
            
        }

        .container .main .judul .text .bawah {
            margin: auto;
            text-align: center;
            line-height: 0.2px;
        }

        .container .main .isi {
            /* margin-left: 1%; */
            /* margin-left: 1%; */
            text-align: justify;
        }

        .container .main .isi .text {
            font-size: 13px;
        }

        .tabel {
            width: 100%;
            margin: 20px 0;
            overflow-x: auto; /* Untuk menangani tabel yang melebihi lebar layar */
            margin: 20px 0;
            overflow-x: auto; /* Untuk menangani tabel yang melebihi lebar layar */
        }

        table {
            width: 100%;
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
            font-size: 11px;
        }

        th, td {
            border: 0.5px solid black;
            padding: 2px;
            text-align: center;
            white-space: normal; /* Allow text to wrap */
        }

        /* Add the following style for the table header */
        thead th {
            white-space: normal;
        }

        td{
            border: .5px solid black; /* Menggunakan border 2px dan warna abu-abu (#ddd) */
            padding: 2px;
            text-align: center; /* Menengahkan tulisan */
            font-size: 11px;
        }
        td[colspan="2"] {
            background-color: #cccccc; /* Gunakan kode warna abu-abu yang diinginkan */
        }

        .jumlah-row td {
            font-weight: bold;
        }

        .jumlah-row td:nth-child(1) {
            border-bottom-left-radius: 10px;
        }

        .jumlah-row td:nth-child(7) {
            border-bottom-right-radius: 10px;
        }

        .jumlah-row td:nth-child(n+8) {
            border: 0.5px solid black;
            border: 0.5px solid black;
            border-radius: 0;
        }

        /* .container .main .isi {
            /* margin-left: 5%; */
            /* text-align: justify; */
        /* } */ 

        .ttd {
            display: flex;
            justify-content: flex-end;
        }
        
        .ttd1,
        .ttd2,
        .ttd3 {
            width: 30%; /* Ubah lebar sesuai kebutuhan Anda */
            text-align: center;
            font-size: 10px;
            line-height: 1.5;
            margin-left: 10px; /* Berikan margin antar elemen jika diinginkan */
        }

        .ttd .atas,
        .ttd .bawah {
            margin: 0; /* Hapus margin default pada elemen .atas dan .bawah */
        }

        .ttd .sign {
            width: 100%;
            height: 50px;
            box-sizing: border-box;
        }

        .ttd .sign img {
            width: 150px;
            height: 150px;
            z-index: 3;
            margin-top: -50px;
        }

        .ttd .bawah b {
            text-decoration: underline;
            margin-bottom: 0;
        }

        .ttd p {
            margin: 0;
        }

        .container .footer {
            margin-left: 5%;
            font-size: 10px;
        }

        ol {
            list-style: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
            position: relative;
        }

        li:before {
            position: absolute;
            right: 0;
            margin-left: 5px;
        }
        
        .isi {
            margin-top: 20px;
            font-size: 15px;
            line-height: -0.5;
        }

        .program,
        .aktivitas,
        .klasifikasi,
        .rencana,
        .akun,
        .tgl {
            margin-bottom: 15px;
            display: flex;
            align-items: baseline;
            font-size: 10px;
        }

        .label {
            display: inline-block;
            width: 200px; /* Sesuaikan lebar label sesuai kebutuhan */
        }

        .separator {
            display: inline-block;
            width: 400px; 
        }

        .isi-content {
            flex: 1;
            padding-bottom: 5px;
            font-size: 10px;
        }

        .label,
        .separator {
            display: inline-block;
            vertical-align: top;
            font-size: 10px;
            margin-bottom: .5rem;
        }

        .tabel-ttd td[colspan="2"] {
            background-color: #cccccc; /* Gunakan kode warna abu-abu yang diinginkan */
        }

        .tabel-ttd table {
            border-collapse: collapse;
            border: 1px solid white; /* Warna border sesuaikan dengan latar belakang tabel */
        }

        .tabel-ttd td {
            padding: 10px;
            text-align: center;
            border-right: 1px solid white; /* Garis vertikal */
        }

        .tabel-ttd td:last-child {
            border-right: none; /* Hilangkan border vertikal pada elemen terakhir */
        }

        .tabel-ttd .atas,
        .tabel-ttd .bawah {
            margin: 0;
        }

        .tabel-ttd .sign {
            height: 50px;
            box-sizing: border-box;
        }

        .tabel-ttd .sign p {
            margin: 0;
        }

        .tabel-ttd .sign img {
            width: 150px;
            height: 150px;
            z-index: 3;
            margin-top: -50px;
        }

        .tabel-ttd .bawah b {
            text-decoration: underline;
            margin-bottom: 0;
        }

        .tabel-ttd p {
            margin: 0;
        }

        /* .container .main .isi {
            /* margin-left: 5%; */
            /* text-align: justify; */
        /* } */ 

        .ttd {
            display: flex;
            justify-content: flex-end;
        }
        
        .ttd1,
        .ttd2,
        .ttd3 {
            width: 30%; /* Ubah lebar sesuai kebutuhan Anda */
            text-align: center;
            font-size: 10px;
            line-height: 1.5;
            margin-left: 10px; /* Berikan margin antar elemen jika diinginkan */
        }

        .ttd .atas,
        .ttd .bawah {
            margin: 0; /* Hapus margin default pada elemen .atas dan .bawah */
        }

        .ttd .sign {
            width: 100%;
            height: 50px;
            box-sizing: border-box;
        }

        .ttd .sign img {
            width: 150px;
            height: 150px;
            z-index: 3;
            margin-top: -50px;
        }

        .ttd .bawah b {
            text-decoration: underline;
            margin-bottom: 0;
        }

        .ttd p {
            margin: 0;
        }

        .container .footer {
            margin-left: 5%;
            font-size: 10px;
        }

        ol {
            list-style: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
            position: relative;
        }

        li:before {
            position: absolute;
            right: 0;
            margin-left: 5px;
        }
        
        .isi {
            margin-top: 20px;
            font-size: 15px;
            line-height: -0.5;
        }

        .program,
        .aktivitas,
        .klasifikasi,
        .rencana,
        .akun,
        .tgl {
            margin-bottom: 15px;
            display: flex;
            align-items: baseline;
            font-size: 10px;
        }

        .label {
            display: inline-block;
            width: 200px; /* Sesuaikan lebar label sesuai kebutuhan */
        }

        .separator {
            display: inline-block;
            width: 400px; 
        }

        .isi-content {
            flex: 1;
            padding-bottom: 5px;
            font-size: 10px;
        }

        .label,
        .separator {
            display: inline-block;
            vertical-align: top;
            font-size: 10px;
            margin-bottom: .5rem;
        }

        .tabel-ttd td[colspan="2"] {
            background-color: #cccccc; /* Gunakan kode warna abu-abu yang diinginkan */
        }

        .tabel-ttd table {
            border-collapse: collapse;
            border: 1px solid white; /* Warna border sesuaikan dengan latar belakang tabel */
        }

        .tabel-ttd td {
            padding: 10px;
            text-align: center;
            border-right: 1px solid white; /* Garis vertikal */
        }

        .tabel-ttd td:last-child {
            border-right: none; /* Hilangkan border vertikal pada elemen terakhir */
        }

        .tabel-ttd .atas,
        .tabel-ttd .bawah {
            margin: 0;
        }

        .tabel-ttd .sign {
            height: 50px;
            box-sizing: border-box;
        }

        .tabel-ttd .sign p {
            margin: 0;
        }

        .tabel-ttd .sign img {
            width: 150px;
            height: 150px;
            z-index: 3;
            margin-top: -50px;
        }

        .tabel-ttd .bawah b {
            text-decoration: underline;
            margin-bottom: 0;
        }

        .tabel-ttd p {
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="main">
            <div class="judul">
                <div class="kiri"></div>
                <div class="text">
                    <div class="atas">
                        <h3>BIAYA PERJALANAN DINAS DALAM RANGKA {{ $spjPdf->judul}}</h3>
                    </div>
                </div>
                <div class="kanan"></div>
            </div>
                    <div class="tabel">
                <div class="isi">
                    <div class="program">
                        <span class="label">PROGRAM</span>
                        <span class="separator">&ensp;:   {{ $spjPdf->program}}</span>
                    </div>
                    <div class="aktivitas">
                        <span class="label">KEGIATAN</span>
                        <span class="separator">&ensp;:   {{ $spjPdf->kegiatan}}</span> 
                    </div>
                    <div class="klasifikasi">
                        <span class="label">KRO/RO</span>
                        <span class="separator">&ensp;:   {{ $spjPdf->kro}}</span>
                    </div>
                    <div class="rencana">
                        <span class="label">KOMPONEN</span>
                        <span class="separator">&ensp;:   {{ $spjPdf->komponen}}</span>
                    </div>
                    <div class="akun">
                        <span class="label">AKUN</span>
                        <span class="separator">&ensp;:   {{ $spjPdf->akun}}</span>
                    </div>
                </div>
                    <div class="tabel">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pelaksana Perjalanan Dinas</th>
                                <th>Gol</th>
                                <th>Tanggal Tugas</th>
                                <th>Asal Penugasan</th>
                                <th>Daerah Tujuan Perjalanan Dinas</th>
                                <th>Lama Perjalanan (O-H)</th>
                                <th>Biaya Uang Harian (Rp)</th>
                                <th>Biaya Transpor (PP) (Rp)</th>
                                <th>Taksi Bandara (PP) (Rp)</th>
                                <th>Biaya Hotel</th>
                                <th>Jumlah Biaya (Rp)</th>
                                <th>Uang Muka (Rp)</th>
                                <th>Kekurangan (Rp)</th>
                                <th>Nama Bank</th>
                                <th>Nomor Rekening</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>(1)</th>
                                <th>(2)</th>
                                <th>(3)</th>
                                <th>(4)</th>
                                <th>(5)</th>
                                <th>(6)</th>
                                <th>(7)</th>
                                <th>(8)</th>
                                <th>(9)</th>
                                <th>(10)</th>
                                <th>(11)</th>
                                <th>(12)</th>
                                <th>(13)</th>
                                <th>(14)</th>
                                <th>(15)</th>
                                <th>(16)</th>
                            </tr>

                            @foreach ($tabelspj as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}.</td>
                                <td>{{ isset($item->nama_pelaksanaan_perjalanan_dinas) ? $item->nama_pelaksanaan_perjalanan_dinas : '' }}</td>
                                <td>{{ isset($item->gol) ? $item->gol : '' }}</td>
                                <td>{{ isset($spjPdf->tanggal_tugas) ? \Carbon\Carbon::parse($spjPdf->tanggal_tugas)->format('d-m-Y') : '' }}</td>
                                <td>{{ isset($item->asal_penugasan) ? $item->asal_penugasan : '' }}</td>
                                <td>{{ isset($item->daerah_tujuan_perjalanan_dinas) ? $item->daerah_tujuan_perjalanan_dinas : '' }}</td>
                                <td>{{ isset($item->lama_perjalanan) ? $item->lama_perjalanan : '' }}</td>
                                <td>{{ isset($item->uang_harian) ? $item->uang_harian : '' }}</td>
                                <td>{{ isset($item->transport) ? $item->transport : '' }}</td>
                                <td>{{ isset($item->bandara) ? $item->bandara : '' }}</td>
                                <td>{{ isset($item->biaya_hotel) ? $item->biaya_hotel : '' }}</td>
                                <td>{{ isset($item->jumlah_biaya) ? $item->jumlah_biaya : '' }}</td>
                                <td>{{ isset($item->uang_muka) ? $item->uang_muka : '' }}</td>
                                <td>{{ isset($item->kekurangan) ? $item->kekurangan : '' }}</td>
                                <td>{{ isset($item->nama_bank) ? $item->nama_bank : '' }}</td>
                                <td>{{ isset($item->nomor_rekening) ? $item->nomor_rekening : '' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="jumlah-row">
                                <td colspan="7">Jumlah</td>
                                <td>{{ $spjPdf->total_uang_harian }}</td>
                                <td>{{ $spjPdf->total_transport }}</td>
                                <td>{{ $spjPdf->total_bandara }}</td>
                                <td>{{ $spjPdf->total_biaya_hotel }}</td>
                                <td>{{ $spjPdf->total_jumlah_biaya }}</td>
                                <td>{{ $spjPdf->total_uang_muka }}</td>
                                <td>{{ $spjPdf->total_kekurangan }}</td>
                                <td class="abu", colspan="2"></td>
                            </tr>
                        </tfoot>
                    </table> 
                    </div>                            
                <div class="tabel-ttd">
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="atas">
                                        @php
                                            use Carbon\Carbon;
                                            App::setLocale('id');
                                            $tanggal_transfer = $spjPdf->tanggal_transfer;
                                            $tanggal_transfer_format = Carbon::parse($tanggal_transfer)->translatedFormat('j F Y');
                                            $tanggal_transfer_format = str_replace(ucfirst(trans(Carbon::parse($tanggal_transfer)->format('F'))), mb_convert_case(trans(Carbon::parse($tanggal_transfer)->format('F')), MB_CASE_TITLE), $tanggal_transfer_format);
                                        @endphp
                                        <p>Lunas pada tanggal:  
                                            {{ $tanggal_transfer_format }}</p>
                                        <p>Bendahara Pengeluaran STIS</p>
                                    </div>
                                    <div class="sign">
                                        <p></p>
                                    </div>
                                    <div class="bawah">
                                        <p>Rina Hardiyanti SST</p>
                                        <p>NIP. 198809142010122004</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="atas">
                                        <p>Setuju dibayar:  </p>
                                        <p>Pejabat Pembuat Komitmen</p>
                                    </div>
                                    <div class="sign">
                                        <p></p>
                                    </div>
                                    <div class="bawah">
                                        <p>{{ $spjPdf->ppk }}</p>
                                        @php
                                            $ppk = $spjPdf->ppk;
                                            $nip = '';
                                            switch ($ppk) {
                                                case 'Luci Wulansari, S.Si, MSE.':
                                                    $nip = '198504302009022006';
                                                    break;
                                                case 'Nurseto Wisnumurti, S.Si., M.Stat.':
                                                    $nip = '197009261992111001';
                                                    break;
                                                default:
                                                    $nip = '';
                                                    break;
                                            }
                                        @endphp
    
                                        <div class="bawah">
                                            <p>NIP. {{ $nip }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="atas">
                                        @php
                                            App::setLocale('id');
                                            $created_at = $spjPdf->created_at;
                                            $created_at_format = Carbon::parse($created_at)->translatedFormat('j F Y');
    
                                            $created_at_format = str_replace(ucfirst(trans(Carbon::parse($created_at)->format('F'))), mb_convert_case(trans(Carbon::parse($created_at)->format('F')), MB_CASE_TITLE), $created_at_format);
                                        @endphp
                                        <p>Jakarta, {{ $created_at_format }}<span id="tgl-bulan-tahun"></span></p>
                                        <p>Pembuat Daftar,</p>
                                    </div>                       
                                    <div class="sign">
                                        <p></p>
                                    </div>
                                    <div class="bawah">
                                        <p>{{ $spjPdf->user->name }}</p>
                                        <p>NIP. {{ $spjPdf->user->nip }}</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div> 
            </div>     
        </div>
    </div>
</body>

</html>