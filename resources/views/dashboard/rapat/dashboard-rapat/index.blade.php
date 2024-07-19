<x-dashboard.layouts.layouts :menu="$menu">
    <x-slot name="css">
        <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
        <style>
            .zoom-meet:hover {
                color: blue !important;
            }
        </style>
    </x-slot>

    <x-slot name="js_head">
        <!-- Custom JavaScript for head if any -->
    </x-slot>
    <section class="section dashboard">
        <x-card.card grid='small' judul='Daftar Rapat yang Anda Buat'>
            {{-- search dan tambah rapat --}}
            <div class="d-flex flex-wrap justify-content-between mt-2">
                <div class="ml-auto d-flex align-items-center justify-content-left mx-4 my-3">
                    <label class="mx-2" for="search">
                        <strong>Pencarian: </strong>
                    </label>
                    <input class="form-control" type="text" id="searchInput" name="search" placeholder="Pencarian">
                </div>
                <div class="ml-auto d-flex align-items-center justify-content-left mx-4 my-3">
                    <a class="btn btn-primary" href="{{ route('dashboard-rapat.create') }}">
                        <div>Tambah rapat</div>
                    </a>
                </div>
            </div>

            @if(is_null($rapat))
                <div id="norapat">
                    <h6 class='text-center text-muted font-italic'>Belum ada jadwal rapat terkini</h6>
                    <div class='row'>
                        <img id='norapatpict' src='{{ asset("assets/img/home/maintenance.gif") }}'
                            alt='Tidak ada rapat..' srcset=''>
                    </div>
                </div>
            @else
                <div class="row p-3" id="rapatList">
                    {{-- list rapat --}}
                    @foreach ($rapat as $r)
                        @if ($userMahasiswa && $userMahasiswa->nim === $r->sekretaris_nim)
                        <div class="col-sm-6 col-md-6">
                            <div class="card info-card border-top {{ $r->borderClass }} border-5">
                                <div class="card-body">
                                    {{-- action rapat --}}
                                    <div class="filter">
                                        <a class="icon" role="button" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                            <li class="dropdown-header text-start">
                                                <h6>Aksi</h6>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('rapat.send-jarkom', $r->id) }}">
                                                    <i class="bi bi-volume-up"></i> Kirim Jarkom
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('dashboard-rapat.edit', ['id_rapat' => $r->id]) }}">
                                                    <i class="bi bi-pencil"></i> Sunting
                                                </a>
                                            </li>
                                            <!-- tambahkan kondisi harus sekretaris -->
                                            <li>
                                                <form action="{{ route('dashboard-rapat.delete_rapat', ['id_rapat' => $r->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item confirm-delete">
                                                        <i class="bi bi-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                @if (now() >= ($r->waktu_mulai) && now() <= ($r->waktu_selesai))
                                                <form action="{{ route("dashboard-rapat.akhiri_rapat", ["id" => "$r->id"]) }}" method="POST" class="form-akhiri-rapat">
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit" class="dropdown-item akhiri-rapat">
                                                        <i class="bi bi-calendar-minus"></i> Akhiri Rapat
                                                    </button>
                                                </form>
                                                @endif
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('dashboard-rapat.notula', $r->id) }}">
                                                    <i class="bi bi-book"></i> Notula
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    {{-- detail pelaksanaan rapat --}}
                                    <div class="card-body">
                                        <h5 class="card-title-card-siagau">{{ $r->nama_rapat }}</h5>
                                        <ul id="detail-rapat-card-siagau" class="text-muted list-inline">
                                            <li class="list-inline-item">
                                                <i class="bi bi-calendar"></i>
                                                {{ $r->tanggal }}
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="bi bi-clock"></i>
                                                {{ $r->formatted_waktu_mulai }} - {{ $r->formatted_waktu_selesai }}
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="bi bi-map"></i>
                                                @if(empty($r->detail_tempat))
                                                    {{ $r->pelaksanaan }} - {{ $r->tempat->nama_tempat }}
                                                @else
                                                    {{ $r->pelaksanaan }} -
                                                    @if ($r->pelaksanaan == "Online")
                                                        @switch($r->tempat->nama_tempat)
                                                            @case("Ruang Virtual 1")
                                                                @php $zoomUrl = "https://stis-ac-id.zoom.us/j/5456101047?pwd=RFJPQmptd3FLSXhEMFdHeE44ak5adz09"; @endphp
                                                                @break
                                                            @case("Ruang Virtual 2")
                                                                @php $zoomUrl = "https://stis-ac-id.zoom.us/j/9903263737?pwd=UFM4MnU4RzhvSEQrWmdwUUZoRWNmdz09"; @endphp
                                                                @break
                                                            @case("Ruang Virtual 3")
                                                                @php $zoomUrl = "https://stis-ac-id.zoom.us/j/5881160900?pwd=THBjYUlWSG1sTk1RTHZzTVYwelUwdz09"; @endphp
                                                                @break
                                                            @case("Ruang Virtual 4")
                                                                @php $zoomUrl = "https://stis-ac-id.zoom.us/j/4185812554?pwd=MW9UTEVKTHlxcW5hKzBEU1llUEp3Zz09"; @endphp
                                                                @break
                                                            @case("Ruang Virtual 5")
                                                                @php $zoomUrl = "https://stis-ac-id.zoom.us/j/4587533259?pwd=YmR3YThwVjAvU2FqOE8yRForZXVIQT09"; @endphp
                                                                @break
                                                            @default
                                                                @php $zoomUrl = ""; @endphp
                                                        @endswitch

                                                        <a href="{{ $zoomUrl }}" class="text-secondary zoom-meet">{{ $r->tempat->nama_tempat }}</a>
                                                    @else
                                                        {{ $r->tempat->nama_tempat }}
                                                    @endif
                                                @endif
                                            </li>
                                        </ul>
                                        <!-- Notula Links and other content -->
                                    </div>

                                    {{-- tombol action bawah --}}
                                    <div id="button-action-rapat-card-siagau" class="mb-2">
                                        <!-- Buttons and badges here -->
                                        @if ($r->notulensi)
                                            <a href="{{ route('dashboard-rapat.notula', $r->id) }}" class="badge bg-success mr-2">
                                                <i class="fa fa-check mr-2"></i> Notula
                                            </a>
                                        @else
                                            <a href="{{ route('dashboard-rapat.notula', $r->id) }}" class="badge bg-danger mr-2">
                                                <i class="fa fa-times mr-2"></i> Notula
                                            </a>
                                        @endif
                                        {{-- perbarui route href nya --}}
                                        <a href="{{ route('dashboard-rapat.detail', $r->id) }}" class="badge bg-primary mr-2">
                                            <i class="bi bi-card-list"></i> Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            @endif
        </x-card.card>
    </section>

    <x-slot name="js_body">
        <!-- Custom JavaScript for body if any -->
        <script type="text/javascript">
            $(document).ready(function () {
            });
            $.fn.dataTable.moment('D-M-YYYY');
            $('#tabel_rapat_dashmon').DataTable({
                "dom": "<'row justify-content-center text-right'<'col col-auto'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row justify-content-center text-center'<'col col-auto'p>>",
                "lengthChange": false,
                "bInfo": false,
                "aaSorting": [],
                "language": {
                    // Your language options...
                    "lengthMenu": "Menampilkan _MENU_ data per halaman",
                    "zeroRecords": "Tidak ada data",
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada data tersedia",
                    "infoFiltered": "(Disaring dari _MAX_ data totoal)",
                    "decimal": "",
                    "emptyTable": "Tidak ada data tersedia",
                    "search": 'Pencarian <i class="bi bi-search"></i> ',
                    "searchPlaceholder": 'Cari...',
                    "loadingRecords": "Memuat...",
                    "processing": "Memproses...",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    },
                    "aria": {
                        "sortAscending": ": klik untuk mengurutkan A-Z",
                        "sortDescending": ": klik untuk mengurutkan Z-A"
                    }
                }
            });

            $('#tabel_rapat_dashmon_filter input').css({
                'border-radius': '15px',
                'padding': '5px',
                'padding-left': '15px',
                'width': '120px',
                'border': '1px solid #ccc'
            })
            $('#tabel_rapat_dashmon_filter input').hover(
                function () {
                    // Fungsi yang dijalankan saat mouse masuk (mouseenter)
                    $(this).css({
                        'width': '200px',
                        'transition': 'width 0.5s ease-in-out'
                    });
                },
                function () {
                    // Fungsi yang dijalankan saat mouse keluar (mouseleave)
                    $(this).css({
                        'width': '120px',
                        'transition': 'width 0.5s ease-in-out'
                    });
                }
            );

        </script>

        <!-- Jangan dihapus -->
        <script>
            $(document).ready(function () {
                    $('.confirm-delete').on('click', function (e) {
                        e.preventDefault();
                        var form = $(this).closest('form');

                    Swal.fire({
                        title: "Konfirmasi",
                        text: "Apakah anda yakin akan menghapus rapat ini?",
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

        <script type="text/javascript">
            $(document).ready(function () {
                $('.akhiri-rapat').on('click', function (e) {
                    e.preventDefault();
                    var form = $(this).closest('form');
                    var rapatId = form.data('rapat-id');

                    Swal.fire({
                        title: "Konfirmasi",
                        text: "Apakah anda yakin akan mengakhiri rapat?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Ya, akhiri!",
                        cancelButtonText: "Batal"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Lakukan permintaan POST menggunakan AJAX
                            $.ajax({
                                url: form.attr('action'),
                                type: form.attr('method'),
                                data: {
                                    "_token": form.find('input[name="_token"]').val(),
                                    "rapatId": rapatId
                                },
                                success: function (response) {
                                    console.log(response.message);

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Rapat Berhasil Diakhiri',
                                        text: response.message || 'Rapat berhasil diakhiri',
                                    });
                                },
                                error: function (xhr, status, error) {
                                    console.error(error);
                                }
                            });
                        }
                    });
                });
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function () {
                $('#searchInput').on('keyup', function () {
                    var value = $(this).val().toLowerCase();
                    $('#rapatList .col-sm-6.col-md-6').each(function () {
                        var isVisible = $(this).find('.card').text().toLowerCase().indexOf(value) > -1;
                        $(this).toggleClass('d-none', !isVisible);
                    });
                });
            });
        </script>
    </x-slot>
</x-dashboard.layouts.layouts>
