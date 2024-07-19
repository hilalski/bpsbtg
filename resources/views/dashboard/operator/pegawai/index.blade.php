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
                        <h3 class="card-title text-center fw-bold fs-3">
                            Daftar Pegawai
                        </h3>

                        {{-- <div class="d-flex justify-content-end mb-3">
                            <a
                                href={{ route('operator.pegawai.add') }}
                                class="btn btn-primary me-2 btn-info btn-sm rounded-pill bg-success text-light fw-bold border-0"
                                >
                                + Tambah Pegawai
                            </a>
                        </div> --}}

                        <table
                            class="table table-hover display responsive nowrap table-striped font-body-table"
                            style="width: 100%"
                            id="table-bau"
                        >
                            <thead class="header-table">
                                <tr>
                                    <th class="text-center col-2">Nama</th>
                                    <th class="text-center col-1">NIP</th>
                                    <th class="text-center col-1">Email</th>
                                    <th class="text-center col-1">Kontak</th>
                                   
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td class="align-middle fw-bold">{{ $user->name }}</td>
                                    <td class="text-center align-middle">{{ $user->nip }}</td>
                                    <td class="align-middle">{{ $user->email }}</td>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center justify-content-center gap-2">
                                            <button class="btn btn-success">
                                                <a class="text-decoration-none text-light fw-semibold d-flex align-items-center justify-content-center gap-1"
                                                href="https://wa.me/{{ $user->phone_number }}" target="_blank">
                                                    <i class="bi bi-whatsapp"></i>
                                                    <span id="text-action-table-bau fw-bold">Hubungi</span>
                                                </a>
                                            </button>
                                        </div>
                                    </td>
                                    {{-- <td class="align-middle">
                                        <div class="d-flex align-items-center justify-content-center gap-2">
                                            <button class="btn btn-info">
                                                <a class="text-decoration-none text-light fw-semibold d-flex align-items-center justify-content-center gap-1">
                                                    <i class="bi bi-pencil-square"></i>
                                                    <span id="text-action-table-bau fw-bold">Edit Role</span>
                                                </a>
                                            </button>
                                            <button class="btn btn-danger">
                                                <a class="text-decoration-none text-light fw-semibold d-flex align-items-center justify-content-center gap-1">
                                                    <i class="bi bi-trash-fill"></i>
                                                    <span id="text-action-table-bau fw-bold">Hapus</span>
                                                </a>
                                            </button>
                                        </div>
                                    </td> --}}
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