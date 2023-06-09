function actualizar_socios(id) {
    
    var nombre = $('#nombre').val();
    var dir = $('#dir').val();
    var telefono = $('#telefono').val();
    var colonia = $('#colonia').val();
    var cp = $('#cp').val();
    var ciudad = $('#ciudad').val();
    var razon = $('#razon').val();
    var estado = $('#estado').val();
    var fecha = $('#fecha').val();
    var rfc = $('#rfc').val();
    var correo = $('#correo').val();
    var nuevo = ($('#nuevos').prop('checked')) ? 1 : 0;
    
    
    

    if (nombre != '') {
        $.ajax({
            type: 'POST',
            url: 'php/modsocio.php',
            data: 'nombre=' + nombre + '&dir=' + dir + '&telefono=' + telefono
            + '&colonia=' + colonia + '&cp=' + cp + '&ciudad=' + ciudad + '&id=' + id
            + '&razon=' + razon + '&estado=' + estado + '&fecha=' 
            + fecha + '&rfc=' + rfc + '&correo=' + correo + '&nuevo=' + nuevo,
            success:function(res) {
                $('#mensaje').html('se ha acualizado con éxito');
                $('#contenido').load('views/socios.html');
            }
        })
    }else {
        mostrar_error('Debes introducir el nombre y una dirección para continuar');
    }
}

$(document).ready(function() {
    $('#ventana').on('shown.bs.modal', function () {
		$('#nombre').focus();
	});
    
});