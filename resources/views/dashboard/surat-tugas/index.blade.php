<x-dashboard.layouts.layouts :menu="$menu">
    <x-slot name="css">

    </x-slot>

    <x-slot name="js_head">

    </x-slot>

        <section class="section">

          <div class="row">
            <div class="col">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Jumlah Surat Tugas Berdasarkan Status</h4>
                  {!! $suratTugasChart->container() !!}
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Surat Tugas</h5>
                  <p>Berikut disajikan data-data surat tugas yang diajukan.</p>

                  <!-- Table with stripped rows -->
                  <table class="table table-hover display responsive nowrap table-striped font-body-table" style="width: 100%" id="table-bau">
                    <thead class="header-table">
                      <tr>
                        <th scope="col" class="text-center align-middle">No.</th>
                        <th scope="col" class="text-center align-middle">Nama Kegiatan</th>
                        <th scope="col" class="text-center align-middle">Keterangan</th>
                        <!-- <th scope="col">Age</th>
                        <th scope="col">Start Date</th> -->
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($pengajuanSuratTugas as $pengajuan)
                        <tr>
                          <th scope="row" class="text-center align-middle">{{ $loop->iteration }}</th>
                          <td>{{ $pengajuan->nama_kegiatan }}</td>
                          <td class="text-center align-middle">
                            <a href="{{ route('detailpengajuansurtug.detail', ['id' => $pengajuan->id]) }}">
                              <button type="button" class="btn btn-info">Lihat Detail</button>
                            </a>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <!-- End Table with stripped rows -->
                </div>
              </div>
            </div>
          </div>

          <script src="{{ $suratTugasChart->cdn() }}"></script>

          {{ $suratTugasChart->script() }}

        </section>
    <x-slot name="js_body">
      
    </x-slot>
</x-dashboard.layouts.layouts>