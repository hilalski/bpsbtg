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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                                    <div class="col-lg-9 col-md-8">{{ $detailPersetujuanSuratTugas->name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">NIP</div>
                                    <div class="col-lg-9 col-md-8">{{ $detailPersetujuanSuratTugas->nip }}</div>
                                </div>

                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label">Nama Kegiatan</div>
                                  <div class="col-lg-9 col-md-8">{{ $detailPersetujuanSuratTugas->nama_kegiatan }}</div>
                                </div>

                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label">Tanggal Kegiatan</div>
                                  <div class="col-lg-9 col-md-8">{{ $detailPersetujuanSuratTugas->tanggal_perdin_mulai }} s.d {{ $detailPersetujuanSuratTugas->tanggal_perdin_selesai }}</div>
                                </div>

                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label">Penandatangan</div>
                                  <div class="col-lg-9 col-md-8">{{ $detailPersetujuanSuratTugas->jabatan_pejabat_ttd }}</div>
                                </div>

                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label">Lokasi</div>
                                  <div class="col-lg-9 col-md-8">{{ $detailPersetujuanSuratTugas->lokasi }}</div>
                                </div>
                            </div>

                            <div class="finish row">
                              <div class="col-md-3">
                                  <div class="download">
                                      <button type="button" class="btn btn-success" onclick="updateStatus('setujui')">Setujui</button>
                                  </div>
                              </div>
                              <div class="col-md-3">
                                  <div class="view">
                                      <button type="button" class="btn btn-danger" onclick="updateStatus('tolak')">Tolak</button>
                                  </div>
                              </div>
                            </div>

                            <script>
                              function updateStatus(action) {
                                  let id = {{ $detailPersetujuanSuratTugas->id }};
                                  let url = '';
                          
                                  if (action === 'setujui') {
                                      url = "{{ route('setujuiAction', ['id' => ':id']) }}".replace(':id', id);
                                  } else if (action === 'tolak') {
                                      url = "{{ route('tolakAction', ['id' => ':id']) }}".replace(':id', id);
                                  }
                          
                                  $.ajax({
                                      url: url,
                                      method: 'GET',
                                      success: function(response) {
                                          // Tampilkan Sweet Alert setelah berhasil
                                          let alertMessage = (action === 'setujui') ? 'Pengajuan Surat Tugas Telah Disetujui' : 'Pengajuan Surat Tugas Telah Ditolak';
                          
                                          Swal.fire({
                                              title: 'Berhasil',
                                              text: alertMessage,
                                              icon: 'success',
                                              confirmButtonColor: '#3085d6',
                                              confirmButtonText: 'OK',
                                          }).then((result) => {
                                              // Redirect ke halaman 'persetujuansurtug.index' jika tombol OK ditekan
                                              if (result.isConfirmed) {
                                                  window.location.href = "{{ route('persetujuansurtug.index') }}";
                                              }
                                          });
                                      },
                                      error: function(error) {
                                          // Tampilkan Sweet Alert jika terjadi kesalahan
                                          Swal.fire({
                                              title: 'Error',
                                              text: 'Terjadi kesalahan',
                                              icon: 'error',
                                          });
                                          console.log(error);
                                      }
                                  });
                              }
                          </script>

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

        </div>
    </section>

      <x-slot name="js_body">
    </x-slot>
</x-dashboard.layouts.layouts>