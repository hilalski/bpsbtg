<x-dashboard.layouts.layouts :menu="$menu">
    <x-slot name="css">

    </x-slot>

    <x-slot name="js_head">

    </x-slot>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            Pengajuan Masuk Surat Tugas
                        </h5>
                        <p>
                            Berikut disajikan data-data pengajuan surat
                            tugas yang diajukan oleh pegawai Polstat
                            STIS.
                        </p>

                        <!-- Table with stripped rows -->
                        <table class="table table-hover display responsive nowrap table-striped font-body-table" style="width: 100%" id="table-bau">
                            <thead class="header-table">
                                <tr>
                                    <th scope="col" class="text-center align-middle">No.</th>
                                    <th scope="col" class="text-center align-middle">Nama Pengaju</th>
                                    <th scope="col" class="text-center align-middle">Nama Kegiatan</th>
                                    <th scope="col" class="text-center align-middle">Aksi</th>
                                    <th scope="col" class="text-center align-middle">Keterangan</th>
                                    <th scope="col" class="text-center align-middle">File</th>
                                    <th scope="col" class="text-center align-middle">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pengecekanSuratTugas as $pengecekan)
                                    <tr>
                                        <th scope="row" class="text-center align-middle">{{ $loop->iteration }}</th>
                                        <td>{{ $pengecekan->name }}</td>
                                        <td>{{ $pengecekan->nama_kegiatan }}</td>
                                        <td class="text-center align-middle">
                                            <a href="{{ route('pengecekansurtug.cek', ['id' => $pengecekan->id]) }}">
                                                <button type="button" class="btn btn-primary">Lengkapi Surat</button>
                                            </a>
                                        </td>
                                        <td class="text-center align-middle">
                                            @if($pengecekan->keterangan == 'Sudah dilengkapi')
                                                <div class="badge bg-success text-wrap" style="width: 6rem;">Sudah dilengkapi</div>
                                            @else
                                                <div class="badge bg-danger text-wrap" style="width: 6rem;">Belum dilengkapi</div>
                                            @endif
                                        </td>

                                         <!-- HTML untuk tombol Download -->
                                         <td class="text-center align-middle">
                                            @if($pengecekan->keterangan == 'Sudah dilengkapi')
                                                <a href="{{ route('surtug.download', ['id' => $pengecekan->id]) }}" target="_blank" onclick="handleDownload()"> <!-- Menggunakan onclick untuk menambahkan handleDownload() -->
                                                    <button type="button" class="btn btn-primary">Download</button>
                                                </a>
                                            @else
                                                <button type="button" class="btn btn-secondary" disabled>Download</button>
                                            @endif
                                        </td>

                                        <!-- HTML untuk tombol Selesai -->
                                        <td class="text-center align-middle">
                                            @if($pengecekan->kode_track == 4)
                                                <a href="{{ route('pengecekansurtug.index', ['id' => $pengecekan->id]) }}">
                                                    <button type="button" class="btn btn-success" onclick="updateStatus('selesai', {{ $pengecekan->id }})">Selesai</button>
                                                </a>
                                            @else
                                                <button type="button" class="btn btn-secondary" disabled>Selesai</button>
                                            @endif
                                        </td>

                                        <!-- JavaScript untuk mengaktifkan tombol "Selesai" setelah tombol "Download" ditekan -->
                                        <script>
                                            function handleDownload() {
                                                // Memperbarui halaman setelah 3 detik (contoh waktu yang bisa disesuaikan)
                                                setTimeout(function() {
                                                    // Mengubah status tombol "Selesai" menjadi aktif
                                                    // document.getElementById('selesaiButton').removeAttribute('disabled');

                                                    // Refresh halaman atau melakukan aksi lain jika diperlukan
                                                    window.location.reload(); // Contoh: Refresh halaman
                                                }, 1000); // Atur sesuai dengan kebutuhan waktu yang diperlukan untuk download
                                            }
                                        </script>

                                    </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-slot name="js_body">
        <script>
            function updateStatus(action, id) {
                let url = '';
    
                if (action === 'selesai') {
                    url = "{{ route('surtug.selesai', ['id' => ':id']) }}".replace(':id', id);
                }
                
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(response) {
                        // Handle response or redirect if needed
                        window.location.href = "{{ route('pengecekansurtug.index') }}"; // Gantilah 'nama_rute_index' dengan nama rute yang sesuai
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }

        </script>
    </x-slot>
</x-dashboard.layouts.layouts>