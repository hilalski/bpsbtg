// Fungsi untuk mengecek validasi ketika formulir disubmit
$("form").submit(function (event) {
    // Mengambil nilai input untuk password lama, password baru, dan konfirmasi password baru
    var newPasswordValue = $("#inputNewPassword").val();
    var confirmNewPasswordValue = $("#inputConfirmNewPassword").val();

    // Reset pesan kesalahan sebelumnya
    $(".invalid-feedback").empty();

    // Cek validasi Password Baru
    if (newPasswordValue.trim() === "") {
        $("#inputNewPassword").addClass("is-invalid");
        $("#input-inputNewPassword").addClass("is-invalid");
        $("#inputNewPassword-error").text("Password baru harus diisi.");
        event.preventDefault();
    } else {
        $("#inputNewPassword").removeClass("is-invalid");
        $("#input-inputNewPassword").removeClass("is-invalid");
    }

    // Cek validasi Konfirmasi Password Baru
    if (confirmNewPasswordValue.trim() === "") {
        $("#inputConfirmNewPassword").addClass("is-invalid");
        $("#input-inputConfirmNewPassword").addClass("is-invalid");
        $("#inputConfirmNewPassword-error").text(
            "Konfirmasi password baru harus diisi."
        );
        event.preventDefault();
    } else if (newPasswordValue !== confirmNewPasswordValue) {
        $("#inputConfirmNewPassword").addClass("is-invalid");
        $("#input-inputConfirmNewPassword").addClass("is-invalid");
        $("#inputConfirmNewPassword-error").text(
            "Konfirmasi password tidak cocok."
        );
        event.preventDefault();
    } else {
        $("#inputConfirmNewPassword").removeClass("is-invalid");
        $("#input-inputConfirmNewPassword").removeClass("is-invalid");
    }
});

// Toggle Password Start
$(".togglePassword-1").click(function (e) {
    e.preventDefault();
    var icon = $(this).find("i");
    var type = $(this).parent().parent().find("#inputNewPassword").attr("type");

    if (type == "password") {
        icon.removeClass("bi-eye-fill");
        icon.addClass("bi-eye-slash-fill");
        $(this)
            .parent()
            .parent()
            .find("#inputNewPassword")
            .attr("type", "text");
    } else if (type == "text") {
        icon.removeClass("bi-eye-slash-fill");
        icon.addClass("bi-eye-fill");
        $(this)
            .parent()
            .parent()
            .find("#inputNewPassword")
            .attr("type", "password");
    }
});

$(".togglePassword-2").click(function (e) {
    e.preventDefault();
    var icon = $(this).find("i");
    var type = $(this)
        .parent()
        .parent()
        .find("#inputConfirmNewPassword")
        .attr("type");

    if (type == "password") {
        icon.removeClass("bi-eye-fill");
        icon.addClass("bi-eye-slash-fill");
        $(this)
            .parent()
            .parent()
            .find("#inputConfirmNewPassword")
            .attr("type", "text");
    } else if (type == "text") {
        icon.removeClass("bi-eye-slash-fill");
        icon.addClass("bi-eye-fill");
        $(this)
            .parent()
            .parent()
            .find("#inputConfirmNewPassword")
            .attr("type", "password");
    }
});
// Toggle Password End
