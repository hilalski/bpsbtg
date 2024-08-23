<x-dashboard.layouts.layouts :menu="$menu">
    <x-slot name="css">
    </x-slot>

    <x-slot name="js_head">
    </x-slot>

    <section class="section admin-siagau">
        <div class="row">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-1"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center fw-bold fs-3">
                            Daftar Pegawai
                        </h3>

                        <div class="d-flex justify-content-end mb-3">
                            <a
                                href={{ route('operator.pegawai.add') }}
                                class="btn btn-primary me-2 btn-info btn-sm bg-primary text-light fw-bold border-0"
                                >
                                + Tambah Pegawai
                            </a>
                        </div>

                        <table
                            class="table table-hover display responsive nowrap table-striped font-body-table"
                            style="width: 100%"
                            id="table-bau"
                        >
                            <thead class="header-table">
                                <tr>
                                    <th class="text-center col-2">Nama</th>
                                    <th class="text-center col-1">NIP</th>
                                    <th class="text-center col-1">Username</th>
                                    <th class="text-center col-1">Role</th>
                                    <th class="text-center col-1">Aksi</th>
                                   
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td class="align-middle fw-bold">{{ $user->name }}</td>
                                    <td class="align-middle">{{ $user->nip }}</td>
                                    <td class="align-middle">{{ $user->username }}</td>
                                    <td class="align-middle fw-bold">
                                        {{ $user->roles->pluck('name')->implode(', ') }}
                                    </td>
                                    <td class="text-center w-auto align-middle">
                                        <a href="{{ route('operator.pegawai.edit', $user->id) }}" style="display: inline-block;">
                                            <button type="button" class="btn btn-info m-1">Edit</button>
                                        </a>
                                        <form action="{{ route('operator.pegawai.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin untuk menghapus user tersebut?');" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger m-1">Hapus</button>
                                        </form>
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