<x-dashboard.layouts.layouts :menu="$menu">
    <x-slot name="css">
    </x-slot>

    <x-slot name="js_head">
    </x-slot>

    <section class="section admin-siagau">
        <div class="row">
            @if (session()->has('success'))
            {{-- <div class="alert alert-success col-lg-12 mt-4" role="alert">
                {{ session('success') }}
            </div> --}}
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-1"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-bold fs-3">
                            Riwayat Status
                        </h5>
                        <p>
                            Berikut data Riwayat Perubahan Status Untuk Semua Pegawai
                        </p>
                        <table
                            class="table table-hover display responsive nowrap table-striped font-body-table"
                            style="width: 100%"
                            id="table-bau"
                        >
                            <thead class="header-table">
                                <tr>
                                    <th class="text-center col-1">Hari, Tanggal</th>
                                    <th class="text-center col-1">Pegawai</th>
                                    <th class="text-center col-1">Keperluan</th>
                                    <th class="text-center col-1">Jam Keluar</th>
                                    <th class="text-center col-1">Jam Kembali</th>
                                    <th class="text-center col-1">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    App::setLocale('id');
                                @endphp
                                @foreach($izins as $izin)
                                    <tr>
                                        <td class="text-center w-auto">{{ \Carbon\Carbon::parse($izin->tanggal)->isoFormat('dddd, D MMMM YYYY') }}</td>
                                        <td class="text-center w-auto">{{ $izin->user->name }}</td>
                                        <td class="text-center w-auto">
                                            <span class="badge
                                                @if($izin->keperluan == 'Di Kantor') bg-success 
                                                @elseif($izin->keperluan == 'Dinas') bg-primary 
                                                @elseif($izin->keperluan == 'Istirahat') bg-danger 
                                                @else bg-warning 
                                                @endif">
                                                {{ $izin->keperluan }}
                                            </span>
                                        </td>
                                        <td class="text-center w-auto">{{ $izin->jam_keluar }}</td>
                                        <td class="text-center w-auto">{{ $izin->jam_kembali }}</td>
                                        <td class="text-center w-auto align-middle">
                                            <a href="{{ route('update-status.riwayat.show', $izin->id) }}">
                                                <button type="button" class="btn btn-success">Lihat</button>
                                            </a>             
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-slot name="js_body">
    </x-slot>
</x-dashboard.layouts.layouts>