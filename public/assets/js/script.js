var fileInputs = document.querySelectorAll(".file-upload");
var removeButtons = document.querySelectorAll(".btn-danger");

fileInputs.forEach(function (input, index) {
    input.addEventListener("change", function () {
        handleFileChange(index);
    });
});

removeButtons.forEach(function (button, index) {
    button.addEventListener("click", function () {
        removeFile(index);
    });
});

function handleFileChange(index) {
    var inputFile = fileInputs[index];
    var removeButton = removeButtons[index];

    removeButton.style.display = "inline-block";
    inputFile.disabled = true;
}

function removeFile(index) {
    var inputFile = fileInputs[index];
    var removeButton = removeButtons[index];

    removeButton.style.display = "none";

    inputFile.value = "";
    inputFile.disabled = false;
}

// Tampilan dropdown details
$(document).ready(function () {
    let NamaUnit = $("#inputNamaUnit");
    let dokumenUnit = $("#dokumen-unit");
    let dokumenPPK = $("#dokumen-ppk");
    let dokumenPBJ = $("#dokumen-pbj");

    dokumenPPK.removeClass("d-none");

    NamaUnit.on("change", function () {
        let selectedRole = NamaUnit.val();

        if (selectedRole === "Unit") {
            dokumenUnit.removeClass("d-none");
            dokumenPPK.addClass("d-none");
            dokumenPBJ.addClass("d-none");
        } else if (selectedRole === "PPK") {
            dokumenPPK.removeClass("d-none");
            dokumenPBJ.addClass("d-none");
            dokumenUnit.addClass("d-none");
        } else if (selectedRole === "PBJ") {
            dokumenPBJ.removeClass("d-none");
            dokumenUnit.addClass("d-none");
            dokumenPPK.addClass("d-none");
        }
    });

    // Trigger change on load
    NamaUnit.val("Unit").trigger("change");
});

// document.querySelectorAll(".btn-upload").forEach((item) => {
//     item.addEventListener("click", (event) => {
//         let jenis = event.target.getAttribute("data-jenis");
//         let namaDokumen = event.target.getAttribute("data-nama-dokumen");
//         document.getElementById("jenisDokumen").value = jenis;
//         document.querySelector("#uploadFileModal .alert-heading").textContent =
//             namaDokumen;
//         document.querySelector("#editFileModal .alert-heading").textContent =
//             namaDokumen;
//     });
// });

let isRequestSent = false;
document
    .getElementById("confirmButton")
    .addEventListener("click", function (e) {
        e.preventDefault();
        if (!isRequestSent) {
            isRequestSent = true;
            var url = this.getAttribute("data-url");

            fetch(url, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                    "Content-Type": "application/x-www-form-urlencoded",
                },
            }).then((response) => {
                if (response.ok) {
                    location.reload();
                }
            });
        }
    });
document
    .getElementById("ppkConfirmButton")
    .addEventListener("click", function (e) {
        e.preventDefault();
        if (!isRequestSent) {
            isRequestSent = true;
            var url = this.getAttribute("data-url");

            fetch(url, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                    "Content-Type": "application/x-www-form-urlencoded",
                },
            }).then((response) => {
                if (response.ok) {
                    location.reload();
                }
            });
        }
    });
document
    .getElementById("pbjConfirmButton")
    .addEventListener("click", function (e) {
        e.preventDefault();
        if (!isRequestSent) {
            isRequestSent = true;
            var url = this.getAttribute("data-url");

            fetch(url, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                    "Content-Type": "application/x-www-form-urlencoded",
                },
            }).then((response) => {
                if (response.ok) {
                    location.reload();
                }
            });
        }
    });

function showRemoveButtonMemo() {
    var fileInputMemo = document.getElementById("formFileMemo");
    var removeButtonMemo = document.getElementById("removeButtonMemo");
    var fileErrorMessageMemo = document.getElementById("fileErrorMessageMemo");

    if (fileInputMemo.files.length > 0) {
        removeButtonMemo.style.display = "inline-block";
        fileErrorMessageMemo.innerHTML = "";
        fileInputMemo.setAttribute("disabled", true);
    } else {
        removeButtonMemo.style.display = "none";
        fileInputMemo.removeAttribute("disabled");
    }
}

function removeFileMemo() {
    var fileInputMemo = document.getElementById("formFileMemo");
    var removeButtonMemo = document.getElementById("removeButtonMemo");

    fileInputMemo.value = ""; // Clear the selected file
    removeButtonMemo.style.display = "none";
    fileInputMemo.removeAttribute("disabled");
}

function showRemoveButton() {
    var fileInput = document.getElementById("formFile");
    var removeButton = document.getElementById("removeButton");
    var fileErrorMessage = document.getElementById("fileErrorMessage");

    if (fileInput.files.length > 0) {
        removeButton.style.display = "inline-block";
        fileErrorMessage.innerHTML = "";
    } else {
        removeButton.style.display = "none";
    }
}

function removeFile() {
    var fileInput = document.getElementById("formFile");
    var removeButton = document.getElementById("removeButton");

    fileInput.value = ""; // Clear the selected file
    removeButton.style.display = "none";
}
