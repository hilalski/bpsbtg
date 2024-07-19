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
        border: none;
        border-radius: 8px;
      }

      .surat-pernyataan {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        border: none;
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

      .table-no-border th,
      .table-no-border td {
        border: none;
        padding: 8px;
        text-align: left;
      }

      .footer {
        text-align: center;
        margin-top: 20px;
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
        margin-bottom: 0;
        padding-bottom: 0;
      }

      .footer {
        text-align: right;
        margin: 20px 50px;
        margin-bottom: 0;
        padding-bottom: 0;
      }

        .lampiran {
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .centered-text {
            text-align: center;
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

      </div>
      <div class="content">
        <p>Lampiran Surat Tugas</p>
        <p>Nomor: {{ $data->no_surtug }}</p>
        <p>Tanggal: {{ $data->tanggal_ttd->translatedFormat('d F Y') }}</p>
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

    <div class="surat-perjalanan">
      <!-- Tabel Nomor dan Lembar tanpa border -->
      <table class="table-no-border">
        <tbody>
          <tr>
            <td>Politeknik Statistika STIS</td>
            <td>Nomor &nbsp;&nbsp;&nbsp;: {{ $data->no_surtug }}</td>
          </tr>
          <tr>
            <td>Jl. Otto Iskandardinata no. 64C</td>
            <td>Lembar &nbsp;&nbsp;: 1</td>
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
            <td>
              I.&nbsp;Berangkat dari&nbsp;: Jakarta <br />
              &nbsp;&nbsp;&nbsp;(Tempat kedudukan) <br />
              &nbsp;&nbsp;&nbsp;Ke&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
              {{ $data->lokasi }} <br />
              &nbsp;&nbsp;&nbsp;Pada tanggal&nbsp;&nbsp;&nbsp;&nbsp;: {{ \Carbon\Carbon::parse($data->tanggal_perdin_mulai)->translatedFormat('d F Y') }} <br/><br><br>
              <p style="text-align: center">{{  \Carbon\Carbon::parse($data->tanggal_perdin_selesai)->translatedFormat('d F Y')  }}<br/></p>
              <br />
              <br />
              <br />
              <br />
              <p style="text-align: center">{{ $data->nama_pejabat_ttd }}</p>
            </td>
            <td>
              Tiba di&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
              {{ $data->lokasi }}<br />
              Pada tanggal&nbsp;&nbsp;: {{ \Carbon\Carbon::parse($data->tanggal_perdin_mulai)->translatedFormat('d F Y') }} s.d {{ \Carbon\Carbon::parse($data->tanggal_perdin_selesai)->translatedFormat('d F Y') }}<br />
              <br />
              <br />
              <br />
              <br />
              <p style="text-align: center"><br /></p>
              <br />
              <br />
              <br />
              <br />
              <br />
            </td>
          </tr>
          <tr>
            <td colspan="2">VI. Catatan lain-lain</td>
          </tr>
          <tr>
            <td colspan="2" style="text-align: justify">
              PERHATIAN : Pejabat yang berwenang menerbitkan SPPD pegawai yang
              melakukan perjalanan dinas para pejabat yang mengesahkan tanggal
              berangkat/tiba serta bendaharawan bertanggung jawab berdasarkan
              peraturan-peraturan keuangan Negara apabila Negara menderita rugi
              akibat kesalahan, kelalaian dan kealpaannya.
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
    <br /><br /><br /><br />
    <br /><br /><br /><br />
    <br /><br /><br /><br />
    <div class="surat-pernyataan">
      <h2>SURAT PERNYATAAN</h2>

      <div class="lampiran">
        <p>
          Yang bertanda tangan di bawah ini &nbsp; : <br />
          &nbsp;
          nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
          {{ $data->name }} <br />
          &nbsp;
          NIP&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
          {{ $data->nip }} <br />
          &nbsp; pangkat/golongan &nbsp;: {{ $data->golongan}} <br />
          &nbsp;
          jabatan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
          {{ $data->jabatan }} <br />
          &nbsp; satuan
          kerja&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
          Politeknik Statistika STIS <br />
        </p>

        <p>
          menerangkan bahwa dalam rangka perjalanan dinas: <br />
          &nbsp;
          kegiatan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
          {{ $data->nama_kegiatan }} <br />
          &nbsp;
          lokasi&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
          {{ $data->lokasi }} <br />
        </p>

        <p>saya benar-benar tidak menggunakan kendaraan dinas.</p>
        <p style="text-align: justify">
          Demikian pernyataan ini dibuat dengan sebenar-benarnya untuk
          dipergunakan sebagaimana mestinya. Apabila terdapat kekeliruan dalam
          pertanggungjawaban SPD dan mengakibatkan kerugian negara, kami
          bersedia dituntut sesuai peraturan yang berlaku dan megembalikan biaya
          penggantian transport yang sudah terlanjur diterima ke kas negara.
        </p>

        <div class="footer" style="text-align: left; padding-left:300px">
          <p>
            Jakarta, {{ \Carbon\Carbon::parse($data->tanggal_perdin_selesai)->translatedFormat('d F Y') }}<br />
            Pelaksana Perjalanan Dinas dalam Kota
          </p>

          <div class="centered-text">
            <p><br><br><br><br><br>
              {{ $data->name }}<br /><hr>
              {{ $data->nip }}<br />
            </p>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
