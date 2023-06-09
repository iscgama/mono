function generar_reporte() {
    let usuario = $('#userrpt').val();
    let fechai = $('#fechai').val();
    let fechaf = $('#fechaf').val();
    $.ajax({
        type: 'POST',
        url: 'php/reportes/uservtas.php',
        data: 'usuario=' + usuario 
                + '&fechai=' + fechai + '&fechaf=' + fechaf,
        success:function(res) {
            $('#reporte_1').html(res);
        }
    });
}

$(document).ready(function () {
    $('#fechai').val(fecha_actual());
    $('#fechaf').val(fecha_actual());
});