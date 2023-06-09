function mostrar_inv() {
    let sucursal = $('#sucursales').val();
    $.ajax({
        type: 'POST',
        url: 'php/reportes/inventariosucursal.php',
        data: 'sucursal=' + sucursal,
        success:function(res) {
            $('#listaexistencias').html(res);
        }
    });
}

$(document).ready(function () {
    
});