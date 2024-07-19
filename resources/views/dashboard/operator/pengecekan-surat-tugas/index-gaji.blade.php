<x-dashboard.layouts.layouts :menu="$menu">
    <x-slot name="css">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dashboard/main.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/form-bau.css') }}">
    </x-slot>

    <x-slot name="js_head">
      
    </x-slot>

    <section class="section">
        <div class="row">
          <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Daftar Gaji Pegawai</h5>

                <!-- Table with stripped rows -->
                <table class="table table-hover display responsive nowrap table-striped font-body-table" style="width: 100%" id="table-bau">
                  <thead class="header-table">
                    <tr>
                      <th scope="col" class="text-center align-middle">No</th>
                      <th scope="col" class="text-center align-middle">Nama</th>
                      <th scope="col" class="text-center align-middle">NIP</th>
                      <th scope="col" class="text-center align-middle">Gaji</th>
                      <th scope="col" class="text-center align-middle">Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($users as $user)
                        <tr>
                          <th scope="row" class="text-center align-middle">{{ $loop->iteration }}</th>
                          <td>{{ $user->name }}</td>
                          <td>{{ $user->nip }}</td>
                          <td>{{ $user->gaji }}</td>
                          <td class="text-center align-middle">
                            <a href="{{ route('updategaji.edit', ['id' => $user->id]) }}">
                                <button type="button" class="btn btn-primary">Edit Gaji</button>
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
