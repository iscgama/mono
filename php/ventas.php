<?php


    require_once 'conexion.php';

    $salida = '
                <br>
                <div class="container-fluid" id="main-ventas">
                    <h1 class="title">
                        <i class="fa-solid fa-coins"></i> Ventas Generales
                    </h1>
                    <hr class="display-4">
                    <br>
                    <div class="form-group">
                        <label for="fecha">Fecha de ventas</label>
                        <input type="date" class="form-control" id="fechavta">
                    </div>
                    <br>
                    <button class="btn btn-outline-dark btn-block" id="generarvtas">
                        <i class="fas fa-sync"></i> Actualizar
                    </button>
                    <br>
                    <div id="listventas">

                    </div>
                </div>
                ';


    echo $salida;

?>

<script>

    function cargar_ventas(fecha) {
        let sucursal = localStorage.getItem('sucursal');
        if (sucursal == 0) {
            $('#main-ventas').html('<br><div class="container-fluid"><h1><i class="fa-duotone fa-circle-exclamation"></i> Aviso importante!</h1><br><p>El usuario administrador (admin) no pertenece a ninguna sucursal, pero puede revisar las ventas a través del menú <i class="fa-duotone fa-chart-column"></i> <b>Reporte</b> -> <i class="fa-duotone fa-coins"></i> <b>Ventas</b></p></div>');
        }else {
            $('#listventas').html('<div class="spinner-grow text-success" role="status"><span class="sr-only">Loading...</span></div>');
            $.ajax({
                type: 'POST',
                data: 'fecha=' + fecha + '&sucursal=' + sucursal,
                url: 'php/listadovtas.php',
                success:function(res) {
                    $('#listventas').html(res);
                }
            })
        }
    }

    $(document).ready(function () {
        $('#fechavta').val(fecha_actual());

        cargar_ventas(fecha_actual());

        $('#generarvtas').on('click', function() {
            let fecha = $('#fechavta').val();
            cargar_ventas(fecha);
        })
       
    });
</script>