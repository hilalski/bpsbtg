<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SURAT PERJALANAN DINAS (SPD)</title>
    <style>
      @page{
        size: a4 portrait;
      }
      @font-face{
        font-family: 'BookmanOldStyle';
        src: url({{ storage_path("fonts/bookman-old-style.ttf") }}) format('truetype');
        font-weight: 700;
        font-style: normal;
      }
      .logo{
        width: 100%;
        position: fixed;
        top: -50px;
        left: 0px;
        right: 0;
        display: block;
        background: #ffffff;
        color: #fff;
        font-size: 18px;
        padding-top: 30px;
        font-weight: bolder;
        border-radius: 5px;
        height: 50px;
        text-align: center;
        line-height: 35px;
      }
      body {
        font-family: 'BookmanOldStyle', Times, serif;
        font-size: 12px;
        margin: 20px;
        line-height: 1.3;
      }
      .surat-perjalanan {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
      }

      table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
      }

      th,
      td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
      }

      
      /* Tambahkan class khusus untuk tabel nomor dan lembar */
      .table-no-border {
        border-collapse: separate;
      }

      .lampiran tr {
        align-items: baseline; /* Penyejajaran sejajar pada baseline */
      }

      .table-no-border th,
      .table-no-border td {
        border: none;
        padding: 8px;
        text-align: left;
      }

      .footer {
        text-align: right;
        margin-top: 15px;
        padding-right: 30px;
      }

      /* Surtug */
      .surat-tugas {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
      }

      h2 {
        text-align: center;
      }

      .content {
        margin-top: 0px;
        text-align: center;
      }

      .footer {
        text-align: right;
        margin: 0px 50px;
      }

      .half-space {
        margin-right: 0.1em; /* Ganti dengan nilai yang sesuai untuk setengah spasi */
      }
    </style>
  </head>
  <body>
    <div class="surat-tugas" style="border:none">
      <div class="logo">
        <img src="{{ public_path('assets/img/LogoSTISBW.png') }}" style="width: 80px; height:80px"  alt="Logo STIS">
      </div>
      <h2>SURAT TUGAS</h2>

      <div class="content">
        <p>Nomor: {{ $data->no_surtug }}</p>
      </div>
      <div class="lampiran">
        <table>
          <tbody>
            <tr style="border: none">
              <td style="border: none">Menimbang&nbsp;&nbsp;&nbsp;:</td>
              <td style="border: none">
                Bahwa sehubungan dengan {{ $data->nama_kegiatan }}, perlu menugaskan nama yang
                tersebut dalam surat tugas ini;
              </td>
            </tr>
            <tr style="border: none">
              <td style="border: none">
                Mengingat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
              </td>
              <td style="border: none">
                1. Undang-Undang Republik Indonesia No. 6 Tahun 1997 tentang Statistik;<br/>
                2. Peraturan Pemerintah No. 51 Tahun 1999 tentang
                Penyelenggaraan Statistik;<br />
                3. Peraturan Presiden No. 86 Tahun 2007 tentang Badan Pusat
                Statistik;<br />
                4. Peraturan Badan Pusat Statistik Nomor 7 Tahun 2020 tentang
                Organisasi dan Tata Kerja Badan Pusat &nbsp;&nbsp;&nbsp;&nbsp;Statistik;<br />
                5. Peraturan Badan Pusat Statistik Nomor 8 Tahun 2020 tentang
                Organisasi dan Tata Kerja Badan Pusat &nbsp;&nbsp;&nbsp;&nbsp;Statistik Provinsi dan
                Badan Pusat Statistik Kabupaten/Kota;<br />
                6. Peraturan Menteri Keuangan Republik Indonesia No.
                60/PMK.02/2021 tentang Standar Biaya Masukan &nbsp;&nbsp;&nbsp;&nbsp;Tahun Anggaran
                2022; dan<br />
                7. Peraturan Badan Pusat Statistik No. 5 Tahun 2019 tentang Tata
                Naskah Dinas di Lingkungan Badan &nbsp;&nbsp;&nbsp;&nbsp;Pusat Statistik.<br />
              </td>
            </tr>
            <!-- Tambahkan baris lain jika diperlukan -->
          </tbody>
        </table>
      </div>
      <div class="content">
        <p>Menugaskan:</p>
      </div>

      <div class="lampiran">
        <table>
          <tbody>
            <tr style="border: none">
              <td style="border: none">Kepada&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
              <td style="border: none">Daftar terlampir</td>
            </tr>
            <tr style="border: none">
              <td style="border: none">Untuk&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
              <td style="border: none">Melakukan perjalanan dinas dalam rangka {{ $data->nama_kegiatan }} di {{ $data->lokasi }} Pada tanggal {{ \Carbon\Carbon::parse($data->tanggal_perdin_mulai)->translatedFormat('d F Y') }} s.d {{ \Carbon\Carbon::parse($data->tanggal_perdin_selesai)->translatedFormat('d F Y') }}</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="footer">
        <p style="text-align: center; padding-left:350px">
          Jakarta, {{ $data->tanggal_ttd->translatedFormat('d F Y') }} <br>
          {{ $data->jabatan_pejabat_ttd }}
        </p>
        <br /><br /><br />
        <p style="text-align: center; padding-left:350px">{{ $data->nama_pejabat_ttd }}</p>
      </div>

      <br /><br /><br /><br />
      <br /><br /><br /><br />
      <br /><br /><br /><br />
      <br /><br /><br /><br />
      <br /><br /><br /><br />

      <div class="content">
        <p>Lampiran Surat Tugas</p>
        <p>Nomor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $data->no_surtug }}</p>
        <p>Tanggal&nbsp;&nbsp;&nbsp;: {{ \Carbon\Carbon::parse($data->tanggal_ttd)->translatedFormat('d F Y') }}<</p>
      </div>

      <table class="tabel-peserta-fullwidth">
        <tbody>
          <tr>
            <td>No</td>
            <td>Nama</td>
            <td>NIP</td>
            <td>Gol</td>
            <td>Jabatan</td>
          </tr>
          <tr>
            <td>1</td>
            <td>{{ $data->name }}</td>
            <td>{{ $data->nip }}</td>
            <td>{{ $data->golongan }}</td>
            <td>{{ $data->jabatan }}</td>
          </tr>
          <!-- Tambahkan baris sesuai kebutuhan -->
        </tbody>
      </table>
    </div>
    <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
    <br /><br /><br /><br />
    <br /><br /><br /><br />
    <br /><br /><br /><br />
    <br /><br /><br /><br />
    <div class="surat-perjalanan" style="border:none">
      <!-- Tabel Nomor dan Lembar tanpa border -->
      <table class="table-no-border">
        <tbody>
          <tr>
            <td>Politeknik Statistika STIS</td>
            <td>Nomor &nbsp;&nbsp;&nbsp;: {{  $data->no_surtug  }}</td>
          </tr>
          <tr>
            <td>Jl. Otto Iskandardinata no. 64C</td>
            <td>Lembar &nbsp;: 1</td>
          </tr>
          <tr>
            <td>JAKARTA</td>
          </tr>
        </tbody>
      </table>

      <!-- Tabel Pejabat Pembuat Komitmen dan lainnya dengan border -->
      <table>
        <tbody>
          <tr>
            <td>1.</td>
            <td>Pejabat Pembuat Komitmen</td>
            <td colspan="2"> {{ $data->ppk }}</td>
          </tr>
          <tr>
            <td>2.</td>
            <td>Nama pegawai yang diperintah</td>
            <td colspan="2">{{ $data->name }}</td>
          </tr>
          <tr>
            <td>3.</td>
            <td>
              a. Pangkat dan golongan menurut PGPS – 1968<br />
              b. Jabatan <br />
              c. Gaji Pokok <br />
              d. Tingkat menurut peraturan perjalanan dinas
            </td>
            <td colspan="2">
              {{ $data->golongan }} <br />
              {{ $data->jabatan }} <br />
              {{ $data->user->gaji }} <br />
              -
            </td>
          </tr>
          <tr>
            <td>4.</td>
            <td>Maksud perjalanan dinas</td>
            <td colspan="2">{{ $data->nama_kegiatan }}</td>
          </tr>
          <tr>
            <td>5.</td>
            <td>Angkutan yag dipergunakan</td>
            <td colspan="2">{{ $data->moda_transportasi }}</td>
          </tr>

          <tr>
            <td>6.</td>
            <td>
              a. Tempat berangkat <br />
              b. Tempat tujuan
            </td>
            <td colspan="2">
              Jakarta <br />
              {{ $data->lokasi }} <br />
            </td>
          </tr>

          <tr>
            <td>7.</td>
            <td>
              a. Lamanya perjalanan dinas <br />
              b. Tanggal berangkat <br />
              c. Tanggal harus kembali
            </td>
            <td colspan="2">
              <br />
              {{ \Carbon\Carbon::parse($data->tanggal_perdin_mulai)->translatedFormat('d F Y') }} <br />
              {{ \Carbon\Carbon::parse($data->tanggal_perdin_selesai)->translatedFormat('d F Y') }}
            </td>
          </tr>

          <tr>
            <td>8.</td>
            <td>Pengikut :</td>
            <td>Umur</td>
            <td>Hubungan keluarga/keterangan</td>
          </tr>

          <tr>
            <td>9.</td>
            <td>
              Pembebabanan anggaran : <br />
              &nbsp;&nbsp;&nbsp;&nbsp;Program <br />
              &nbsp;&nbsp;&nbsp;&nbsp;Kegiatan <br />
              &nbsp;&nbsp;&nbsp;&nbsp;Output <br />
              &nbsp;&nbsp;&nbsp;&nbsp;Komponen <br />
              &nbsp;&nbsp;&nbsp;&nbsp;Sub Komponen <br />
              a. Instansi <br />
              b. Mata anggaran
            </td>
            <td colspan="2">
              <br />
              {{ $data->kode_program }} <br />
              {{ $data->kode_kegiatan }} <br />
              {{ $data->kode_output }} <br />
              {{ $data->kode_komponen }} <br />
              {{ $data->kode_sub_komponen }} <br />
              Politeknik Statistika STIS <br />
              524111
            </td>
          </tr>

          <!-- Tambahkan baris lain jika diperlukan -->
          <!-- ... -->
          <tr>
            <td>10.</td>
            <td>Keterangan lain-lain</td>
            <td colspan="2">-</td>
          </tr>
        </tbody>
      </table>

      <!-- ... -->

      <div class="footer" style="text-align: center; padding-left: 300px">
        <p>Dikeluarkan di Jakarta</p>
        <p>Pada tanggal: {{ \Carbon\Carbon::parse($data->tanggal_ttd)->translatedFormat('d F Y') }}</p>

        <p>Pejabat Pembuat Komitmen,</p>
        <br /><br /><br />
        <p>{{ $data->ppk }}</p>
      </div>

      <!-- Tabel Pejabat Pembuat Komitmen dan lainnya dengan border -->
      <table >
        <tbody>
          <tr>
            <td colspan="4"></td>
            <td colspan="2">
              Berangkat dari &nbsp;&nbsp;: Jakarta <br />
              Ke
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
              {{ $data->lokasi }}
              <br />
              Pada tanggal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ \Carbon\Carbon::parse($data->tanggal_perdin_mulai)->translatedFormat('d F Y') }}
              <br />
              <p style="text-align: center">{{ $data->jabatan_pejabat_ttd }}</p>
              <br /><br /><br />
              <p style="text-align: center">{{ $data->nama_pejabat_ttd }}</p>
            </td>
          </tr>

          <tr>
            <td colspan="4">
              II. Tiba di
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
              <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="half-space">Pada tanggal</span>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
            </td>
            <td colspan="2">
              Berangkat dari &nbsp;&nbsp;&nbsp;&nbsp;:  <br />
              Ke
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
              <br />
              Pada tanggal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 
            </td>
          </tr>

          <tr>
            <td colspan="4">
              III. Tiba di
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
              <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pada tanggal
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
            </td>
            <td colspan="2">
              Berangkat dari &nbsp;&nbsp;&nbsp;&nbsp;:  <br />
              Ke
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
              
              <br />
              Pada tanggal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 
              <br />
              <br /><br />
            </td>
          </tr>

          <tr>
            <td colspan="4">
              IV. Tiba kembali di &nbsp;&nbsp;: Jakarta <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pada tanggal
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
              {{ \Carbon\Carbon::parse($data->tanggal_perdin_selesai)->translatedFormat('d F Y') }}
              <br />
              <p style="text-align: center">{{ $data->jabatan_pejabat_ttd }}</p>
              <br /><br /><br />
              <p style="text-align: center">{{ $data->nama_pejabat_ttd }}</p>
            </td>
            <td colspan="2">
              Telah diperiksa dengan keterangan bahwa perjalanan tersebut atas perintahnya semata-mata kepentingan jabatan dalam waktu yang sesingkat-singkatnya.
              <p style="text-align: center">Pejabat Pembuat Komitmen</p><br><br><br>
              <p style="text-align: center">{{ $data->ppk }}</p>
            </td>
          </tr>
          <tr>
            <td colspan="6">VI. Catatan lain-lain</td>
          </tr>
          <tr>
            <td colspan="6">
              PERHATIAN: Pejabat yang berwenang menerbitkan SPPD pegawai yang
              melakukan perjalanan dinas para pejabat yang mengesahkan tanggal
              berangkat/tiba serta bendaharawan bertanggung jawab berdasarkan
              peraturan-peraturan keuangan Negara apabila Negara menderita rugi
              akibat kesalahan, kelalaian dan kealpaannya.
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </body>
</html>