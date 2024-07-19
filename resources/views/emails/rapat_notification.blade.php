<!DOCTYPE html>
<html>
<head>
    <title>Notifikasi Rapat</title>
</head>
<body>
    <h1>{{ $rapat->nama_rapat }}</h1>
    <p>Tanggal: {{ $rapat->waktu_mulai->format('d M Y') }}</p>
    <p>Waktu: {{ $rapat->waktu_mulai->format('H:i') }} - {{ $rapat->waktu_selesai->format('H:i') }}</p>
    <p>Tempat: {{ $rapat->tempat->nama_tempat }}</p>
    <p>Agenda: {{ $rapat->agenda }}</p>
</body>
</html>
