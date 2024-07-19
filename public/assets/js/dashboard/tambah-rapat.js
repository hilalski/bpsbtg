$(document).ready(function () {
    let csrfToken = $('meta[name="csrf-token"]').attr("content");

    let today = moment().format("YYYY-MM-DD");
    $("#tanggal").attr("min", today);

    $("#list_seksi, #list_subseksi, #list_bagian").prop("disabled", true);

    $("#list_risbid").change(function () {
        let risbid = $(this).val();
        let risbidText = $("#list_risbid").children("option:selected").text();
        updatePesertaLabel(risbidText);

        $("#label-selected-peserta").show();

        if ($("#koordinator").val() === "Sultan Hadi Prabowo") {
            let link = "/dashboard/rapat/dashboard/rapat/seksi-by-risbid";
            $.ajax({
                type: "POST",
                url: link,
                data: {
                    risbid: risbid,
                    _token: csrfToken, // CSRF token for Laravel
                },
                success: function (response) {
                    let list =
                        '<option value="null" selected>Pilih Seksi</option>';
                    $.each(response, function (index, value) {
                        list += `<option value="${value.id}">${value.nama_seksi}</option>`;
                    });
                    $("#list_seksi").html(list);
                    $("#list_subseksi").html(
                        '<option value="null" selected>Pilih Subseksi</option>'
                    );
                    $("#list_bagian").html(
                        '<option value="null" selected>Pilih Bagian</option>'
                    );

                    $("#list_subseksi, #list_bagian").prop("disabled", true);
                },
            });
        }

        $("#list_seksi, #list_subseksi, #list_bagian").val("null"); // Reset seksi, subseksi, and bagian dropdowns
        if (
            risbid === "null" ||
            risbid === "MB01" ||
            risbid === "MB02" ||
            risbid === "MB03" ||
            risbid === "MB07"
        ) {
            $("#list_seksi, #list_subseksi, #list_bagian").prop(
                "disabled",
                true
            );
        } else {
            $("#list_seksi").prop("disabled", false);
        }

        removeOptionMahasiswa();

        if (risbid !== "null") {
            bind_select_mahasiswa();
        }
    });

    $("#list_seksi").change(function () {
        let seksiId = $(this).val();
        let seksiText = $("#list_seksi").children("option:selected").text();
        updatePesertaLabel(seksiText);

        $("#label-selected-peserta").show();

        if ($("#koordinator").val() === "Sultan Hadi Prabowo") {
            let link = "/dashboard/rapat/dashboard/rapat/subksesi-by-seksi";
            $.ajax({
                type: "POST", // or "GET" based on your backend setup
                url: link,
                data: {
                    seksi_id: seksiId,
                    _token: csrfToken, // Include this if the method is POST
                },
                success: function (response) {
                    let list =
                        '<option value="null" selected>Pilih Subseksi</option>';
                    $.each(response, function (index, value) {
                        list += `<option value="${value.id}">${value.nama_subseksi}</option>`;
                    });
                    $("#list_subseksi").html(list);
                    $("#list_bagian").html(
                        '<option value="null" selected>Pilih Bagian</option>'
                    );
                    $("#list_bagian").prop("disabled", true);
                },
            });
        }

        $("#list_subseksi, #list_bagian").val("null"); // Reset seksi, subseksi, and bagian dropdowns
        if (seksiId === "null") {
            $("#list_subseksi, #list_bagian").prop("disabled", true);
        } else {
            $("#list_subseksi").prop("disabled", false);
        }

        removeOptionMahasiswa();
        bind_select_mahasiswa();
        if (seksiId.includes("SB")) {
            filterSubseksi(seksiId);
        }
    });

    $("#list_subseksi").change(function () {
        let subseksiId = $(this).val();
        let subseksiText = $("#list_subseksi")
            .children("option:selected")
            .text();
        updatePesertaLabel(subseksiText);

        $("#list_bagian").val("null"); // Reset seksi, subseksi, and bagian dropdowns
        if (subseksiId === "null" || subseksiId.includes("SSB")) {
            $("#list_bagian").prop("disabled", true);
        } else {
            $("#list_bagian").prop("disabled", false);
        }
        removeOptionMahasiswa();
        bind_select_mahasiswa();
        if (subseksiId.includes("SSR")) {
            filterBagian(subseksiId);
        }
    });

    $("#list_bagian").change(function () {
        let bagianText = $("#list_bagian").children("option:selected").text();
        updatePesertaLabel(bagianText);
        removeOptionMahasiswa();
        bind_select_mahasiswa();
    });

    $("#multiple-select-mahasiswa").select2({});
    $("#multiple-select-dosen").select2({});

    $("#add-mahasiswa").click(function () {
        $("#multiple-select-mahasiswa option")
            .prop("selected", true)
            .trigger("change");
    });

    $("#add-dosen").click(function () {
        $("#multiple-select-dosen option")
            .prop("selected", true)
            .trigger("change");
    });

    $("#remove-dosen").click(function () {
        $("#multiple-select-dosen option")
            .prop("selected", false)
            .trigger("change");
    });

    $("#remove-mahasiswa").click(function () {
        $("#multiple-select-mahasiswa option")
            .prop("selected", false)
            .trigger("change");
    });

    function removeOptionMahasiswa() {
        $("#multiple-select-mahasiswa option").remove();
    }

    function filterSubseksi(seksiId) {
        $("#list_subseksi option").hide();

        let list = "";
        list += '<option value="null" selected>Pilih Subseksi</option>';
        if (seksiId === "SB01") {
            list += '<option value="SSB01">Internal</option>';
            list += '<option value="SSB02">Eksternal</option>';
        } else if (seksiId === "SB02") {
            list += '<option value="SSB03">Perlengkapan</option>';
            list += '<option value="SSB04">Lapangan</option>';
        } else if (seksiId === "SB03") {
            list += '<option value="SSB05">Fotografi dan Videografi</option>';
            list += '<option value="SSB06">Penulisan dan Publikasi</option>';
            list += '<option value="SSB07">Desain Grafis</option>';
        } else if (seksiId === "SB04") {
            list += '<option value="SSB08">CAPI</option>';
            list += '<option value="SSB09">Sistem Monitoring</option>';
            list += '<option value="SSB10">Pengelolaan Server</option>';
            list += '<option value="SSB11">Kuesioner</option>';
        } else if (seksiId === "SB05") {
            list += '<option value="SSB12">Frontend</option>';
            list += '<option value="SSB13">Backend</option>';
            list += '<option value="SSB14">Database</option>';
        } else if (seksiId === "SB06") {
            list += '<option value="SSB15">SPVD Modul 1</option>';
            list += '<option value="SSB16">SPVD Modul 2</option>';
            list += '<option value="SSB17">Website</option>';
            list += '<option value="SSB18">User Interface</option>';
            list += '<option value="SSB19">Standar Visualisasi</option>';
        }
        $("#list_subseksi").html(list);
    }

    function filterBagian(subseksiId) {
        $("#list_bagian option").hide();

        let list = "";
        list += '<option value="null" selected>Pilih Bagian</option>';
        if (subseksiId === "SSR01") {
            list +=
                '<option value="SSRB01">Submodul Pendidikan Modul 1</option>';
            list +=
                '<option value="SSRB02">Submodul Sosial Budaya Modul 1</option>';
            list += '<option value="SSRB03">Submodul Ekonomi Modul 1</option>';
        } else if (subseksiId === "SSR02") {
            list += '<option value="SSRB04">Listing Modul 1</option>';
            list += '<option value="SSRB05">Sampling Modul 1</option>';
        } else if (subseksiId === "SSR03") {
            list += '<option value="SSRB06">Buku Pedoman Modul 1</option>';
            list +=
                '<option value="SSRB07">Pertanyaan Kuesioner Modul 1</option>';
            list +=
                '<option value="SSRB08">Survei Pendahuluan dan Pelatihan Petugas Modul 1</option>';
        } else if (subseksiId === "SSR04") {
            list += '<option value="SSRB09">Pemrosesan Data Modul 1</option>';
            list +=
                '<option value="SSRB10">Visualisasi dan Diseminasi Data Modul 1</option>';
        } else if (subseksiId === "SSR05") {
            list +=
                '<option value="SSRB11">Submodul Pendidikan Modul 2</option>';
            list +=
                '<option value="SSRB12">Submodul Sosial Budaya Modul 2</option>';
            list += '<option value="SSRB13">Submodul Ekonomi Modul 2</option>';
        } else if (subseksiId === "SSR06") {
            list += '<option value="SSRB14">Listing Modul 2</option>';
            list += '<option value="SSRB15">Sampling Modul 2</option>';
        } else if (subseksiId === "SSR07") {
            list += '<option value="SSRB16">Buku Pedoman Modul 2</option>';
            list +=
                '<option value="SSRB17">Pertanyaan Kuesioner Modul 2</option>';
            list +=
                '<option value="SSRB18">Survei Pendahuluan dan Pelatihan Petugas Modul 2</option>';
        } else if (subseksiId === "SSR08") {
            list += '<option value="SSRB19">Pemrosesan Data Modul 2</option>';
            list +=
                '<option value="SSRB20">Visualisasi dan Diseminasi Data Modul 2</option>';
        }

        $("#list_bagian").html(list);
    }

    function bind_select_mahasiswa() {
        let risbid = $("#list_risbid").children("option:selected").val();
        let seksi = $("#list_seksi").children("option:selected").val();
        let subseksi = $("#list_subseksi").children("option:selected").val();
        let bagian = $("#list_bagian").children("option:selected").val();
        let url =
            "/dashboard/rapat/dashboard/rapat/tambah-anggota-pasca-pencacahan";

        $.ajax({
            type: "POST",
            url: url,
            dataType: "JSON",
            data: {
                risbid: risbid,
                seksi: seksi,
                subseksi: subseksi,
                bagian: bagian,
                _token: csrfToken,
            },
            success: function (result) {
                str = [];
                $("#multiple-select-mahasiswa").each(function () {
                    //untuk setiap option yang terpilih
                    str.push($(this).val()); //dimasukan ke array str
                });
                for (i = 0; i < result.length; i++) {
                    if (
                        $("#multiple-select-mahasiswa").find(
                            "option[value='" + result[i].nim + "']"
                        ).length
                    ) {
                        //cek apakah sudah ada option itu, jika ada maka...
                        if (jQuery.inArray(result[i].nim, str) === -1) {
                            //cek apakah nim dati option itu sudah ada di nim yang terpilih, jika tidak ada...
                            $(
                                "#multiple-select-mahasiswa option[value='" +
                                    result[i].nim +
                                    "']"
                            ).trigger("change"); //pilih nim tersebut
                        }
                    } else {
                        //jika option tidak ada
                        var newOption = new Option(
                            result[i].nama,
                            result[i].nim,
                            false,
                            false
                        ); //membuat option dan select option tersebut
                        $("#multiple-select-mahasiswa")
                            .append(newOption)
                            .trigger("change"); //memasukan option yang telah dibuat
                    }
                }
            },
        });
    }

    function updatePesertaLabel(labelText) {
        if (labelText === "Riset") {
            labelText = 'Tambah Peserta Rapat "Riset (Semua Mahasiswa)"';
        } else {
            labelText = "Tambah Peserta Rapat " + '"' + labelText + '"';
        }

        $("#label-selected-peserta").text(labelText);
    }

    $("#inputNamaTempat").change(function () {
        var selectedOption = $(this).val();
        if (selectedOption == "OF002") {
            $("#detailTempat").removeClass("d-none");
        } else {
            $("#detailTempat").addClass("d-none");
        }
    });

    var oldPelaksanaan = "{{ old('pelaksanaan') }}";
    var oldTempat = "{{ old('tempat') }}";
    var oldDetailTempat = "{{ old('detail_tempat') }}";

    function loadTempatOptions(selectedPelaksanaan) {
        let link = "/dashboard/rapat/dashboard/rapat/tambah-tempat";
        $.ajax({
            url: link,
            method: "POST",
            data: {
                pelaksanaan: selectedPelaksanaan,
                _token: csrfToken,
            },
            success: function (data) {
                $("#inputNamaTempat")
                    .empty()
                    .append("<option value=''>Pilih Tempat</option>");
                $.each(data.tempatOptions, function (key, value) {
                    $("#inputNamaTempat").append(
                        '<option value="' +
                            value.id +
                            '" ' +
                            (value.nama_tempat === oldTempat
                                ? "selected"
                                : "") +
                            ">" +
                            value.nama_tempat +
                            "</option>"
                    );
                });

                // Panggil ini setelah mengisi opsi untuk mengatur visibilitas detailTempat
                handleDetailTempatVisibility();
            },
            error: function (error) {
                console.log(error);
            },
        });
    }

    function handleDetailTempatVisibility() {
        // var selectedOption = $('#inputNamaTempat').val();
        var selectedOption = $("#inputNamaTempat").val();
        var detailTempatInput = $("#inputDetailTempat");

        if (selectedOption == "OF002") {
            $("#detailTempat").removeClass("d-none");
            detailTempatInput.prop("disabled", false);
        } else {
            $("#detailTempat").addClass("d-none");
            detailTempatInput.val("").prop("disabled", true);
        }
    }

    $("#inputPelaksanaan").change(function () {
        var selectedPelaksanaan = $(this).val();
        loadTempatOptions(selectedPelaksanaan);
    });

    $("#inputNamaTempat").change(function () {
        handleDetailTempatVisibility();
    });

    $("#jenisRapat").change(function () {
        var selectedJenisRapat = $(this).val();
        var idRapatBagian = "{{ $idRapatBagian }}";

        if (selectedJenisRapat == idRapatBagian) {
            $("#namaBagian").removeClass("d-none");
            $("#inputBagianName").prop("disabled", false);
        } else {
            $("#namaBagian").addClass("d-none");
            $("#inputBagianName").prop("disabled", true);
        }
    });

    // Initialize visibility based on the old input value
    var oldJenisRapat = "{{ old('jenis_rapat_id') }}";
    var idRapatBagian = "{{ $idRapatBagian }}";

    if (oldJenisRapat == idRapatBagian) {
        $("#namaBagian").removeClass("d-none");
        $("#inputBagianName").prop("disabled", false);
    } else {
        $("#namaBagian").addClass("d-none");
        $("#inputBagianName").prop("disabled", true);
    }
});

// atur toggle dosen dan list dosen
$("#switch-dosen").change(function () {
    bind_switch_dosen();
});

function bind_switch_dosen() {
    if ($("#switch-dosen").prop("checked")) {
        $("#div-multiple-select-dosen").show();
        load_select_dosen();
    } else {
        $("#multiple-select-dosen option:selected").remove();
        $("#div-multiple-select-dosen").hide();
    }
}

// Function to validate time
function validateTime(startTime, endTime) {
    let start = moment(startTime, "HH:mm");
    let end = moment(endTime, "HH:mm");

    // Check if end time is after start time and the duration is at least 15 minutes
    return end.isAfter(start) && end.diff(start, "minutes") >= 15;
}
