//Funciones para socios

function modificar_socio(id) {
    $.ajax({
        type: 'POST',
        url: 'php/consultasocio.php',
        data: 'id=' + id,
        success:function(res) {
            $('#mensaje').html(res);
	        $('#ventana').modal('toggle');
        }
    });
}

$(document).ready(function() {

    $.ajax({
        type: 'POST',
        url: 'php/socios.php',
        success:function(res) {
            $('#listasocios').html(res);
        }
    });

    $('#socionew').on('click', function() {
        $('#mensaje').load('views/newsocio.html');
	    $('#ventana').modal('toggle');
    });

    $('#viewsocios').on('click', function() {
        window.open("tickets/socios.php");
    });

});