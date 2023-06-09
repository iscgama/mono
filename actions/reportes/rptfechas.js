function generar_reporte2() {
    let fechai = $('#fechai').val();
    let fechaf = $('#fechaf').val();
    let sucursal = localStorage.getItem('sucursal');

    $.ajax({
        type: 'POST',
        url: 'php/reportes/datevtas.php',
        data: 'fechai=' + fechai + '&fechaf=' + fechaf
                + '&sucursal=' + sucursal,
        success:function(res) {
            $('#reporte_2').html(res);
        }
    });
}

$(document).ready(function () {
    $('#fechai').val(fecha_actual());
    $('#fechaf').val(fecha_actual());
});