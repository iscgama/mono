function send_data(id, granel) {
    let cantidad = $('#canvta').val();
    if (cantidad != '' && !isNaN(cantidad)) {
        $.ajax({
            type: 'POST',
            url: 'php/cantrengventa.php',
            data: 'cantidad=' + cantidad + '&id=' + id + '&granel=' + granel,
            success:function(res) {
                $('#ventana').modal('toggle');
                detalle_vta();
            }
        });
    }else {
        mostrar_error('Debes capturar una cantidad valida');
    }
}

function tecla (e, id, granel, valor) {
    if (e.keyCode == 13 && valor != 0) {
        send_data(id, granel);
    }
}


$(document).ready(function () {
    $('#ventana').on('shown.bs.modal', function () {
        $('#canvta').select();
        $('#canvta').focus();
    });

    $('#pricevta').on('keyup', function(e) {
        let price = $(this).val();
        let precio = $('#precio').val();
        if (price != '') {
            precio = price / precio;
            precio = precio.toFixed(2);
            $('#canvta').val(precio);
        }
    });

    $('#canvta').on('keypress', function(e) {
    
    });

});