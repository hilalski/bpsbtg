
<x-dashboard.layouts.layouts :menu="$menu">
<!-- Catatan:
     Tulisan yang ditandai dengan '/*' pada saat baris dijalankan php nantinya diisi sesuai pada backend
     Dibuat demikian agar dapat terbuka jika rute dimuat dan tidak error
-->

    <x-slot name="css">
    </x-slot>

    <x-slot name="js_head">
    </x-slot>

    <!-- Perizinan Detil -->
    <x-card.card judul='Detail Perizinan' desc='Berisi detail perizinan yang Anda ajukan'>
        <div class="container-fluid px-5 py-3">
            <table class="table table-striped table-bordered table-responsive nowrap" id="tabel_izin_detail">
                <tr>
                    <th>Nama Rapat</th>
                    <td>{{ $izin->rapat->nama_rapat }}</td>
                </tr>
                <tr>
                    <th>Agenda</th>
                    <td>{{ $izin->rapat->agenda }}</td>
                </tr>
                <tr>
                    <th>Tanggal Rapat</th>
                    <td>{{ $izin->rapat->tanggal_rapat }}</td>
                </tr>
                <tr>
                    <th>Jenis Izin</th>
                    <td>{{ $izin->jenis_izin }}</td>
                </tr>
                <tr>
                    <th>Durasi Keterlambatan <small>(Menit)</small></th>
                    <td>{{ $izin->durasi_keterlambatan ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Alasan Singkat</th>
                    <td>{{ $izin->alasan }}</td>
                </tr>
                <!-- Logika untuk menampilkan file jika bukan dosen -->
                @if(!auth()->user()->inGroup('dosen'))
                <tr>
                    <th>Lampiran File</th>
                    <td>
                        <a class="btn btn-primary" href="{{ url('/surat_izin/' . $izin->file_perizinan) }}" target="_blank">File</a>
                    </td>
                </tr>
                @endif
                <tr>
                    <th>Status</th>
                    <td>{{ $izin->status }}</td>
                </tr>
            </table>
            <a href="{{ url('sikoko/perizinan') }}" class="btn btn-primary rounded" style="margin-bottom: 30px;" >Kembali</a>
        </div>
    </x-card.card>

</x-dashboard.layouts.layouts>
