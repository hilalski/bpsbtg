<x-dashboard.layouts.layouts :menu="$menu">
    <x-slot name="css">
        <style>
            #simpletable thead th, #simpletable2 thead th, #simpletable3 thead th, #simpletable4 thead th {
                background-color: #666;
                color: white;
            }
    
            .dataTables_length, .dataTables_filter, .dataTables_info, .dataTables_paginate{
                margin: 15px
            }
    
          </style>
    </x-slot>

    <x-slot name="js_head">
    </x-slot>
    
    <section class="section dashboard">
      <x-card.card grid='small' judul='Kotak Aspirasi' desc='Halaman ini berisi aspirasi teman-teman PKL DIV Angkatan 63'>
        <x-table.table :idTable="'simpletable'" :headers="['Pengirim','Isi Aspirasi','Waktu Terkirim', ['name' => 'Aksi', 'align' => 'center' ]]">
            @for ($i = 1; $i <= 5; $i++)
            <tr>
                <x-table.td>Pengirim ke-{{$i}}</x-table.td>
                <x-table.td>Sambatan ke-{{$i}}</x-table.td>
                <x-table.td>26-11-202{{$i}}</x-table.td>
                <x-table.td align='center'>
                    {{-- Adjust the URL as per the route defined in your web.php --}}
                    <a href="{{ url('/delete-aspirasi') }}" class="btn btn-danger tombol-delete rounded" role="button">
                        <i class="bi bi-file-x-fill"></i> Hapus
                    </a>
                </x-table.td>
            </tr>
            @endfor
        </x-table.table>
      </x-card.card>


    </section>

    <x-slot name="js_body">
      <script>
      $(document).ready(function() {    
        $.fn.dataTable.moment('D-M-YYYY');
        $('#simpletable').DataTable({
            "aaSorting": [],
            "language": {
                "lengthMenu": "Menampilkan _MENU_ data per halaman",
                "zeroRecords": "Belum ada aspirasi masuk",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "infoEmpty": "Tidak ada data tersedia",
                "infoFiltered": "(Disaring dari _MAX_ data total)",
                "decimal": "",
                "emptyTable": "Belum ada aspirasi yang masuk",
                "loadingRecords": "Memuat...",
                "processing": "Memproses...",
                "search": 'Pencarian <i class="bi bi-search"></i> ',
                "searchPlaceholder": 'Cari...',
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    // "next": "Selanjutnya",
                    // "previous": "Sebelumnya"
                    "previous": '<i class="bi bi-chevron-double-left"></i>',
                    "next": '<i class="bi bi-chevron-double-right"></i>'
                },
                "aria": {
                    "sortAscending": ": klik untuk mengurutkan A-Z",
                    "sortDescending": ": klik untuk mengurutkan Z-A"
                }
            }
        });

        $('.tombol-delete').on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href');
    
            Swal.fire({
                title: "Apakah kamu yakin?",
                text: "Periksa kembali apakah aspirasi sudah ditanggapi",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Kembali"
            }).then((result) => {
                if (result.isConfirmed) {
                    // acc izin
                    document.location.href = href;
    
                    // pesan sukses atau berhasil
                    Swal.fire({
                        title: "Berhasil",
                        text: "Aspirasi terselesaikan",
                        icon: "success"
                    });
                }
            });
        });
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