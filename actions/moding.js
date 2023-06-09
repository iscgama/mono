function actualizar_datos(ide) {
    
    var fecha = $('#fecha').val();
    var concepto = $('#concepto').val();
    var monto = $('#monto').val();
    var socio = $('#socio').val();
    var tipo = 'I';

    if (concepto != '' && monto != '') {
        $.ajax({
            type: 'POST',
            url: 'php/moding.php',
            data: 'usuario=' + id + '&fecha=' + fecha + '&concepto=' 
                        + concepto + '&monto=' + monto + '&tipo=' + tipo
                        + '&socio=' + socio + '&id=' + ide,
            success:function(res) {
                $('#mensaje').html(res);
                $('#contenido').load('views/inicio.html');
            }
        })
    }else {
        mostrar_error('Debes introducir el concepto y el monto');
    }
}

$(document).ready(function() {

    $('#fecha').val(fecha_actual());
    


    
});