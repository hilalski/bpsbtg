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
                              <h5 class="card-title">Informasi Riwayat Status Pegawai</h5>

                              <div class="row">
                                <div class="col-lg-3 col-md-4 label">Pegawai</div>
                                <div class="col-lg-9 col-md-8">{{ $izin->user->name }}</div>
                              </div>

                              <div class="row">
                                <div class="col-lg-3 col-md-4 label">Hari, Tanggal</div>
                                <div class="col-lg-9 col-md-8">{{ \Carbon\Carbon::parse($izin->tanggal)->isoFormat('dddd, D MMMM YYYY') }}</div>
                              </div>

                              <div class="row">
                                <div class="col-lg-3 col-md-4 label">
                                  Keperluan
                                </div>
                                <div class="col-lg-9 col-md-8">
                                    <span class="badge
                                    @if($izin->keperluan == 'Di Kantor') bg-success 
                                    @elseif($izin->keperluan == 'Dinas') bg-primary 
                                    @elseif($izin->keperluan == 'Istirahat') bg-danger 
                                    @else bg-warning 
                                    @endif">
                                    {{ $izin->keperluan }}
                                </span>
                                </div>
                              </div>
                              
                              <div class="row">
                                <div class="col-lg-3 col-md-4 label">Keterangan</div>
                                <div class="col-lg-9 col-md-8">{{ $izin->keterangan }}</div>
                              </div>

                              <div class="row">
                                <div class="col-lg-3 col-md-4 label">Jam Keluar</div>
                                <div class="col-lg-9 col-md-8">{{ $izin->jam_keluar }}</div>
                              </div>
                              
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Jam Kembali</div>
                                    <div class="col-lg-9 col-md-8">{{ $izin->jam_kembali }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Durasi</div>
                                    <div class="col-lg-9 col-md-8">
                                      @php
                                      if(!empty($izin->durasi)) {
                                          $parts=explode(':', $izin->durasi);
                                          $hours=isset($parts[0]) ? (int)$parts[0] : 0;
                                          $minutes=isset($parts[1]) ? (int)$parts[1] : 0;
                                          $seconds=isset($parts[2]) ? (int)$parts[2] : 0;
                                      } else {
                                          $hours=$minutes=$seconds=0;
                                      }
                                      @endphp

                                      @if ($izin->jam_kembali !== null)
                                        {{$hours}} jam {{$minutes}} menit
                                      @endif
                                    </div>
                                </div>
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