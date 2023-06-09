$(document).ready(function () {
    $('#ventana').on('shown.bs.modal', function () {
        $('#nombre').focus();
    });

    $('#rusuario').on('click', function() {
        let anterior = $('#rusuario').attr('name');
        let nombre = $('#nombre').val();
        let usuario = $('#usuario').val();
        let pass = $('#pass').val();
        let roles = $('#roles').val();
        let sucursales = $('#sucursales').val();


        if(nombre != '' && usuario != '' && pass != '' && roles != '' && sucursales != '') {
            $.ajax({
                type: 'POST',
                url: 'php/refuser.php',
                data: 'nombre=' + nombre + '&usuario=' + usuario + '&pass=' + pass 
                        + '&roles=' + roles + '&sucursales=' + sucursales
                        + '&anterior=' + anterior,
                success: function(res) {
                    if (res == 1) {
                        $('#mensaje').html('Se ha actualizado con éxito');
                        $('#contenido').load('views/usuarios.html');
                    }else {
                        mostrar_error(res);
                    }
                }
            })
        }else {
            mostrar_error('Debes llenar todo el formulario completo para registrar a un usuario');
        }
    });
}); 