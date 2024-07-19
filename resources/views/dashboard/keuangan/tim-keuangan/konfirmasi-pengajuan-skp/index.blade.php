<x-dashboard.layouts.layouts :menu="$menu">
    <x-slot name="css">
    </x-slot>

    <x-slot name="js_head">
    </x-slot>
    
    <div class="container-xxl flex-grow-1 container-p-y mt-3 mb-3">
      <div class="row">
        <!-- Total Requests -->
        <div class="col-xl-3 col-md-3 col-6 mb-4">
          <div class="card">
            <div class="card-body pd-2">
              <div class="icon mt-2">
                <span class="badge bg-primary p-2 rounded-circle">
                  <i class="bi bi-clipboard-data text-white size-16" style="font-size: 2rem; padding-top:1rem;"></i>
                </span>                  
              </div>
              <h5 class="card-title mb-1 pt-2 mt-1">Total Pengajuan SKP</h5>
              <p class="mb-2 mt-1 fw-bolder pd-2">10</p>
            </div>
          </div>
        </div>

        <!-- Total Done -->
        <div class="col-xl-3 col-md-3 col-6 mb-4">
          <div class="card">
            <div class="card-body pd-2">
              <div class="icon mt-2">
                <span class="badge bg-success p-2 rounded-circle">
                  <i class="bi bi-clipboard-check text-white size-16" style="font-size: 2rem; padding-top:1rem;"></i>
                </span>                  
              </div>
              <h5 class="card-title mb-1 pt-2 mt-1">Pengajuan SKP Selesai</h5>
              <p class="mb-2 mt-1 fw-bolder pd-2">4</p>
            </div>
          </div>
        </div>

        <!-- Total Proccess -->
        <div class="col-xl-3 col-md-3 col-6 mb-4">
          <div class="card">
            <div class="card-body pd-2">
              <div class="icon mt-2">
                <span class="badge bg-secondary p-2 rounded-circle">
                  <i class="bi bi-clipboard text-white size-16" style="font-size: 2rem; padding-top:1rem;"></i>
                </span>                  
              </div>
              <h5 class="card-title mb-1 pt-2 mt-1">Pengajuan SKP Diproses</h5>
              <p class="mb-2 mt-1 fw-bolder pd-2">3</p>
            </div>
          </div>
        </div>

        <!-- Total Reject -->
        <div class="col-xl-3 col-md-3 col-6 mb-4">
          <div class="card">
            <div class="card-body pd-2">
              <div class="icon mt-2">
                <span class="badge bg-danger p-2 rounded-circle">
                  <i class="bi bi-clipboard-x text-white size-16" style="font-size: 2rem; padding-top:1rem;"></i>
                </span>                  
              </div>
              <h5 class="card-title mb-1 pt-2 mt-1">Pengajuan SKP Ditolak</h5>
              <p class="mb-2 mt-1 fw-bolder pd-2">3</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <section class="section konfirmasi-spj bg-white">
        <div class="container">
            <div class="row">
              <div class="col-12">
                <h2 class="py-5 text-center">Surat Keterangan Penghasilan</h2>
                <p>Berikut disajikan data-data SKP yang diajukan.</p>
      
                <table id="table-bau" class="table table-striped display responsive nowrap" style="width:100%">
                    <thead>
                        {{-- <tr>
                            <th class="text-center col-1">No</th>
                            <th class="text-center col-4">Pengaju</th>
                            <th class="text-center col-2">Tanggal Pengajuan</th>
                            <th class="text-center col-2">Status</th>
                            <th class="text-center col-2">Aksi</th>
                            <th class="text-center col-2">Bulan Dasar</th>
                        </tr> --}}
                        <tr>
                          <th class="text-center col-1">No.</th>
                          <th class="text-center col-4">Pengaju</th>
                          <th class="text-center col-3">Tanggal Pengajuan</th>
                          <th class="text-center col-2">Status</th>
                          <th class="text-center col-2">Aksi</th>
                          <th class="text-center col-2">Bulan Dasar</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($users as $user)
                        <tr>
                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                            <td class="text-center align-middle">{{ $user->name }}</td>
                            <td class="text-center align-middle">Nama Pengadaan {{ $loop->iteration }}</td>
                            <td class="text-center align-middle">21-09-2021</td>
                            <td>
                                <div class="d-flex align-items-center justify-content-center gap-2">
                                  <button class="btn btn-success" th:data-id="${mahasiswa.id}">
                                    <a class="text-decoration-none text-light fw-semibold" href="
                                      <i class="fa-solid fa-eye"></i>
                                      <span>Lihat</span>
                                    </a>
                                  </button>
                                </div>
                            </td>
                            <td class="text-center align-middle">
                                <span class="text-primary">Status</span>
                            </td>
                        </tr>
                        @endforeach --}}
                        <tr>
                          <td scope="row">1</td>
                          <td>Joko Widodo</td>
                          <td>26-10-2023</td>
                          <td><span class="badge bg-warning">Diproses</span></td>
                          <td>
                            <a href="{{ route('konfirmasipengajuanskp.detail') }}"><button type="button" class="btn btn-primary">Lihat</button></a>
                          </td>
                          <td>Januari 2023</td>
                        </tr>
                        <tr>
                          <td scope="row">2</td>
                          <td>Joko Widodo</td>
                          <td>26-10-2023</td>
                          <td><span class="badge bg-success">Selesai</span></td>
                          <td>
                            <a href="{{ route('konfirmasipengajuanskp.detail') }}"><button type="button" class="btn btn-primary">Lihat</button></a>
                          </td>
                          <td>Februari 2023</td>
                        </tr>
                        <tr>
                          <td scope="row">3</td>
                          <td>Joko Widodo Kokojo</td>
                          <td>26-10-2023</td>
                          <td><span class="badge bg-danger">Ditolak</span></td>
                          <td>
                            <a href="{{ route('konfirmasipengajuanskp.detail') }}"><button type="button" class="btn btn-primary">Lihat</button></a>
                          </td>
                          <td>Maret 2023</td>
                        </tr>
                    </tbody>
                </table>
              </div>
            </div>
          </div>
    </section>

    <x-slot name="js_body">
    </x-slot>
</x-dashboard.layouts.layouts>