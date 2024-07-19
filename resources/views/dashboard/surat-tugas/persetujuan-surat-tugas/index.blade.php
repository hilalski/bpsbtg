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
                <h5 class="card-title">Surat Tugas</h5>
                <p>Surat Tugas yang diajukan pegawai<a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">

                <!-- Table with stripped rows -->
                <table class="table table-hover display responsive nowrap table-striped font-body-table" style="width: 100%" id="table-bau">
                  <thead class="header-table">
                    <tr>
                      <th scope="col" class="text-center align-middle">No</th>
                      <th scope="col" class="text-center align-middle">Pemohon</th>
                      <th scope="col" class="text-center align-middle">Nama Kegiatan</th>
                      <th scope="col" class="text-center align-middle">Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($persetujuanSuratTugas as $persetujuan) 
                        <tr>
                          <th scope="row" class="text-center align-middle">{{ $loop->iteration }}</th>
                          <td>{{ $persetujuan->name }}</td>
                          <td>{{ $persetujuan->nama_kegiatan }}</td>
                          <td class="text-center align-middle">
                            <a href="{{ route('detailpersetujuansurtug.detail', ['id' => $persetujuan->id]) }}">
                              <button type="button" class="btn btn-primary">Detail</button>
                            </a>
                            <a href="{{ url('storage/' . str_replace('public/', '', $persetujuan->file_path)) }}" target="_blank">
                              <button type="button" class="btn btn-success">Lampiran</button>
                            </a>
                          </td>
                        </tr>
                      @endforeach

                    </tr>

                  </tbody>
                </table>
                <!-- End Table with stripped rows -->
              </div>
            </div>

          </div>
        </div>
    </section>

    <x-slot name="js_body">

    </x-slot>
</x-dashboard.layouts.layouts>
