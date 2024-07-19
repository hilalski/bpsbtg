// File script.js
$(document).ready(function() {
    $('#jenisRapat').change(function() {
        var pilihan = $(this).val();
        if (pilihan === 'riset') {
            $('#risetFields').show();
            $('#bidangFields').hide();
        } else if (pilihan === 'bidang') {
            $('#risetFields').hide();
            $('#bidangFields').show();
        } else {
            $('#risetFields').hide();
            $('#bidangFields').hide();
        }
    });
});
