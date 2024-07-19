<x-dashboard.layouts.layouts :menu="$menu">
    <x-slot name="css">
        <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/fixedheader/3.4.0/css/fixedHeader.bootstrap5.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
    </x-slot>

    <x-slot name="js_head">
        <script defer src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script defer src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
        <script defer src="https://cdn.datatables.net/fixedheader/3.4.0/js/dataTables.fixedHeader.min.js"></script>
        <script defer src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
        <script defer src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.js"></script>
        <script defer src="{{ asset('assets/js/dashboard/table.js') }}"></script>
    </x-slot>

    <section class="section dashboard">
        <div class="row">
          <!-- Left side columns -->
          <div class="col-lg-8">
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
                            src="{{ asset('/assets/img/surat.png') }}"
                            alt="Surat"
                            class="ri-rounded-corner"
                            />
                          <h6>Detail Pengajuan Surat</h6>
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
                                Overview Surat Tugas
                              </button>
                            </li>
                          </ul>

                          <div class="tab-content pt-2">
                            <div
                              class="tab-pane fade show active profile-overview"
                              id="profile-overview"
                            >
                              <h5 class="card-title">Informasi Surat Tugas</h5>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Nama</div>
                                    <div class="col-lg-9 col-md-8">{{ $detailSuratTugas->name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">NIP</div>
                                    <div class="col-lg-9 col-md-8">{{ $detailSuratTugas->nip }}</div>
                                </div>

                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label">Nama Kegiatan</div>
                                  <div class="col-lg-9 col-md-8">{{ $detailSuratTugas->nama_kegiatan }}</div>
                                </div>

                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label">Tanggal Kegiatan</div>
                                  <div class="col-lg-9 col-md-8">{{ $detailSuratTugas->tanggal_perdin_mulai }} s.d {{ $detailSuratTugas->tanggal_perdin_selesai }}</div>
                                </div>

                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label">Penandatangan</div>
                                  <div class="col-lg-9 col-md-8">{{ $detailSuratTugas->jabatan_pejabat_ttd }}</div>
                                </div>

                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label">Lokasi</div>
                                  <div class="col-lg-9 col-md-8">{{ $detailSuratTugas->lokasi }}</div>
                                </div>

                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label">Moda Transportasi</div>
                                  <div class="col-lg-9 col-md-8">{{ $detailSuratTugas->moda_transportasi }}</div>
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

          <!-- Right side columns -->
          <div class="col-lg-4">
            <!-- Recent Activity -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Perkembangan Proses Pengajuan</h5>

                    <div class="activity">
                        @if($detailSuratTugas->kode_track == 1)
                            <div class="activity-item d-flex">
                                <div class="activite-label">Tahap 1</div>
                                <i class="bi bi-circle-fill activity-badge text-success align-self-start"></i>
                                <div class="activity-content">Surat tugas berhasil diajukan</div>
                            </div>
                        @elseif($detailSuratTugas->kode_track == 2)
                            <div class="activity-item d-flex">
                                <div class="activite-label">Tahap 1</div>
                                <i class="bi bi-circle-fill activity-badge text-success align-self-start"></i>
                                <div class="activity-content">Surat tugas berhasil diajukan</div>
                            </div>
                            <!-- End activity item-->
                            <div class="activity-item d-flex">
                                <div class="activite-label">Tahap 2</div>
                                <i class="bi bi-circle-fill activity-badge text-danger align-self-start"></i>
                                <div class="activity-content">Surat tugas disetujui oleh pimpinan</div>
                            </div>
                        @elseif($detailSuratTugas->kode_track == 3)
                            <div class="activity">
                                <div class="activity-item d-flex">
                                <div class="activite-label">Tahap 1</div>
                                <i
                                    class="bi bi-circle-fill activity-badge text-success align-self-start"
                                ></i>
                                <div class="activity-content">Surat tugas berhasil diajukan</div>
                                </div>
                                <!-- End activity item-->

                                <div class="activity-item d-flex">
                                <div class="activite-label">Tahap 2</div>
                                <i
                                    class="bi bi-circle-fill activity-badge text-danger align-self-start"
                                ></i>
                                <div class="activity-content">
                                    Surat tugas disetujui oleh pimpinan
                                </div>
                                </div>
                                <!-- End activity item-->

                                <div class="activity-item d-flex">
                                <div class="activite-label">Tahap 3</div>
                                <i
                                    class="bi bi-circle-fill activity-badge text-primary align-self-start"
                                ></i>
                                <div class="activity-content">
                                    Surat tugas diproses oleh operator
                                </div>
                                </div>
                        @elseif($detailSuratTugas->kode_track == 4)
                            <div class="activity">
                                <div class="activity-item d-flex">
                                  <div class="activite-label">Tahap 1</div>
                                  <i
                                    class="bi bi-circle-fill activity-badge text-success align-self-start"
                                  ></i>
                                  <div class="activity-content">Surat tugas berhasil diajukan</div>
                                </div>
                                <!-- End activity item-->

                                <div class="activity-item d-flex">
                                  <div class="activite-label">Tahap 2</div>
                                  <i
                                    class="bi bi-circle-fill activity-badge text-danger align-self-start"
                                  ></i>
                                  <div class="activity-content">
                                    Surat tugas disetujui oleh pimpinan
                                  </div>
                                </div>
                                <!-- End activity item-->

                                <div class="activity-item d-flex">
                                  <div class="activite-label">Tahap 3</div>
                                  <i
                                    class="bi bi-circle-fill activity-badge text-primary align-self-start"
                                  ></i>
                                  <div class="activity-content">
                                    Surat tugas diproses oleh operator
                                  </div>
                                </div>
                                <!-- End activity item-->

                                <div class="activity-item d-flex">
                                  <div class="activite-label">Tahap 4</div>
                                  <i
                                    class="bi bi-circle-fill activity-badge text-warning align-self-start"
                                  ></i>
                                  <div class="activity-content">
                                    Surat tugas dalam proses penandatanganan
                                  </div>
                                </div>
                            </div>
                        @elseif($detailSuratTugas->kode_track == 5)
                            <div class="activity">
                                <div class="activity-item d-flex">
                                  <div class="activite-label">Tahap 1</div>
                                  <i
                                    class="bi bi-circle-fill activity-badge text-success align-self-start"
                                  ></i>
                                  <div class="activity-content">Surat tugas berhasil diajukan</div>
                                </div>
                                <!-- End activity item-->

                                <div class="activity-item d-flex">
                                  <div class="activite-label">Tahap 2</div>
                                  <i
                                    class="bi bi-circle-fill activity-badge text-danger align-self-start"
                                  ></i>
                                  <div class="activity-content">
                                    Surat tugas disetujui oleh pimpinan
                                  </div>
                                </div>
                                <!-- End activity item-->

                                <div class="activity-item d-flex">
                                  <div class="activite-label">Tahap 3</div>
                                  <i
                                    class="bi bi-circle-fill activity-badge text-primary align-self-start"
                                  ></i>
                                  <div class="activity-content">
                                    Surat tugas diproses oleh operator
                                  </div>
                                </div>
                                <!-- End activity item-->

                                <div class="activity-item d-flex">
                                  <div class="activite-label">Tahap 4</div>
                                  <i class="bi bi-circle-fill activity-badge text-warning align-self-start"></i>
                                  <div class="activity-content">
                                    Surat tugas dalam proses penandatanganan
                                  </div>
                                </div>

                                <div class="activity-item d-flex">
                                  <div class="activite-label">Tahap 5</div>
                                  <i class="bi bi-circle-fill activity-badge text-info align-self-start"></i>
                                  <div class="activity-content">
                                    Surat tugas sudah selesai, silakan ambil di BAU
                                  </div>
                                </div>
                            </div>
                        @else
                            <div class="activity">
                                <div class="activity-item d-flex">
                                  <i
                                    class="bi bi-circle-fill activity-badge text-danger align-self-start"
                                  ></i>
                                  <div class="activity-content">Surat tugas Anda ditolak</div>
                                </div>
                                <!-- End activity item-->
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- End Recent Activity -->
        </div>
        </div>
    </section>

      <x-slot name="js_body">
    </x-slot>
  </x-dashboard.layouts.layouts>
