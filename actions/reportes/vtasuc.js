function generar_reporte_3() {
    let sucursal = $('#sucreport').val();
    let fechai = $('#fechai').val();
    let fechaf = $('#fechaf').val();
    $.ajax({
        type: 'POST',
        url: 'php/reportes/sucvtas.php',
        data: 'sucursal=' + sucursal 
                + '&fechai=' + fechai + '&fechaf=' + fechaf,
        success:function(res) {
            $('#reporte_3').html(res);
        }
    });
}

$(document).ready(function () {
    $('#fechai').val(fecha_actual());
    $('#fechaf').val(fecha_actual());
});