// Fungsi untuk mengecek validasi ketika formulir disubmit
$("#formChangePassword").submit(function (event) {
    // Mengambil nilai input untuk password lama, password baru, dan konfirmasi password baru
    var oldPasswordValue = $("#inputOldPassword").val();
    var newPasswordValue = $("#inputNewPassword").val();
    var confirmNewPasswordValue = $("#inputConfirmNewPassword").val();

    // Reset pesan kesalahan sebelumnya
    $(".invalid-feedback").empty();

    // Cek validasi Password Lama
    if (oldPasswordValue.trim() === "") {
        $("#inputOldPassword").addClass("is-invalid");
        $("#old-password-error").text("Password lama harus diisi.");
        event.preventDefault(); // Mencegah formulir untuk disubmit
    } else {
        $("#inputOldPassword").removeClass("is-invalid");
    }

    // Cek validasi Password Baru
    if (newPasswordValue.trim() === "") {
        $("#inputNewPassword").addClass("is-invalid");
        $("#new-password-error").text("Password baru harus diisi.");
        event.preventDefault();
    } else {
        $("#inputNewPassword").removeClass("is-invalid");
    }

    // Cek validasi Konfirmasi Password Baru
    if (confirmNewPasswordValue.trim() === "") {
        $("#inputConfirmNewPassword").addClass("is-invalid");
        $("#confirm-new-password-error").text(
            "Konfirmasi password baru harus diisi."
        );
        event.preventDefault();
    } else if (newPasswordValue !== confirmNewPasswordValue) {
        $("#inputConfirmNewPassword").addClass("is-invalid");
        $("#confirm-new-password-error").text(
            "Konfirmasi password tidak cocok."
        );
        event.preventDefault();
    } else {
        $("#inputConfirmNewPassword").removeClass("is-invalid");
    }
});

// Toggle Password Start
$(".togglePassword-1").click(function (e) {
    e.preventDefault();
    var icon = $(this).find("i");
    var type = $(this).parent().parent().find("#inputOldPassword").attr("type");

    if (type == "password") {
        icon.removeClass("bi-eye-fill");
        icon.addClass("bi-eye-slash-fill");
        $(this)
            .parent()
            .parent()
            .find("#inputOldPassword")
            .attr("type", "text");
    } else if (type == "text") {
        icon.removeClass("bi-eye-slash-fill");
        icon.addClass("bi-eye-fill");
        $(this)
            .parent()
            .parent()
            .find("#inputOldPassword")
            .attr("type", "password");
    }
});

$(".togglePassword-2").click(function (e) {
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

$(".togglePassword-3").click(function (e) {
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
