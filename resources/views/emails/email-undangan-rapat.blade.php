<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap');
        body{
        font-family: 'DM Sans', sans-serif;
        }
        table{
            width: 500px;
            margin-left: auto;
            margin-right: auto;
            border-collapse: collapse;
            border-radius: 15px;
            overflow: hidden;
        }
        tr{
            padding-top: 20px;
            padding-bottom: 20px;
        }
        .text-bold{
            font-weight: 700;
        }
        .judul{
            font-size: 25px;
            color: white;
        }
        td{
            padding: 25px;
        }
        p{
            margin-bottom: 0;
        }
      </style>
</head>
<body>
    <div style="background: #eeeeee; display: flex; justify-content: center;">
        <table>
            <!-- ... (header section remains the same) -->
            <tr style="background: #fff;">
                <td colspan="2">
                    <center>
                        {{-- Uncomment and replace with actual image source if needed --}}
                        {{-- <img src="{{ asset('path_to_logo') }}" alt="" width="100px;"> --}}
                        <h2>Undangan Rapat</h2>
                        <p>Sehubungan dengan akan diadakannya {{ $rapat->jenisRapat->nama_jenis_rapat }}, Anda di undang untuk menghadiri rapat tersebut yang akan dilaksanakan pada:</p>
                    </center>
                </td>
            </tr>
            <tr style="background: #dce0ea">
                <td class="text-bold" style="width:30%;">Hari/Tanggal</td>
                <td>{{ $rapat->waktu_mulai->format('l, d F Y') }}</td>
            </tr>
            <tr style="background: #fff">
                <td class="text-bold">Waktu</td>
                <td>{{ $rapat->waktu_mulai->format('H:i') }} WIB - {{ $rapat->waktu_selesai->format('H:i') }} WIB</td>
            </tr>
            <tr style="background: #dce0ea">
                <td class="text-bold">Tempat</td>
            @if(empty($rapat->detail_tempat) && $rapat->pelaksanaan == "Offline")
                {{ $rapat->pelaksanaan }} - {{ $rapat->tempat->nama_tempat }}
            @else
                {{ $rapat->pelaksanaan }} -
                @if ($rapat->pelaksanaan == "Online")
                    @switch($rapat->tempat->nama_tempat)
                        @case("Ruang Virtual 1")
                            @php $zoomUrl = "https://stis-ac-id.zoom.us/j/5456101047?pwd=RFJPQmptd3FLSXhEMFdHeE44ak5adz09"; @endphp
                            @break
                        @case("Ruang Virtual 2")
                            @php $zoomUrl = "https://stis-ac-id.zoom.us/j/9903263737?pwd=UFM4MnU4RzhvSEQrWmdwUUZoRWNmdz09"; @endphp
                            @break
                        @case("Ruang Virtual 3")
                            @php $zoomUrl = "https://stis-ac-id.zoom.us/j/5881160900?pwd=THBjYUlWSG1sTk1RTHZzTVYwelUwdz09"; @endphp
                            @break
                        @case("Ruang Virtual 4")
                            @php $zoomUrl = "https://stis-ac-id.zoom.us/j/4185812554?pwd=MW9UTEVKTHlxcW5hKzBEU1llUEp3Zz09"; @endphp
                            @break
                        @case("Ruang Virtual 5")
                            @php $zoomUrl = "https://stis-ac-id.zoom.us/j/4587533259?pwd=YmR3YThwVjAvU2FqOE8yRForZXVIQT09"; @endphp
                            @break
                        @default
                            @php $zoomUrl = ""; @endphp
                    @endswitch
                    <a href="{{ $zoomUrl }}" class="text-secondary zoom-meet">{{ $rapat->tempat->nama_tempat }}</a>
                @else
                    {{ $rapat->tempat->nama_tempat }}
                @endif
            @endif
            </tr>
            <tr style="background: #fff">
                <td class="text-bold">Agenda</td>
                <td>{{ $rapat->agenda }}</td>
            </tr>
            <tr style="background: #506396; color:white;">
                <td colspan="2"> <center> © 2023 SIKOKO PKL 63, All rights reserved</center></td>
            </tr>
        </table>
    </div>
</body>
</html>
