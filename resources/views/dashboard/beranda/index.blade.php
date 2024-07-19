<x-dashboard.layouts.layouts :menu="$menu">
    <x-slot name="css">
    </x-slot>

    <x-slot name="js_head">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </x-slot>

    <section class="section dashboard">
        <x-card.card>
            <div class="p-3 greetings d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-person-circle"></i>
                </div>
                {{-- Nama dan quotes--}}
                <div class="ps-3">
                    <div class="card-title p-0">
                        @if(auth()->user()->userDosen)
                            <h4><strong> Halo, {{ Auth::user()->userDosen->nama }} </strong></h4>
                        @elseif(auth()->user()->userMahasiswa)
                            <h4><strong> Halo, {{ Auth::user()->userMahasiswa->nama }} </strong></h4>
                        @endif
                    </div>
                    <span>Harmoni dalam Tradisi, Bersinergi dengan Inovasi, Berbakti untuk Negeri</span>
                </div>
            </div>
        </x-card.card>

        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-8">
              <div class="row">

                <div class="col-lg-12">
                    <!-- Pengumuman Terbaru -->
                    <x-card.card judul='Pengumuman Terbaru'>
                        <div class="container-fluid p-3">
                            <span>Cek pengumuman terbaru di sini!</span>
{{--                            <p class="text-justify">Satu aja pengumuman terbaru?</p>--}}
                        </div>

                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('assets/img/dashboard/pengumuman.png') }}" alt="Pengumuman Image" class="img-fluid" style="max-width: 400px">
                        </div>
                    </x-card.card>
                    <!-- End Pengumuman Terbaru -->
                </div>
              </div>
            </div>
            <!-- End Left Side -->

            <!-- Right side columns -->
            <div class="col-lg-4">
                <!-- Rapat Terdekat -->
                <x-card.card judul='Rapat Terdekat'>
                    @if($rapatTerdekat)
                        <div class="container-fluid p-3">
                            <h5>{{ $rapatTerdekat->nama_rapat }}</h5>
                            <div class="detail">
                                <i class="bi bi-calendar"></i>
                                <span>{{ $rapatTerdekat->waktu_mulai->translatedFormat('l, d F Y') }}</span>
                            </div>
                            <div class="detail">
                                <i class="bi bi-clock"></i>
                                <span>{{ $rapatTerdekat->waktu_mulai->format('H:i') }} - {{ $rapatTerdekat->waktu_selesai->format('H:i') }} WIB</span>
                            </div>
                            <div class="detail">
                                <i class="bi bi-geo-alt"></i>
                                <span>{{ $rapatTerdekat->tempat->nama_tempat ?? 'Lokasi belum ditentukan' }}</span>
                            </div>
                        </div>
                    @else
                        <div class="container-fluid p-3">
                            <span>Tidak ada rapat terdekat yang terjadwal.</span>
                        </div>
                    @endif
                </x-card.card>
                <!-- End Rapat Terdekat -->

                <!-- Tingkat Kehadiran -->
                <x-card.card judul='Kehadiran'>
                    <div class=" container-fluid p-3">
                        <div class="chart-container d-flex justify-content-center">
                            <canvas id="percentageDoughnutChart"></canvas>
                        </div>
                    </div>
                </x-card.card>
                <!-- End Tingkat Kehadiran -->
            </div>
            <!-- End Right side columns -->
      </div>
    </section>

    <x-slot name="js_body">
        <script>
            // Data presensi dari Laravel
            const dataPresensi = @json($dataPresensi);
    
            const ctx = document.getElementById('percentageDoughnutChart').getContext('2d');
            const myDoughnutChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Hadir', 'Tidak Hadir'],
                    datasets: [{
                        label: 'Kehadiran',
                        data: dataPresensi, // Gunakan data presensi di sini
                        backgroundColor: ['rgb(1,31,75)', 'rgb(202,33,40)', 'rgb(251,228,126)'],
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true
                    // Sisa konfigurasi
                }
            });
        </script>
    </x-slot>    
</x-dashboard.layouts.layouts>
