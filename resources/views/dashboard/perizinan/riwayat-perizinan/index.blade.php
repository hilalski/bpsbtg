<x-dashboard.layouts.layouts :menu="$menu">
    <x-slot name="css">
      <style>
        /* CSS to control layout */
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
        .no-izin-row td {
            border: none; /* Hide the borders */
            padding: 0; /* Remove padding */
            color: transparent; /* Make the text transparent to hide it */
            background-color: transparent; /* Ensure the background doesn't cover other cells' borders */
        }

        .no-izin-row td:first-child {
            color: initial; /* Reapply text color to the first cell */
            text-align: left; /* Align text to the left */
            width: 100%; /* Span the width to the entire table */
        }

      </style>
    </x-slot>

    <x-slot name="js_head">

      {{-- belum diatur logic dan sweetalertnya --}}
      {{-- <script>
        $(function() {
            @if(session()->has('msg'))
                @if(session('msg') == 'Perizinan berhasil diajukan!')
                    Swal.fire({
                        icon: 'success',
                        text: '{{ session("msg") }}',
                        confirmButtonColor: '#506396'
                    })
                @endif
            @endif
        });
    </script> --}}

    </x-slot>

    {{-- ini isinya riwayat pribadi perizinan --}}

    <x-card.card grid='small' judul='Riwayat Perizinan yang Anda Ajukan'>
        <x-table.table :idTable="'simpletable'" :headers="['Nama Rapat','Tanggal Rapat','Jenis Izin', 'Status',['name' => 'Lampiran File', 'align' => 'center']]">
            {{-- dynamic data --}}
            @foreach ($rapatIzin as $izin)
            <tr>

                <x-table.td>{{ $izin->rapat->nama_rapat }}</x-table.td>
                <x-table.td>{{ $izin->rapat->waktu_mulai }}</x-table.td>
                <x-table.td>{{ $izin->jenis_izin }}</x-table.td>
                <x-table.td>{{ $izin->status }}</x-table.td>
                <x-table.td align='center'>
                    <a class="btn btn-warning rounded" href="{{ $izin->file_perizinan }}" target="_blank">
                        <i class="fa fa-file"></i> File
                    </a>
                </x-table.td>
            </tr>
            @endforeach
            {{-- Handle case where there's no izin --}}
            {{-- @if ($rapatIzin->isEmpty())
            <tr class="no-izin-row">
                <td>Anda belum pernah mengajukan perizinan, pertahankan :)</td>
                <td></td> <!-- The rest of the cells are visually 'empty' -->
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @endif --}}
        </x-table.table>
    </x-card.card>

    <x-slot name="js_body">
      <script>
        $.fn.dataTable.moment('D-M-YYYY');
        $('#simpletable').DataTable({
            "aaSorting": [],
            "language": {
                "lengthMenu": "Menampilkan _MENU_ data per halaman",
                "zeroRecords": "Tidak ada data",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "infoEmpty": "Tidak ada data tersedia",
                "infoFiltered": "(Disaring dari _MAX_ data total)",
                "decimal": "",
                "emptyTable": "Anda belum pernah mengajukan perizinan, pertahankan :)",
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
                $('#simpletable_filter input').css({
                    'border-radius': '15px',
                    'padding': '5px',
                    'padding-left': '15px',
                    'width': '120px',
                    'border': '1px solid #ccc'
                })
                $('#simpletable_filter input').hover(
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
