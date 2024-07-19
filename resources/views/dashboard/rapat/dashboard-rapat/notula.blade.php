<x-dashboard.layouts.layouts :menu="$menu">
    <x-slot name="css">
        <style>
            #simpletable thead th, #simpletable2 thead th, #simpletable3 thead th {
                background-color: #666;
                color: white;
            }

            /*TODO: pindahin ke stylesheet*/

            .detail {
                display: flex;
                align-items: center;
                border-radius: 5px;
                margin-bottom: 10px;
            }

            .detail i {
                font-size: 1em;
                margin-right: 10px;
            }

            .detail span {
                flex: 1;
                font-size: 1rem;
                color: #555;
                padding-left: 1em;
            }


            .input-kode button {
                border-top-left-radius: 0;
                border-bottom-left-radius: 0;
            }

            .input-kode button:hover {
                /*TODO: button hover warna apa?*/
                background-color: #113883;
            }

            .rapat-emoji {
                font-size: 6em;
                color: #113883;
            }

            #simpletable th, #simpletable td {
            text-align: center;
            }

        </style>
    </x-slot>

    <x-slot name="js_head">
    </x-slot>
    @if (session('alert'))
        <div class="alert alert-warning">
            {{ session('alert') }}
        </div>
    @endif
    <section class="section dashboard">
        <div class="row">
            {{-- Detail Rapat--}}
            <div class="col-12">
                <div class="card overflow-auto p-3">
                    <div class="card-body">
                        <div class="card-title py-1">
                            <h4> <strong> {{ $rapat->nama_rapat }}  </strong> </h4>
                        </div>
                        <div class="detail">
                            <i class="bi bi-calendar"></i>
                            <span>{{ \Carbon\Carbon::parse($rapat->waktu_mulai)->translatedFormat('l, d F Y', 'id') }}</span>
                        </div>
                        <div class="detail">
                            <i class="bi bi-clock"></i>
                            <span>{{ \Carbon\Carbon::parse($rapat->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($rapat->waktu_selesai)->format('H:i') }} WIB</span>
                        </div>
                        <div class="detail">
                            <i class="bi bi-geo-alt"></i>
                            <span>
                                @if(empty($rapat->detail_tempat))
                                    {{ $rapat->pelaksanaan }} - {{ $rapat->nama_tempat ?? $rapat->tempat_id }}
                                @else
                                    {{ $rapat->pelaksanaan }} - {{ $rapat->detail_tempat }}
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            <!-- End Detail Rapat  -->

            {{-- Unggah Notula --}}
            <div class="card overflow-auto p-3">
                <div class="card-body">
                    <div class="card-title py-1">
                        <h4> <strong> Unggah Notula </strong> </h4>
                    </div>
                    <div class="px-2">
                            <form action="{{ route('dashboard-rapat.upload_notula', $rapat->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id_rapat" value="{{ $rapat->id }}">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Upload file dalam format <strong>.pdf</strong></label>
                                    <div class="input-group">
                                        <input class="form-control @error('notula') is-invalid @enderror" type="file" id="formFile" name="notula" accept=".pdf">
                                        @error('notula')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
            {{--    End Unggah Notula--}}

            {{-- Riwayat Notula TODO: masih ga jelas maksudnya gmn --}}
                <div class="card overflow-auto p-3">
                    <div class="card-body">
                        <div class="card-title py-1">
                            <h4> <strong> Lihat Notula  </strong> </h4>
                        </div>
                        <x-table.table :idTable="'simpletable'" :headers="['Tanggal Submit','Lihat']">
                            @if (!empty($rapat->notulensi))
                                <tr>
                                    <x-table.td>{{ \Carbon\Carbon::parse($rapat->tanggal_submit)->translatedFormat('l, d F Y') }}</x-table.td>
                                    <x-table.td align='center'>
                                        <div>
                                            <a href="{{ route('notula.show', ['id' => $rapat->id]) }}" class="btn btn-primary rounded">
                                                <i class="fa fa-check-circle"></i> Detail
                                            </a>
                                            <form action="{{ route('dashboard-rapat.delete_notula', ['id_rapat' => $rapat->id]) }}" method="post" class="d-inline-block confirm-delete">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger rounded">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </x-table.td>
                                </tr>
                            @else
                                <tr>
                                    <td colspan="2" text-align="center">Belum ada notula yang diunggah</td>
                                </tr>
                            @endif
                        </x-table.table>
                    </div>
                </div>
                {{--End Riwayat Notula--}}
            </div>
        </div>

            {{--TODO: Tabel Mahasiswa--}}

    </section>

    <!-- Perlu membuat sestama yang bisa lihat notul dan delete notul (upload notul juga perlu)-->
    {{-- script coba liat di sikoko 62, ada beberapa logic untuk pindah ke form izin, ngatur tampilan ga ada rapat, load rapat, filter rapat, dan formating date  --}}

    <x-slot name="js_body">
        <script>
            $(document).ready(function() {
                $('.confirm-delete').on('click', function(e) {
                    e.preventDefault();
                    var form = $(this).closest('form');

                    Swal.fire({
                        title: "Yakin delete rapat?",
                        text: "Tindakan ini tidak bisa dibatalkan",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Ya, hapus!",
                        cancelButtonText: "Batal"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        </script>
    </x-slot>
</x-dashboard.layouts.layouts>
