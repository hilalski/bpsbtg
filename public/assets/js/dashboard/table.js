$(document).ready(function () {
    var tables = $(
        "#table-bau, #table-bau-revisi, #table-bau-penolakan"
    ).DataTable({
        scrollX: true,
        responsive: true,
        language: {
            lengthMenu: "Tampilkan _MENU_ entri",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
            infoFiltered: "(disaring dari _MAX_ entri)",
            search: "Cari:",
            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: ">",
                previous: "<",
            },
            zeroRecords: "Tidak ada data yang tersedia dalam tabel",
        },
    });

    tables.each(function () {
        new $.fn.dataTable.FixedHeader(this);
    });
});
