// Fungsi untuk mengecek validasi ketika formulir disubmit
$("form").submit(function (event) {
    // Mengambil nilai input Email
    var emailValue = $("#inputEmail").val();

    // Reset pesan kesalahan sebelumnya
    $(".invalid-feedback").empty();

    // Cek validasi NIP
    if (emailValue.trim() === "") {
        $("#inputEmail").addClass("is-invalid");
        $("#input-inputEmail").addClass("is-invalid");
        $("#inputEmail-error").text("Email harus diisi.");
        event.preventDefault(); // Mencegah formulir untuk disubmit
    } else {
        $("#inputEmail").removeClass("is-invalid");
        $("#input-inputEmail").removeClass("is-invalid");
    }
});
