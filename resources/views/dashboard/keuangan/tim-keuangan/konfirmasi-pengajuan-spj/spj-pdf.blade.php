<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPJ Honor Dosen</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 10px;
        }

        .container {
            width: 100%;
        }

        .container .header {
            display: flex;
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
            margin-top: -30px;
            line-height: 1.5;
        }

        .container .header div {
            width: 20%;
        }

        .container .main .judul {
            display: flex;
            margin-bottom: 20px;
        }

        .container .main .judul .kiri,
        .container .main .judul .kanan {
            width: 25%;
        }

        .container .main .judul .text {
            margin: auto;
            text-align: center;
            line-height: 1.5;
        }

        .container .main .judul .text .atas {
            font-size: 10px;
        }

        .container .main .judul .text .bawah {
            margin: auto;
            text-align: center;
        }

        .container .main .isi {
            margin-left: 5%;
            text-align: justify;
        }

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

        .tabel {
            width: 100%;
            margin: 20px 0;
            overflow-x: auto; /* Untuk menangani tabel yang melebihi lebar layar */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            /* font-size: 14px; */
        }

        th, td {
            border: .5px solid black; 
            padding: 2px;
            text-align: center; /* Menengahkan tulisan */
        }

        td{
            border: .5px solid black; /* Menggunakan border 2px dan warna abu-abu (#ddd) */
            padding: 2px;
            text-align: center; /* Menengahkan tulisan */
            font-size: 10px;
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

        td[colspan="2"] {
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

        /* #tgl-bulan-tahun::before {
            content: '\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0'; 
        } */
    </style>
</head>

<body>
    <div class="container">
        <div class="header">         
            <div class="text">
                <h3>SURAT PERTANGGUNGJAWABAN (SPJ) HONOR DOSEN</h4>
            </div>
        </div>
        <div class="main">
            <div class="isi">
                <div class="program">
                    <span class="label">PROGRAM</span>
                    <span class="separator">&ensp;:   {{ $spjPdf->program }}</span>
                </div>
                <div class="aktivitas">
                    <span class="label">KEGIATAN</span>
                    <span class="separator">&ensp;:   {{ $spjPdf->kegiatan }}</span>
                </div>
                <div class="klasifikasi">
                    <span class="label">KLASIFIKASI RENCANA OUTPUT</span>
                    <span class="separator">&ensp;:   {{ $spjPdf->kro }}</span>
                </div>
                <div class="rencana">
                    <span class="label">RENCANA OUTPUT</span>
                    <span class="separator">&ensp;:   {{ $spjPdf->rencana_output }}</span>
                </div>
                <div class="rencana">
                    <span class="label">KOMPONEN</span>
                    <span class="separator">&ensp;:   {{ $spjPdf->komponen }}</span>
                </div>
                <div class="akun">
                    <span class="label">AKUN</span>
                    <span class="separator">&ensp;:   {{ $spjPdf->akun }}</span>
                </div>
                <div class="akun">
                    <span class="label">PERIODE</span>
                    <span class="separator">&ensp;:   {{ $spjPdf->periode }}</span>
                </div>
            </div>
            
            <div class="tabel">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Dosen</th>
                            <th>Gol</th>
                            <th>Rate Honor</th>
                            <th>SKS Wajib</th>
                            <th>SKS Hadir</th>
                            <th>SKS Dibayar</th>
                            <th>Jumlah Bruto</th>
                            <th>Pajak</th>
                            <th>Jumlah Diterima</th>
                            <th>No. Rek.</th>
                            <th>Nama Rek.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Baris pertama (nomor urut 1) -->
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
                        </tr>

                        <tbody>
                            @foreach ($tabelspj as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}.</td>
                                    <td>{{ isset($item->nama_dosen) ? $item->nama_dosen : '' }}</td>
                                    <td>{{ isset($item->golongan) ? $item->golongan : '' }}</td>
                                    <td>{{ isset($item->rate_honor) ? $item->rate_honor : '' }}</td>
                                    <td>{{ isset($item->sks_wajib) ? $item->sks_wajib : '' }}</td>
                                    <td>{{ isset($item->sks_hadir) ? $item->sks_hadir : '' }}</td>
                                    <td>{{ isset($item->sks_dibayar) ? $item->sks_dibayar : '' }}</td>
                                    <td>{{ isset($item->jumlah_bruto) ? $item->jumlah_bruto : '' }}</td>
                                    <td>{{ isset($item->pajak) ? $item->pajak : '' }}</td>
                                    <td>{{ isset($item->jumlah_diterima) ? $item->jumlah_diterima : '' }}</td>
                                    <td>{{ isset($item->nomor_rekening) ? $item->nomor_rekening : '' }}</td>
                                    <td>{{ isset($item->nama_rekening) ? $item->nama_rekening : '' }}</td>
                                </tr>
                            @endforeach
                        </tbody>

                    <tfoot>
                        <tr>
                            <td colspan="7">Jumlah</td>
                            <td>{{ $spjPdf->total_bruto }}</td>
                            <td>{{ $spjPdf->total_pajak }}</td>
                            <td>{{ $spjPdf->total }}</td>
                            <td colspan="2"></td>
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
                                    <p>Disetujui,</p>
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
</body>

</html>

