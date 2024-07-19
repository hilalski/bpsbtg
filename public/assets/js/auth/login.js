// Fungsi untuk mengecek validasi ketika formulir disubmit
$("form").submit(function (event) {
    // Mengambil nilai input NIP dan Password
    var nipValue = $("#inputNip").val();
    var passwordValue = $("#inputPassword").val();

    // Reset pesan kesalahan sebelumnya
    $(".invalid-feedback").empty();

    // Cek validasi NIP
    if (nipValue.trim() === "") {
        $("#inputNip").addClass("is-invalid");
        $("#input-inputNip").addClass("is-invalid");
        $("#inputNip-error").text("NIP harus diisi.");
        event.preventDefault(); // Mencegah formulir untuk disubmit
    } else {
        $("#inputNip").removeClass("is-invalid");
        $("#input-inputNip").removeClass("is-invalid");
    }

    // Cek validasi Password
    if (passwordValue.trim() === "") {
        $("#inputPassword").addClass("is-invalid");
        $("#input-inputPassword").addClass("is-invalid");
        $("#inputPassword-error").text("Password harus diisi.");
        event.preventDefault();
    } else {
        $("#inputPassword").removeClass("is-invalid");
        $("#input-inputPassword").removeClass("is-invalid");
    }
});

// Toggle Password Start
$(".togglePassword").click(function (e) {
    e.preventDefault();
    var icon = $(this).find("i");
    var type = $(this).parent().parent().find("#inputPassword").attr("type");

    if (type == "password") {
        icon.removeClass("bi-eye-fill");
        icon.addClass("bi-eye-slash-fill");
        $(this).parent().parent().find("#inputPassword").attr("type", "text");
    } else if (type == "text") {
        icon.removeClass("bi-eye-slash-fill");
        icon.addClass("bi-eye-fill");
        $(this)
            .parent()
            .parent()
            .find("#inputPassword")
            .attr("type", "password");
    }
});
// Toggle Password End
