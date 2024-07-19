<x-dashboard.layouts.layouts :menu="$menu">
    <x-slot name="css">
    </x-slot>

    <x-slot name="js_head">
    </x-slot>

    <section class="section info-spj bg-white">
      <div class="container">
          <div class="row">
            <div class="col-12">
              @if (session()->has('success'))
              <div class="alert alert-success col-lg-12 mt-4" role="alert">
                {{ session('success') }}
              </div>
              @endif

              @if (session()->has('successimport'))
              <div class="alert alert-success col-lg-12 mt-4" role="alert">
                {{ session('successimport') }}
              </div>
              @endif
              <h2 class="py-5 text-center">Surat Pertanggungjawaban</h2>
              <p>Berikut disajikan data-data SPJ yang diajukan.</p>
    
              <table id="table-bau" class="table table-hover display responsive nowrap table-striped font-body-table" style="width: 100%" id="table-bau">
                  <thead class="header-table">
                      <tr>
                        <th class="text-center align-middle">No.</th>
                        <th class="text-center align-middle">Jenis SPJ</th>
                        <th class="text-center align-middle">Tanggal Pengajuan</th>
                        <th class="text-center align-middle">Status</th>
                        <th class="text-center align-middle">Aksi</th>
                        <th class="text-center align-middle">Pengaju</th>
                      </tr>
                  </thead>
                  <tbody>
                    @php
                        $startNumber = 1;
                        App::setLocale('id');
                    @endphp
                    @foreach ($spj as $item)
                    <tr>
                      <td scope="row">{{ $startNumber++ }}</td>
                      <td>{{ $item->jenis_spj }}</td>
                      <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('D MMMM Y', 'Do MMMM YYYY') }}</td>
                      <td class="text-center align-middle">
                        <span class="badge 
                            @if($item->status == 'Selesai') bg-success 
                            @elseif($item->status == 'Ditolak') bg-danger 
                            @else bg-warning 
                            @endif">
                            {{ $item->status }}
                        </span>
                      </td>
                      <td class="text-center align-middle">
                        <a href="{{ route('info-pengajuan-spj.show', $item->id) }}">
                           <button type="button" class="btn btn-primary">Lihat</button>
                         </a>                    
                      </td>
                      <td>{{ $item->user->name }}</td>
                    </tr>
                    @endforeach
                    
                    @foreach ($spjTr as $item)
                    <tr>
                      <td scope="row">{{ $startNumber++ }}</td>
                      <td>{{ $item->jenis_spj }}</td>
                      <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('D MMMM Y', 'Do MMMM YYYY') }}</td>
                      <td class="text-center align-middle">
                        <span class="badge 
                            @if($item->status == 'Selesai') bg-success 
                            @elseif($item->status == 'Ditolak') bg-danger 
                            @else bg-warning 
                            @endif">
                            {{ $item->status }}
                        </span>
                      </td>
                      <td class="text-center align-middle">
                        <a href="{{ route('info-pengajuan-spjtr.show', $item->id) }}">
                           <button type="button" class="btn btn-primary">Lihat</button>
                         </a>                    
                      </td>
                      <td>{{ $item->user->name }}</td>
                    </tr>
                    @endforeach   

                    @foreach ($spjPd as $item)
                    <tr>
                      <td scope="row">{{ $startNumber++ }}</td>
                      <td>{{ $item->jenis_spj }}</td>
                      <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('D MMMM Y', 'Do MMMM YYYY') }}</td>
                      <td class="text-center align-middle">
                        <span class="badge 
                            @if($item->status == 'Selesai') bg-success 
                            @elseif($item->status == 'Ditolak') bg-danger 
                            @else bg-warning 
                            @endif">
                            {{ $item->status }}
                        </span>
                      </td>
                      <td class="text-center align-middle">
                        <a href="{{ route('info-pengajuan-spjpd.show', $item->id) }}">
                           <button type="button" class="btn btn-primary">Lihat</button>
                         </a>                    
                      </td>
                      <td>{{ $item->user->name }}</td>
                    </tr>
                    @endforeach   
                  </tbody>
              </table>
            </div>
          </div>
        </div>
  </section>

      <x-slot name="js_body">
    </x-slot>
</x-dashboard.layouts.layouts>