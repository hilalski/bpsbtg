<x-dashboard.layouts.layouts :menu="$menu">
    <x-slot name="css">
    </x-slot>
    <x-slot name="js_head">
    </x-slot>

    <style>
      .table-container {
        overflow-x: auto;
      }
      .readonly-field {
        background-color: #e9e9e9; 
    }
    </style>

    <section class="section dashboard">
        <div class="row">
          <!-- Left side columns -->
          <div class="col-lg-10">
            <div class="row">
              <!-- Reports -->
              <div class="col-12">
                <section class="section profile">
                  <div class="row">
                    <div class="col-xl-4">
                      <div class="card">
                        <div
                          class="card-body profile-card pt-4 d-flex flex-column align-items-center"
                        >
                          <img
                            src="{{ asset('/assets/img/loc.png') }}"
                            alt="Surat"
                            class="ri-rounded-corner"
                          />
                          <h6>Detail Status Pegawai</h6>
                        </div>
                      </div>
                    </div>

                    <div class="col-xl-8">
                      <div class="card">
                        <div class="card-body pt-3">
                          <!-- Bordered Tabs -->
                          <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                              <button
                                class="nav-link active"
                                data-bs-toggle="tab"
                                data-bs-target="#profile-overview"
                              >
                                Overview Status Pegawai
                              </button>
                            </li>
                          </ul>

                          <div class="tab-content pt-2">
                            <div
                              class="tab-pane fade show active profile-overview"
                              id="profile-overview"
                            >
                              <h5 class="card-title">Silakan Perbarui Informasi Status Anda</h5>

                              <div class="row">
                                <div class="col-lg-3 col-md-4 label">Hari, Tanggal</div>
                                <div class="col-lg-9 col-md-8">{{ \Carbon\Carbon::parse($izins->tanggal)->isoFormat('dddd, D MMMM YYYY') }}</div>
                              </div>

                              <div class="row">
                                <div class="col-lg-3 col-md-4 label">
                                  Keperluan
                                </div>
                                <div class="col-lg-9 col-md-8">
                                    <span class="badge
                                    @if($izins->keperluan == 'Di Kantor') bg-success 
                                    @elseif($izins->keperluan == 'Dinas') bg-primary 
                                    @elseif($izins->keperluan == 'Istirahat') bg-danger 
                                    @else bg-warning 
                                    @endif">
                                    {{ $izins->keperluan }}
                                </span>
                                </div>
                              </div>
                              
                              <div class="row">
                                <div class="col-lg-3 col-md-4 label">Keterangan</div>
                                <div class="col-lg-9 col-md-8">{{ $izins->keterangan }}</div>
                              </div>

                              <div class="row">
                                <div class="col-lg-3 col-md-4 label">Jam Keluar</div>
                                <div class="col-lg-9 col-md-8">{{ $izins->jam_keluar }}</div>
                              </div>
                              @if ($izins->jam_kembali === null)
                                <form method="POST" action="{{ route('update-status.riwayat.edit', $izins->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Jam Kembali</div>
                                        <div class="col-lg-9 col-md-8">
                                            <input 
                                                type="text" 
                                                name="jam_kembali" 
                                                id="jam_kembali" 
                                                class="form-control font-form readonly-field" 
                                                style="font-size: 16px;"
                                                pattern="\d{2}:\d{2}:\d{2}" 
                                                required
                                                readonly
                                            />
                                        </div>

                                        <input
                                            type="hidden"
                                            id="durasi"
                                            class="form-control"
                                            value=""
                                            readonly
                                            name="durasi"
                                        />

                                        <input
                                            type="hidden"
                                            id="status"
                                            class="form-control"
                                            value="Di Kantor"
                                            readonly
                                            name="status"
                                        />

                                    </div>
                                    <div class="d-flex justify-content-center py-3">
                                        <div class="col-4 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary float-right">Submit</button>
                                        </div>
                                    </div>
                                </form>

                                <script>
                                  document.addEventListener('DOMContentLoaded', function() {
                                      var now = new Date();
                                      var hours = String(now.getHours()).padStart(2, '0');
                                      var minutes = String(now.getMinutes()).padStart(2, '0');
                                      var seconds = String(now.getSeconds()).padStart(2, '0');
                                      var currentTime = hours + ':' + minutes + ':' + seconds;
                                      document.getElementById('jam_kembali').value = currentTime;
                              
                                      var jamKeluar = "{{ $izins->jam_keluar }}"; // Ambil nilai jam_keluar dari database
                                      if (jamKeluar) {
                                          var jamKembali = currentTime;
                              
                                          var [keluarHours, keluarMinutes, keluarSeconds] = jamKeluar.split(':').map(Number);
                                          var [kembaliHours, kembaliMinutes, kembaliSeconds] = jamKembali.split(':').map(Number);
                              
                                          var keluarTotalSeconds = keluarHours * 3600 + keluarMinutes * 60 + keluarSeconds;
                                          var kembaliTotalSeconds = kembaliHours * 3600 + kembaliMinutes * 60 + kembaliSeconds;
                              
                                          var durationSeconds = kembaliTotalSeconds - keluarTotalSeconds;
                                          var durationHours = Math.floor(durationSeconds / 3600);
                                          var durationRemainderMinutes = Math.floor((durationSeconds % 3600) / 60);
                                          var durationRemainderSeconds = durationSeconds % 60;
                              
                                          var durationFormatted = String(durationHours).padStart(2, '0') + ':' + String(durationRemainderMinutes).padStart(2, '0') + ':' + String(durationRemainderSeconds).padStart(2, '0');
                                          document.getElementById('durasi').value = durationFormatted;
                                      }
                                  });
                              </script>
                            @else
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Jam Kembali</div>
                                    <div class="col-lg-9 col-md-8">{{ $izins->jam_kembali }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Durasi</div>
                                    <div class="col-lg-9 col-md-8">
                                      @php
                                      if(!empty($izins->durasi)) {
                                          $parts=explode(':', $izins->durasi);
                                          $hours=isset($parts[0]) ? (int)$parts[0] : 0;
                                          $minutes=isset($parts[1]) ? (int)$parts[1] : 0;
                                          $seconds=isset($parts[2]) ? (int)$parts[2] : 0;
                                      } else {
                                          $hours=$minutes=$seconds=0;
                                      }
                                      @endphp
                                      {{$hours}} jam, {{$minutes}} menit, dan {{$seconds}} detik
                                    </div>
                                </div>
                            @endif
                            <div
                              class="tab-pane fade profile-edit pt-3"
                              id="profile-edit"
                            >
                              <!-- Timeline -->
                            </div>
                          </div>
                          <!-- End Bordered Tabs -->
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
              </div>
              <!-- End Reports -->
            </div>
          </div>
          <!-- End Left side columns -->

      </section>

      <x-slot name="js_body">
    </x-slot>
</x-dashboard.layouts.layouts>