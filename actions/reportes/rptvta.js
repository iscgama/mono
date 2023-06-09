$(document).ready(function () {
    $('#rptvtauser').on('click', function() {
        $('#contenido').load('php/reportes/vtasuser.php');
    });

    $('#rptvtafecha').on('click', function() {
        $('#contenido').load('php/reportes/vtasfecha.html');
    });

    $('#rptvtasuc').on('click', function() {
        $('#contenido').load('php/reportes/vtassuc.php');
    });
});