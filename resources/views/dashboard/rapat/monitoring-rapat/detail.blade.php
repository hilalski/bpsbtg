<x-dashboard.layouts.layouts :menu="$menu">
    <x-slot name="css">
        <style>
            .datatable-controls {
          display: flex;
          justify-content: space-between;
          margin-bottom: 10px; /* Add margin to create space */
        }

        .length-menu,
        .search-box {
          margin-bottom: 10px; /* Add margin to create space */
        }

        #simpletable thead th, #simpletable2 thead th, #simpletable3 thead th {
            background-color: #666;
            color: white;
        }

        .dataTables_length, .dataTables_filter, .dataTables_info, .dataTables_paginate{
            margin: 15px
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
                            <span>{{ ($rapat->waktu_mulai)->translatedFormat('l, d F Y', 'id') }}</span>
                        </div>
                        <div class="detail">
                            <i class="bi bi-clock"></i>
                            <span>{{ ($rapat->waktu_mulai)->format('H:i') }} - {{ ($rapat->waktu_selesai)->format('H:i') }} WIB</span>
                        </div>
                        <div class="detail">
                            <i class="bi bi-geo-alt"></i>
                            <span>
                                @if(empty($rapat->detail_tempat))
                                    {{ $rapat->pelaksanaan }} - {{ $rapat->nama_tempat ?? $rapat->tempat->nama_tempat }}
                                @else
                                    {{ $rapat->pelaksanaan }} - {{ $rapat->detail_tempat }}
                                @endif
                            </span>
                        </div>
                        <br>
                        <div class="detail">
                            <strong>Agenda</strong>
                            <span>{{ $rapat->agenda }}</span>
                        </div>
                        <br>
                        <div class="detail">
                            <strong>Notula</strong>
                            <span>
                                <a href="{{ route('notula.show', ['id' => $rapat->id]) }}" class="btn btn-primary" style="margin-right: 10px;">
                                    <i class="bi bi-eye"></i> Lihat
                                </a>
                                <a href="{{ route('notula.download_notula', ['id' => $rapat->id]) }}" class="btn btn-success">
                                    <i class="bi bi-download"></i> Download
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            {{-- </x-card.card> --}}
            <!-- End Detail Rapat  -->

            {{-- Daftar Absensi Peserta Mahasiswa --}}
                    <x-card.card grid='small' judul='Daftar Presensi Peserta Mahasiswa' >
                        <x-table.table :idTable="'simpletable'" :headers="['Nama','NIM','Keterangan','Tingkat Kehadiran']">
                            @foreach ($rapat_presensi_mahasiswa as $rpm)
                            <tr>
                                <x-table.td>{{ $rpm->mahasiswa->nama }}</x-table.td>
                                <x-table.td>{{ $rpm->mahasiswa_nim }}</x-table.td>
                                <x-table.td>{{ $rpm->keterangan }}</x-table.td>
                                <x-table.td>{{ $rpm->persentase }}%</x-table.td>
                            </tr>
                            @endforeach
                        </x-table.table>
                    </x-card.card>

            {{-- Daftar Absensi Peserta Dosen --}}
                    <x-card.card grid='small' judul='Daftar Presensi Peserta Dosen' >
                        <x-table.table :idTable="'simpletable2'" :headers="['Nama','Email','Keterangan', 'Tingkat Kehadiran']">
                            @foreach ($rapat_presensi_dosen as $rpd)
                            <tr>
                                <x-table.td>{{ $rpd->dosen->nama }}</x-table.td>
                                <x-table.td>{{ $rpd->dosen_nip }}</x-table.td>
                                <x-table.td>{{ $rpd->keterangan }}</x-table.td>
                                <x-table.td>{{ $rpd->persentase }}%</x-table.td>
                            </tr>
                            @endforeach
                        </x-table.table>
                    </x-card.card>
            {{--TODO: Tabel Mahasiswa--}}

    </section>

    <x-slot name="js_body">
        <script>
            $(document).ready(function(){
                $('.copy-btn').click(function(){
                    var copyTextId = $(this).data('target');
                    var copyText = $(copyTextId)[0];

                    copyText.select();
                    copyText.setSelectionRange(0, 99999);
                    document.execCommand("copy");

                    // Triggering the SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Kode berhasil disalin',
                        customClass: {
                            confirmButton: 'status-custom-confirm-button'
                        }
                    });
                });
            });
        </script>

<script>
    $.fn.dataTable.moment('D-M-YYYY');
    $('#simpletable, #simpletable2').DataTable({
        "aaSorting": [],
        "language": {
            "lengthMenu": "Menampilkan _MENU_ data per halaman",
            "zeroRecords": "Tidak ada data",
            "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
            "infoEmpty": "Tidak ada data tersedia",
            "infoFiltered": "(Disaring dari _MAX_ data total)",
            "decimal": "",
            "emptyTable": "Tidak Ada Daftar Dalam Tabel",
            "loadingRecords": "Memuat...",
            "processing": "Memproses...",
            "search": 'Pencarian <i class="bi bi-search"></i> ',
            "searchPlaceholder": 'Cari...',
            "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "previous": '<i class="bi bi-chevron-double-left"></i>',
                "next": '<i class="bi bi-chevron-double-right"></i>'
            },
            "aria": {
                "sortAscending": ": klik untuk mengurutkan A-Z",
                "sortDescending": ": klik untuk mengurutkan Z-A"
            }
        }
    });

    $(document).ready(function() {
            $('#simpletable_filter input, #simpletable2_filter input').css({
                'border-radius': '15px',
                'padding': '5px',
                'padding-left': '15px',
                'width': '120px',
                'border': '1px solid #ccc'
            })
            $('#simpletable_filter input, #simpletable2_filter input').hover(
                function() {
                    // Fungsi yang dijalankan saat mouse masuk (mouseenter)
                    $(this).css({
                        'width': '200px',
                        'transition': 'width 0.5s ease-in-out'
                    });
                },
                function() {
                    // Fungsi yang dijalankan saat mouse keluar (mouseleave)
                    $(this).css({
                        'width': '120px',
                        'transition': 'width 0.5s ease-in-out'
                    });
                }
            );

        });
    </script>

    </x-slot>
</x-dashboard.layouts.layouts>
