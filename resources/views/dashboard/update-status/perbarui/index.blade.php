<x-dashboard.layouts.layouts :menu="$menu">
  <x-slot name="css">
  </x-slot>

  <x-slot name="js_head">
  </x-slot>
  
  <style>
    .readonly-field {
        background-color: #e9e9e9; 
    }
</style>

  <section class="section dashboard">
          <section class="section dashboard">
              <div class="row">
                <!-- Left side columns -->
                <div class="col-lg-12">
                  <div class="row">
                    <!-- Gaji Bulanan -->
                  <div class="col-xxl-6 col-md-6">
                    <div class="card info-card sales-card">
                      <div class="card-body">
                        <h5 class="card-title">
                          Status Saat Ini
                        </h5>

                        <!-- Tempatkan kode countdown di sini -->
                        <div class="d-flex align-items-center">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-pin-angle-fill"></i>
                          </div>
                          <div class="ps-3">
                            <h6 >{{ $users->status }}</h6>                          
                          </div>
                        </div>
                        <!-- Akhir dari kode countdown -->
                      </div>
                    </div>
                  </div>
                  <!-- End Gaji Bulanan -->
                  @if($users->status !== "Di Kantor")
                  <div class="col-xxl-6 col-md-6">
                    <div class="card info-card sales-card">
                      <div class="card-body">
                        <h5 class="card-title">
                          Jam Keluar
                        </h5>

                        <!-- Tempatkan kode countdown di sini -->
                        <div class="d-flex align-items-center">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-clock-fill"></i>
                          </div>
                          <div class="ps-3">
                            <h6>
                              {{ $izins->jam_keluar }}
                              <a href="/dashboard/update-status/riwayat-status"><button type="button" class="btn btn-primary ms-3">Edit Status</button></a>
                            </h6>                          
                          </div>
                        <!-- Akhir dari kode countdown -->
                      </div>
                      {{-- <div class="d-flex justify-content-center mt-3">
                      </div> --}}
                    </div>
                  </div>
                  @endif
                    <!-- Pengajuan Surat Tugas -->
                  </div>           
                  </div>
                </div>
                <!-- End Left side columns -->
        @if($users->status == "Di Kantor")
        <div class="row">
        <div class="col-lg-12">
            <div class="card">
            <div class="card-body">
                <h5 class="card-title">Lengkapi Data Berikut</h5>

                <!-- General Form Elements -->
                <form method="POST" action="{{ route('update-status.perbarui.create') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label"
                        >Nama</label
                        >
                        <div class="col-sm-10">
                        <input
                            name="name"
                            type="text"
                            class="form-control readonly-field"
                            value="{{ $users->name }}"
                            readonly
                            required
                        />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label"
                        >Unit</label
                        >
                        <div class="col-sm-10">
                        <input
                            name="unit"
                            type="text"
                            class="form-control readonly-field"
                            value="{{ $users->unit }}"
                            readonly
                            required
                        />
                        </div>
                    </div>

                    <div class="row mb-3">
                      <label for="inputText" class="col-sm-2 col-form-label">Tanggal</label>
                      <div class="col-sm-10">
                          <input 
                              type="date" 
                              name="tanggal" 
                              id="tanggal" 
                              class="form-control font-form" 
                              style="font-size: 16px;"
                              readonly
                              required />
                      </div>
                  </div>
                  
                  <script>
                      document.addEventListener('DOMContentLoaded', function() {
                          var today = new Date().toISOString().split('T')[0];
                          document.getElementById('tanggal').value = today;
                      });
                  </script>

                    <div class="row mb-3">
                      <label for="inputText" class="col-sm-2 col-form-label">Jam Keluar</label>
                      <div class="col-sm-10">
                          <input 
                              type="text" 
                              name="jam_keluar" 
                              id="jam_keluar" 
                              class="form-control font-form" 
                              style="font-size: 16px;" 
                              pattern="\d{2}:\d{2}:\d{2}" 
                              placeholder="HH:MM:SS"
                              required />
                      </div>
                    </div>

                    <script>
                      document.addEventListener('DOMContentLoaded', function() {
                          var now = new Date();
                          var hours = String(now.getHours()).padStart(2, '0');
                          var minutes = String(now.getMinutes()).padStart(2, '0');
                          var seconds = String(now.getSeconds()).padStart(2, '0');
                          var currentTime = hours + ':' + minutes + ':' + seconds;
                          document.getElementById('jam_keluar').value = currentTime;
                      });
                    </script>
                      
    
                      <div class="row mb-3">
                          <label class="col-sm-2 col-form-label">Keperluan</label>
                          <div class="col-sm-10">
                            <select
                            id="keperluan"
                            name="keperluan"
                            class="form-select"
                            aria-label="Default select example"
                            required
                        >
                            <option value="" disabled selected>Pilih keperluan</option>
                            <option value="Dinas">Dinas</option>
                            <option value="Non Dinas">Non Dinas</option>
                            <option value="Istirahat">Istirahat</option>
                        </select>
                          </div>
                      </div>

                      
    

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label"
                        >Keterangan</label
                        >
                        <div class="col-sm-10">
                          <textarea name="keterangan" class="form-control" style="height: 100px" placeholder="Tuliskan keterangan kegiatan..." required></textarea>
                        </div>
                    </div>

                    <input
                    type="hidden"
                    id="status"
                    class="form-control"
                    value=""
                    readonly
                    name="status"
                    />

                    <script>
                      document.addEventListener('DOMContentLoaded', function() {
                          var keperluanSelect = document.getElementById('keperluan');
                          var statusInput = document.getElementById('status');
                  
                          keperluanSelect.addEventListener('change', function() {
                              statusInput.value = keperluanSelect.value;
                          });
                      });
                  </script>

                    <div class="d-flex justify-content-center py-3">
                      <div class="col-4 d-flex justify-content-center">
                          <button type="submit" class="btn btn-primary float-right">Submit</button>
                      </div>
                  </div>
                </form>
                <!-- End General Form Elements -->

                
            </div>
        </div>
        </div>
        </div>
        @else
        <div class="alert alert-danger col-lg-12 m-2 mt-3" role="alert">
          Formulir akan muncul saat anda telah mengisi Jam Kembali pada perizinan saat ini.
        </div>
        @endif
              </div>
            </section>      
  </section>
{{-- @if(Session::has('success'))
                    <script>
                        swal('Berhasil', '{{ Session::get('success') }}', 'success', {
                            button: {
                                text: "OK",
                                value: true,
                                visible: true,
                                className: "btn-primary",
                                closeModal: true
                            },
                        }).then((value) => {
                            // Redirect ke halaman 'infopengajuansurtug.index' jika tombol OK ditekan
                            if (value) {
                                window.location.href = '{{ route('update-status.riwayat.index') }}';
                            }
                        });
                    </script>
                @endif --}}
                {{-- <section>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="card">
                        <div class="card-body">
                          <!-- Table with stripped rows -->
                          @if(!$tabelspj->isEmpty())
                          <div class="alert alert-danger col-lg-12 m-2 mt-3" role="alert">
                            Anda Belum Mengunggah Dokumen Excel, Silakan Unggah Excel.
                          </div>
                        @endif
                          <!-- End Table with stripped rows -->
                        </div>
                      </div>
                    </div>
                  </div>
                </section> --}}
  <x-slot name="js_body">
  </x-slot>
</x-dashboard.layouts.layouts>