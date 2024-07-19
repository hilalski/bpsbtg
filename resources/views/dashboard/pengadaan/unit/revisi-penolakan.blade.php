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
                            Daftar Revisi Pengajuan
                        </h3>
                        <table
                            class="table table-hover display responsive nowrap table-striped font-body-table"
                            style="width: 100%"
                            id="table-bau-revisi"
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
                                        Alasan Penolakan
                                    </th>
                                    <th scope="col" class="text-center align-middle">
                                        Status Penolakan
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @php $displayCounter1 = 0; @endphp
                                @foreach($listPenolakan as $penolakan)
                                    @if($penolakan->pengadaan->status === 'Revisi')
                                    @php $displayCounter1++; @endphp
                                        <tr>
                                            <td class="text-center fw-bold align-middle">
                                                {{ $displayCounter1 }}
                                            </td>
                                            <td class="fw-bold align-middle text-wrap">
                                                {{ $penolakan->pengadaan->user->name }}
                                            </td>

                                            <td class="text-wrap">
                                                {{ $penolakan->pengadaan->nama_pengadaan }}
                                            </td>
                                            
                                            <td class="text-left align-middle text-wrap">
                                                {{ $penolakan->alasan_penolakan }}
                                            </td>
                                            <td class="text-center align-middle">
                                                <button
                                                class="btn-siagau-status-dashboard btn btn-warning rounded-pill fw-bold {{$penolakan->pengadaan->status_color}}">
                                                    {{ $penolakan->pengadaan->status }}
                                                </button>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center fw-bold fs-3">
                            Daftar Penolakan Pengajuan
                        </h3>
                        <table
                            class="table table-hover display responsive nowrap table-striped font-body-table"
                            style="width: 100%"
                            id="table-bau-penolakan"
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
                                        Alasan Penolakan
                                    </th>
                                    <th scope="col" class="text-center align-middle">
                                        Status Penolakan
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @php $displayCounter2 = 0; @endphp
                                @foreach($listPenolakan as $penolakan)
                                    @if($penolakan->pengadaan->status === 'Ditolak')
                                    @php $displayCounter2++; @endphp
                                        <tr>
                                            <td class="text-center fw-bold align-middle">
                                                {{ $displayCounter2 }}
                                            </td>
                                            <td class="fw-bold align-middle text-wrap">
                                                {{ $penolakan->pengadaan->user->name }}
                                            </td>

                                            <td class="text-wrap">
                                                {{ $penolakan->pengadaan->nama_pengadaan }}
                                            </td>
                                            
                                            <td class="text-left align-middle text-wrap">
                                                {{ $penolakan->alasan_penolakan }}
                                            </td>
                                            <td class="text-center align-middle">
                                                <button
                                                class="btn-siagau-status-dashboard btn btn-warning rounded-pill fw-bold {{$penolakan->pengadaan->status_color}}">
                                                    {{ $penolakan->pengadaan->status }}
                                                </button>
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
