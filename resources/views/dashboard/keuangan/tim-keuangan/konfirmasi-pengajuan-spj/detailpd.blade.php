<x-dashboard.layouts.layouts :menu="$menu">
    <x-slot name="css">
    </x-slot>

    <x-slot name="js_head">
    </x-slot>

    <style>
      .table-container {
        overflow-x: auto;
      }
    </style>

    <section class="section dashboard">
        <div class="row">
          @if (session()->has('success'))
          <div class="alert alert-success col-lg-8 mt-4" role="alert">
            {{ session('success') }}
          </div>
          @endif
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
                                Overview Surat Pertanggung Jawaban
                              </button>
                            </li>
                          </ul>

                          <div class="tab-content pt-2">
                            <div
                              class="tab-pane fade show active profile-overview"
                              id="profile-overview"
                            >
                              <h5 class="card-title">Informasi Surat Pertanggung Jawaban</h5>

                              <div class="row">
                                <div class="col-lg-3 col-md-4 label">
                                  Status SPJ
                                </div>
                                <div class="col-lg-9 col-md-8">
                                  <span class="badge 
                                      @if($spj->status == 'Selesai') bg-success 
                                      @elseif($spj->status == 'Ditolak') bg-danger 
                                      @else bg-warning 
                                      @endif">
                                      {{ $spj->status }}
                                  </span>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-lg-3 col-md-4 label">Nama Pengaju</div>
                                <div class="col-lg-9 col-md-8">{{ $spj->user->name }}</div>
                              </div>

                              <div class="row">
                                <div class="col-lg-3 col-md-4 label">Perjalanan Dinas</div>
                                <div class="col-lg-9 col-md-8">{{ $spj->judul }}</div>
                              </div>

                              <div class="row">
                                <div class="col-lg-3 col-md-4 label">Nama Kegiatan</div>
                                <div class="col-lg-9 col-md-8">{{ $spj->kegiatan }}</div>
                              </div>

                              <div class="row">
                                <div class="col-lg-3 col-md-4 label">KRO</div>
                                <div class="col-lg-9 col-md-8">{{ $spj->kro }}</div>
                              </div>

                              <div class="row">
                                <div class="col-lg-3 col-md-4 label">Komponen</div>
                                <div class="col-lg-9 col-md-8">{{ $spj->komponen }}</div>
                              </div>

                              <div class="row">
                                <div class="col-lg-3 col-md-4 label">Akun</div>
                                <div class="col-lg-9 col-md-8">{{ $spj->akun }}</div>
                              </div>

                              <div class="row">
                                <div class="col-lg-3 col-md-4 label">
                                  Tanggal Tugas
                                </div>
                                <div class="col-lg-9 col-md-8">
                                  {{ \Carbon\Carbon::parse($spj->tanggal_tugas)->isoFormat('D MMMM Y') }}
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-lg-3 col-md-4 label">
                                  Jenis SPJ
                                </div>
                                <div class="col-lg-9 col-md-8">
                                  {{ $spj->jenis_spj }}
                                </div>
                              </div>

                              {{-- Detail lengkap --}}

                              @if (!$tabelspj->isEmpty())
                              <div class="row">
                                <div class="col-lg-3 col-md-4 label">
                                  Total Jumlah Biaya
                                </div>
                                <div class="col-lg-9 col-md-8">
                                  <p>Rp. {{ number_format($spj->total_jumlah_biaya, 2, ',', '.') }}
                                  </p>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-lg-3 col-md-4 label">
                                  Total Uang Muka
                                </div>
                                <div class="col-lg-9 col-md-8">
                                  <p>Rp. {{ number_format($spj->total_uang_muka, 2, ',', '.') }}
                                  </p>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-lg-3 col-md-4 label">
                                  Total Kekurangan
                                </div>
                                <div class="col-lg-9 col-md-8">
                                  <p>Rp. {{ number_format($spj->total_kekurangan, 2, ',', '.') }}
                                  </p>
                                </div>
                              </div>
                              @endif

                              @if ($spj->status === 'Selesai') 
                              <div class="row">
                                <div class="col-lg-3 col-md-4 label">
                                  Tanggal Pencairan Dana
                                </div>
                                <div class="col-lg-9 col-md-8">
                                  {{ \Carbon\Carbon::parse($spj->tanggal_transfer)->isoFormat('D MMMM Y') }}
                                </div>
                              </div>
                              @endif
                              
                              @if ($spj->status === 'Ditolak') 
                              <div class="row">
                                <div class="col-lg-3 col-md-4 label" style="color: rgb(184, 48, 48);">
                                  Pesan Penolakan
                                </div>
                                <div class="col-lg-9 col-md-8" style="color: rgb(184, 48, 48); font-weight: bold;">
                                  {{ $spj->keterangan }}
                                </div>
                              </div>
                              @endif

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
                  <div class="activity-item d-flex">
                    <div class="activite-label">Tahap 1</div>
                    <i
                      class="bi bi-circle-fill activity-badge text-warning align-self-start"
                    ></i>
                    <div class="activity-content">
                      <strong>Persetujuan</strong>
                      @if($spj->status === 'Menunggu Persetujuan')
                          <p>Silakan lakukan tindakan persetujuan</p>
                      @else
                          <p>Anda telah melakukan tindakan persetujuan</p>
                      @endif

                      <button type="button" class="btn btn-success m-1" @if($spj->status !== 'Menunggu Persetujuan') disabled @endif data-bs-toggle="modal" data-bs-target="#setujuispj">
                        Setujui
                      </button>

                      {{-- Modal Setujui --}}
                      <div class="modal fade" id="setujuispj" tabindex="-1">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Setujui Pengajuan</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              Apakah Anda yakin untuk menyetujui pengajuan ini?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                              <form method="post" action="{{ url('/dashboard/tim-keuangan/konfirmasi-spjpd/setujui-spj/' . $spj->id) }}">
                                @csrf
                                <input
                                type="hidden"
                                class="form-control"
                                value="Menunggu Pencairan Dana"
                                readonly
                                name="status"
                              />
                              <button type="submit" class="btn btn-success m-1">
                                Setujui Pengajuan
                              </button>
                            </form>
                            </div>
                          </div>
                        </div>
                      </div>

                    <button type="button" class="btn btn-danger m-1" data-bs-toggle="modal" data-bs-target="#basicModaltolakspj"  @if($spj->status !== 'Menunggu Persetujuan') disabled @endif>Tolak</button>
                      <div class="row">
                      </div>
                    </div>
                  </div>
                  <!-- End activity item-->

                  <div class="activity-item d-flex" id="tahap2">
                    <div class="activite-label">Tahap 2</div>
                    <i
                      class="bi bi-circle-fill activity-badge text-warning align-self-start"
                    ></i>
                    <div class="activity-content">
                      <strong>Pencairan Dana</strong>
                      @if($spj->status === 'Menunggu Pencairan Dana' || $spj->status === 'Menunggu Persetujuan')
                          <p>Silakan lakukan konfirmasi pencairan dana</p>
                      @elseif($spj->status === 'Ditolak')
                        <p>Anda telah melakukan penolakan</p>
                      @else
                          <p>Anda telah melakukan konfirmasi pencairan dana</p>
                      @endif
                      <form method="post" action="{{ url('/dashboard/tim-keuangan/konfirmasi-spjpd/transfer-spj/' . $spj->id) }}">
                        @csrf
                        <input
                            type="hidden"
                            class="form-control"
                            value="Selesai"
                            readonly
                            name="status"
                        />
                        <input
                            type="date"
                            class="form-control"
                            name="tanggal_transfer"
                            required
                            @if($spj->status === 'Selesai') value="{{ $spj->tanggal_transfer }}" @endif
                        />
                        <button type="submit" class="btn btn-success m-1 mt-2" @if($spj->status !== 'Menunggu Pencairan Dana') disabled @endif>
                            Konfirmasi
                        </button>
                    </form>
                    
                    </div>
                  </div>
                  <!-- End activity item-->

                  <div class="activity-item d-flex" id="tahap3">
                    <div class="activite-label">Tahap 3</div>
                    <i
                      class="bi bi-circle-fill activity-badge text-success align-self-start"
                    ></i>
                    <div class="activity-content">
                      <strong>SPJ Telah Selesai</strong>
                      <p>Proses pengajuan SPJ telah selsai</p>
                      <div class="finish">
                        <div class="download">
                          <a href="{{ url('/dashboard/tim-keuangan/konfirmasi-spjpd/download-spj-pdf/' . $spj->id) }}" target="_blank" onclick=" @if($spj->status !== 'Selesai') return false; @endif"><button type="button" class="btn btn-primary @if($spj->status !== 'Selesai') disabled @endif">Cetak</button></a>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>

                {{-- Modal Tolak SPJ --}}
                <div class="modal fade" id="basicModaltolakspj" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Tolak dan Kirim Pesan Penolakan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form method="post" action="{{ url('/dashboard/tim-keuangan/konfirmasi-spjpd/tolak-spj/' . $spj->id) }}">
                          @csrf
                          <div class="col-sm-100">
                            <textarea name="keterangan" class="form-control" style="height: 100px" placeholder="Tulis pesan penolakan ..."></textarea>
                          </div>
                          <input
                          type="hidden"
                          class="form-control"
                          value="Ditolak"
                          readonly
                          name="status"
                        /> 
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-danger m-1">Tolak dan Kirim Pesan</button>
                      </div>
                    </form>
                    </div>
                  </div>
                </div>

            </div>
            <!-- End Recent Activity -->
          </div>
          <!-- End Right side columns -->
        </div>
    </section>

    <section>
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <!-- Table with stripped rows -->
              @if(!$tabelspj->isEmpty())
              <div class="table-container">
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th scope="col">No.</th>
                      <th scope="col">Nama Pelaksana Perjalanan Dinas</th>
                      <th scope="col">Golongan</th>
                      <th scope="col">Asal Penugasan</th>
                      <th scope="col">Daerah Tujuan Perjalanan Dinas</th>
                      <th scope="col">Lama Perjalanan(O-H)</th>
                      <th scope="col">Uang Harian(Rp)</th>
                      <th scope="col">Transport(PP)(Rp)</th>
                      <th scope="col">Bandara(PP)(Rp)</th>
                      <th scope="col">Biaya Hotel(RP)</th>
                      <th scope="col">Jumlah Biaya(RP)</th>
                      <th scope="col">Uang Muka(Rp)</th>
                      <th scope="col">Kekurangan(Rp)</th>
                      <th scope="col">Nama Bank</th>
                      <th scope="col">Nomor Rekening</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $counter = 1;
                    @endphp
                    @foreach ($tabelspj as $item)
                      <tr>
                        <td>{{ $counter++ }}.</td>
                        <td>{{ isset($item->nama_pelaksanaan_perjalanan_dinas) ? $item->nama_pelaksanaan_perjalanan_dinas : '' }}</td>
                        <td>{{ isset($item->gol) ? $item->gol : '' }}</td>
                        <td>{{ isset($item->asal_penugasan) ? $item->asal_penugasan : '' }}</td>
                        <td>{{ isset($item->daerah_tujuan_perjalanan_dinas) ? $item->daerah_tujuan_perjalanan_dinas : '' }}</td>
                        <td>{{ isset($item->lama_perjalanan) ? $item->lama_perjalanan : '' }}</td>
                        <td>{{ isset($item->uang_harian) ? $item->uang_harian : '' }}</td>
                        <td>{{ isset($item->transport) ? $item->transport : '' }}</td>
                        <td>{{ isset($item->bandara) ? $item->bandara : '' }}</td>
                        <td>{{ isset($item->biaya_hotel) ? $item->biaya_hotel : '' }}</td>
                        <td>{{ isset($item->jumlah_biaya) ? $item->jumlah_biaya : '' }}</td>
                        <td>{{ isset($item->uang_muka) ? $item->uang_muka : '' }}</td>
                        <td>{{ isset($item->kekurangan) ? $item->kekurangan : '' }}</td>
                        <td>{{ isset($item->nama_bank) ? $item->nama_bank : '' }}</td>
                        <td>{{ isset($item->nomor_rekening) ? $item->nomor_rekening : '' }}</td>
                      </tr>
                    @endforeach
                  </tbody>                
                </table>
              </div>
              @else
              <div class="alert alert-danger col-lg-12 m-2 mt-3" role="alert">
                Pegawai Belum Mengunggah Dokumen Excel.
              </div>
              @endif
              <!-- End Table with stripped rows -->
            </div>
          </div>
        </div>
      </div>
    </section>

    <x-slot name="js_body">
    </x-slot>    
</x-dashboard.layouts.layouts>