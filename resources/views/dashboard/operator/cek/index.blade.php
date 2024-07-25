<x-dashboard.layouts.layouts :menu="$menu">
    <x-slot name="css">
        <style>
            .small-button {
                padding: 4px 8px; 
                font-size: 12px; 
            }

            .small-button a {
                font-size: 12px;
            }

            .small-button i {
                font-size: 14px; 
            }

        </style>
    </x-slot>

    <x-slot name="js_head">
    </x-slot>

    <section class="section admin-siagau">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-bold fs-3">
                            Status Pegawai
                        </h5>
                        <p>
                            Berikut disajikan data Status Keberadaan Pegawai BPS Kabupaten Batang
                        </p>
                        {!! $cekStatusChart->container() !!}

                        <table
                            class="table table-hover display responsive nowrap table-striped font-body-table"
                            style="width: 100%"
                            id="table-bau"
                        >
                            <thead class="header-table">
                                <tr>
                                    <th class="text-center col-1">Nama</th>
                                    <th class="text-center col-1">Status</th>
                                    <th class="text-center col-1">Kontak</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td class="align-middle fw-bold">{{ $user->name }}</td>
                                    <td class="align-middle  text-center fw-bold">
                                        <span class="badge
                                            @if($user->status == 'Di Kantor') bg-success 
                                            @elseif($user->status == 'Dinas') bg-primary 
                                            @elseif($user->status == 'Istirahat') bg-danger 
                                            @else bg-warning 
                                            @endif">
                                            {{ $user->status }}
                                        </span>
                                    </td>
                                    <td class="align-middle">
                                        
                                            <button class="btn btn-info small-button align-middle text-center">
                                                <a class="text-decoration-none text-light fw-semibold d-flex align-items-center justify-content-center gap-1"
                                                href="https://wa.me/{{ $user->phone_number }}" target="_blank">
                                                    <i class="bi bi-whatsapp"></i>
                                                    <span id="text-action-table-bau">Hubungi</span>
                                                </a>
                                            </button>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ $cekStatusChart->cdn() }}"></script>

        {{ $cekStatusChart->script() }}
    </section>

    <x-slot name="js_body">
    </x-slot>
</x-dashboard.layouts.layouts>