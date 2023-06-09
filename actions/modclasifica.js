function actualizar_clasif(id) {
    let desc = $('#desc').val();
        let idu = localStorage.getItem('idu');
        if (desc != '') {
            $.ajax({
                type: 'POST',
                url: 'php/modclasifica.php',
                data: 'desc=' + desc + '&anterior=' + id,
                success:function(res) {
                    if (res == 1) {
                        $('#mensaje').html('Se ha actualizo con exito');
                        $('#contenido').load('views/clasificaciones.html');
                    }else {
                        mostrar_error(res);
                    }
                }
            });
        }else {
            mostrar_error('Debes introducir un nombre valido')
        }
}


$(document).ready(function () {
    $('#ventana').on('shown.bs.modal', function () {
        $('#desc').focus();
    });
});