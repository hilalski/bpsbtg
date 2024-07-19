window.onload = function () {
    var loaderContainer = document.getElementById("loader-container");

    loaderContainer.classList.add("fadeOut");

    // Tambahkan kelas fadeOut setelah window diload
    loaderContainer.classList.add("fadeOut");

    // Event listener untuk menyembunyikan loader setelah animasi fade out
    loaderContainer.addEventListener("animationend", function () {
        loaderContainer.style.display = "none";
    });
};
