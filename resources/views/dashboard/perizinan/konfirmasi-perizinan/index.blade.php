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

    {{-- Modal Detail Perizinan --}}
    <div class="modal fade" id="detailModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Detail Perizinan</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true"><i class="fa fa-close"></i></span>
                  </button>
              </div>
              <div class="modal-body" id="detail_izin">

              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary rounded" data-bs-dismiss="modal">Tutup</button>
              </div>
          </div>
      </div>
  </div>


  <!-- Konfirmasi perizinan dosen-->
    {{-- Konfirmasi Perizinan Dosen --}}
    <x-card.card grid='small' judul='Konfirmasi Perizinan Dosen'>
        <x-table.table :idTable="'simpletable'" :headers="['Nama','NIP','Nama Kegiatan', ['name' => 'Detail', 'align' => 'center' ], ['name' => 'Keputusan', 'align' => 'center' ]]">
            @foreach ($perizinanDosenMenunggu as $izin)
            <tr>
                <x-table.td>{{ $izin->dosen->nama }}</x-table.td>
                <x-table.td>{{ $izin->dosen_nip }}</x-table.td>
                <x-table.td>{{ $izin->rapat->nama_kegiatan }}</x-table.td>
                <x-table.td align='center'>
                    <button class="btn btn-primary rounded" onclick="detailIzin({{ $izin->id }})" data-bs-toggle="modal" data-bs-target="#detailModal">
                        <i class="fa fa-search-plus"></i> Detail
                    </button>
                </x-table.td>
                <x-table.td align='center'>
                    {{-- Adjust the URL as per the route defined in your web.php --}}
                    <a href="{{ url('/konfirmasi/perizinan/dosen/acc/' . $izin->id) }}" class="btn btn-primary tombol-acc rounded" role="button">
                        <i class="fa fa-check-circle"></i> Konfirmasi
                    </a>
                </x-table.td>
            </tr>
            @endforeach
        </x-table.table>
    </x-card.card>

    <!-- Konfirmasi perizinan Mahasiswa-->
    {{-- Konfirmasi Perizinan Mahasiswa --}}
    <x-card.card grid='small' judul='Konfirmasi Perizinan Mahasiswa'>
        <x-table.table :idTable="'simpletable2'" :headers="['Nama','NIM','Nama Kegiatan', ['name' => 'Lampiran File', 'align' => 'center' ], ['name' => 'Keputusan', 'align' => 'center' ]]">
            @foreach ($perizinanMahasiswaMenunggu as $izin)
            <tr>
                <x-table.td>{{ $izin->mahasiswa->nama }}</x-table.td>
                <x-table.td>{{ $izin->mahasiswa_nim }}</x-table.td>
                <x-table.td>{{ $izin->rapat->nama_rapat}}</x-table.td>
                {{-- <x-table.td align='center'>
                    <button class="btn btn-primary rounded" onclick="detailIzin({{ $izin->id }})" data-bs-toggle="modal" data-bs-target="#detailModal">
                        <i class="fa fa-search-plus"></i> Detail
                    </button>
                </x-table.td> --}}
                <x-table.td align='center'>
                    <a class="btn btn-warning rounded" href="{{ $izin->file_perizinan }}" target="_blank">
                        <i class="fa fa-file"></i> File
                    </a>
                </x-table.td>
                <x-table.td align='center'>
                    {{-- Adjust the URL as per the route defined in your web.php --}}
                    <a href="{{ route('konfirmasi.diterima' , ['id' => $izin->id]) }}" class="btn btn-primary tombol-acc rounded" role="button">
                        <i class="fa fa-check-circle"></i> Setujui</a>
                    <a href="{{ route('konfirmasi.ditolak' ,['id' => $izin->id]) }}" class="btn btn-danger tombol-tolak rounded" role="button">
                        <i class="fa fa-times-circle"></i> Tolak
                    </a>
                </x-table.td>
            </tr>
            @endforeach
        </x-table.table>
    </x-card.card>

    {{-- Riwayat Konfirmasi Dosen --}}
    <x-card.card grid='small' judul='Riwayat Konfirmasi Dosen'>
        <x-table.table :idTable="'simpletable3'" :headers="['Nama','NIP','Status', 'Nama Pemroses',['name' => 'Lampiran File', 'align' => 'center']]">
            @foreach ($perizinanDosenRiwayat as $izin)
            <tr>
                <x-table.td>{{ $izin->dosen->nama }}</x-table.td>
                <x-table.td>{{ $izin->dosen_nip }}</x-table.td>
                <x-table.td>{{ $izin->status }}</x-table.td>
                <x-table.td>{{ $izin->sekretaris->nama }}</x-table.td>
                <x-table.td align='center'>
                    <button class="btn btn-primary rounded" onclick="detailIzin({{ $izin->id }})" data-bs-toggle="modal" data-bs-target="#detailModal">
                        <i class="fa fa-search-plus"></i> Detail
                    </button>
                </x-table.td>
            </tr>
            @endforeach
        </x-table.table>
    </x-card.card>

    {{-- Riwayat Konfirmasi Mahasiswa --}}
    <x-card.card grid='small' judul='Riwayat Konfirmasi Mahasiswa'>
        <x-table.table :idTable="'simpletable4'" :headers="['Nama','NIM','Status', 'Nama Pemroses',['name' => 'Lampiran File', 'align' => 'center']]">
            @foreach ($perizinanMahasiswaRiwayat as $izin)
            <tr>
                <x-table.td>{{ $izin->mahasiswa->nama }}</x-table.td>
                <x-table.td>{{ $izin->mahasiswa_nim }}</x-table.td>
                <x-table.td>{{ $izin->status }}</x-table.td>
                <x-table.td>{{ $izin->sekretaris->nama ?? 'N/A' }}</x-table.td>
                <x-table.td align='center'>
                    <a class="btn btn-warning rounded" href="{{ $izin->file_perizinan }}" target="_blank">
                        <i class="fa fa-file"></i> File
                    </a>
                </x-table.td>
            </tr>
            @endforeach
        </x-table.table>
    </x-card.card>

    <x-slot name="js_body">
      <script type="text/javascript">
        $(document).ready(function() {
            // load izin sesuai penyelenggara
            $('#izin-container-sesuai').show();
            $('#izin-container-semua').hide();
        });
        $.fn.dataTable.moment('D-M-YYYY');
        $('#simpletable, #simpletable2, #simpletable3, #simpletable4').DataTable({
            "aaSorting": [],
            "language": {
                "lengthMenu": "Menampilkan _MENU_ data per halaman",
                "zeroRecords": "Tidak ada izin masuk",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "infoEmpty": "Tidak ada data tersedia",
                "infoFiltered": "(Disaring dari _MAX_ data total)",
                "decimal": "",
                "emptyTable": "Tidak ada izin masuk",
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

        function detailIzin(id) {
            let data = getIzinData(id);
            var text = `
                <table class="table table-borderless fluid-container">
                    <tr>
                        <th>Nama Kegiatan</th>
                        <td>${data['nama_rapat']}</td>
                    </tr>
                    <tr>
                        <th>Agenda</th>
                        <td>${data['agenda']}</td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td>${data['waktu_mulai']}</td>
                    </tr>
                    <tr>
                        <th>Jenis Izin</th>
                        <td>${data['jenis_izin']}</td>
                    </tr>
                    ${data['jenis_izin'] == 'Terlambat' ? `
                    <tr>
                        <th>Durasi Keterlambatan</th>
                        <td>${data['durasi_keterlambatan']}</td>
                    </tr>`: ''}
                    <tr>
                        <th>Alasan</th>
                        <td><textarea class="form-control" style="background-color: #fff; border: none; resize: none; color: #004b3cff; padding: 4px 0;" readonly>${data['alasan']}</textarea></td>
                    </tr>
                    <tr>
                        <th>Lampiran</th>
                        <td>
                            <a class="font-weight-bold" href="{{ url('/surat_izin/') }}/${data['url_file']}" download>Download</a>
                        </td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>${data['status']}</td>
                    </tr>
                </table>
            `;
            console.log(data);
            $("#detail_izin").html(text);
        }

        function getIzinData(id) {
            var jsonData = $.ajax({
                url: "{{ url('/sikoko/perizinan/detail_modal/') }}" + '/' + id,
                dataType: "json",
                // async: true, // Pilih salah satu antara async true atau hapus baris ini (karena true adalah nilai default).
            }).responseText;

            data = JSON.parse(jsonData);

            return data[0];
        }


        // belum tau logic nya ini bro yg flashData
        const flashData = $('.flash-data').data('flashdata');

        // popup jika berhasil
        if (flashData) {
            if (flashData == 'false') {
                swal({
                    title: 'Gagal',
                    text: 'Data gagal diproses',
                    type: 'error'
                });

            } else {
                swal({
                    title: 'Berhasil',
                    text: 'Data berhasil ' + flashData,
                    type: 'success'
                });
            }
        }

        // tombol acc
        $('.tombol-acc').on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href');

            Swal.fire({
                title: "Apakah kamu yakin?",
                text: "Melakukan persetujuan perizinan",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, acc perizinan!",
                cancelButtonText: "Kembali"
                }).then((result) => {
                if (result.isConfirmed) {
                    // acc izin
                    document.location.href = href

                    // pesan sukses atau berhasil
                    Swal.fire({
                    title: "Berhasil",
                    text: "Perizinan disetujui",
                    icon: "success"
                    });
                }
            });

        });

        // tombol ditolak
        $('.tombol-tolak').on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href');

            Swal.fire({
                title: "Apakah kamu yakin?",
                text: "Melakukan penolakan perizinan",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, tolak perizinan!",
                cancelButtonText: "Kembali"
                }).then((result) => {
                if (result.isConfirmed) {
                    // acc izin
                    document.location.href = href

                    // kayaknya perlu dicek dulu response nya berhasil atau ga

                    // pesan sukses atau berhasil
                    Swal.fire({
                    title: "Berhasil",
                    text: "Perizinan ditolak",
                    icon: "success"
                    });
                }
            });
        });


        // setting search filter
        $(document).ready(function() {
        $('#simpletable_filter input, #simpletable2_filter input, #simpletable3_filter input,#simpletable4_filter input').css({
            'border-radius': '15px',
            'padding': '5px',
            'padding-left': '15px',
            'width': '120px',
            'border': '1px solid #ccc'
        })
        $('#simpletable_filter input, #simpletable2_filter input, #simpletable3_filter input,#simpletable4_filter input').hover(
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
