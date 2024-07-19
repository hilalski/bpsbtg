<x-dashboard.layouts.layouts :menu="$menu">
    <x-slot name="css">
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
                                    <th class="text-center col-1">Unit Kerja</th>
                                    <th class="text-center col-1">Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td class="align-middle fw-bold">{{ $user->name }}</td>
                                    <td class="align-middle fw-bold">{{ $user->unit }}</td>
                                    <td class="align-middle fw-bold">
                                        <span class="badge
                                            @if($user->status == 'Di Kantor') bg-success 
                                            @elseif($user->status == 'Dinas') bg-primary 
                                            @elseif($user->status == 'Istirahat') bg-danger 
                                            @else bg-warning 
                                            @endif">
                                            {{ $user->status }}
                                        </span>
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