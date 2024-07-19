<x-dashboard.layouts.layouts :menu="$menu">
    <x-slot name="css">
    </x-slot>

    <x-slot name="js_head">
    </x-slot>

    <section class="section pengajuan">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center fw-bold fs-3">
                            Daftar Pengajuan
                        </h3>
                        <table
                            class="table table-hover display responsive nowrap table-striped font-body-table"
                            style="width: 100%"
                            id="table-bau"
                        >
                            <thead class="header-table">
                                <tr>
                                    <th scope="col" class="text-center align-middle">
                                        No
                                    </th>

                                    <th scope="col" class="text-center align-middle">
                                        Nama
                                    </th>


                                    <th scope="col" class="text-center align-middle">
                                        Nama Paket Pengadaan
                                    </th>
                                    <th scope="col" class="text-center align-middle">
                                        Tanggal Pengadaan
                                    </th>
                                    <th scope="col" class="text-center align-middle">
                                        Status Pengajuan
                                    </th>
                                    <th
                                        scope="col"
                                        class="text-center align-middle"
                                    ></th>
                                </tr>
                            </thead>

                            <tbody>
                                @php $displayCounter = 0; @endphp
                                @foreach($listPengajuan as $pengajuan)
                                    @if($pengajuan->status !== 'Ditolak' && $pengajuan->status !== 'Revisi')
                                    @php $displayCounter++; @endphp
                                        <tr>
                                            <td class="text-center fw-bold align-middle">
                                                {{ $displayCounter }}
                                            </td>
                                            <td class="fw-bold align-middle text-wrap">
                                                {{ $pengajuan->user->name }}
                                            </td>

                                            <td class="text-wrap">
                                                {{ $pengajuan->nama_pengadaan }}
                                            </td>
                                            <td class="text-center align-middle">
                                                {{ $pengajuan->tanggal_pengadaan_formatted }}
                                            </td>
                                            <td class="text-center align-middle">
                                                <button class="btn-siagau-status-dashboard btn btn-warning rounded-pill fw-bold {{ $pengajuan->status_color }}">
                                                    {{ $pengajuan->status }}
                                                </button>
                                            </td>
                                            <td class="text-center align-middle">
                                                <a href={{ route('updatingstatusppk.details', ['id' => $pengajuan->id]) }}>
                                                    <button
                                                        type="button"
                                                        class="btn-siagau-dashboard btn btn-info rounded-pill fw-bold text-white"
                                                    >
                                                        Detail
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Table  -->

    <x-slot name="js_body">
    </x-slot>
</x-dashboard.layouts.layouts>
