function imprimir_devolucion(id) {
    var printdata = "id=" + id;
    $.get('tickets/devolucionticket.php', printdata, function(){
            window.open("tickets/devolucionticket.php?id=" + id); 
      });
}


function cambiar_cantidad(id) {
    let ident = id;
    let cantidad = $('#' + id).val();
    cantidad = parseFloat(cantidad);
    ident = ident.substr(1, 2);
    let vendido = $('#v' + ident).html();
    if (cantidad <= vendido && cantidad >= 0) {
        total = vendido - cantidad;
        //$('#d' + ident).val(total);
    }else {
        $('#c' + ident).val("0");
        mostrar_error('Cantidad inválida');
    }
}


function aplicar_devolucion(id) {
    let contadev = localStorage.getItem('contadev');
    contadev++;
    localStorage.setItem('contadev', contadev);
    let sucursal = localStorage.getItem('sucursal');
    let ident = id;
    let vendido = $('#v' + ident).html();
    let cantidad = $('#c' + ident).val();
    let actualizar = parseFloat(vendido) - parseFloat(cantidad);
    let renglon = $('#c' + ident).attr('name');
    let articulo = $('#a' + ident).html();
    let idu = localStorage.getItem('idu');

    $.ajax({
        type: 'POST',
        url: 'php/devolver_reng.php',
        data: 'renglon=' + renglon + '&actualizar=' + actualizar
                + '&articulo=' + articulo + '&sucursal=' + sucursal
                + '&cantidad=' + cantidad + '&idu=' + idu,
        success: function(res) {
            $('#v' + ident).html(actualizar);
            $('#c' + ident).val('');
            $('#' + ident).html('<i class="fas fa-check"></i>');
        }
    });
}


$(document).ready(function () {
    localStorage.setItem('contadev', 0);


    $('#gdevolvervta').on('click', function() {
        let contadev = localStorage.getItem('contadev');
        let id = $('#venta').val();
        if (contadev > 0) {
            localStorage.removeItem('contadev');
            imprimir_devolucion(id)
        }else {
            mostrar_error('No se ha devuelto ningún elemento');
        }
    });


        
});