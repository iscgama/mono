function guardar_datos(id, operacion) {
    let nombre = $('#nombre').val();
    let pin = $('#pin').val();
    let sucursales = $('#sucursales').val();

    if (nombre != '' && pin != '') {
        if (pin.length == 4) {
            $.ajax({
                type: 'POST',
                url: 'php/regcajero.php',
                data: 'nombre=' + nombre + '&pin=' + pin + '&sucursales=' + sucursales
                        + '&operacion=' + operacion + '&anterior=' + id,
                success: function(res) {
                    if (res == 1) {
                        $('#mensaje').html('Se ha registrado con éxito');
                        $('#contenido').load('views/cajeros.html');
                    }else {
                        mostrar_error(res);
                    }
                }
            });
        }else {
            mostrar_error('El PIN a introducir debe ser máximo de 4 números');
            $('#pin').val('');
        }
    }else {
        mostrar_error('Debes capturar los tres campos antes de continuar');
    }
}

function editar_cajeros(id) {
    guardar_datos(id, 1);
}


$(document).ready(function () {
    $('#ventana').on('shown.bs.modal', function () {
        $('#nombre').focus();
    });

    $('#gcajero').on('click', function() {
        guardar_datos(0, 0);
    });
});