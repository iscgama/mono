<?php

    require_once '../../../php/conexion.php';

    $salida = '
            <br>
            <div class="container-fluid">
                <h1>
                    <i class="fa-duotone fa-layer-group"></i> Reporte Articulos por Clasificación
                </h1>
                <hr class="display-4">
                <br>
                <p class="text-muted">
                    Selecciona la clasificación a imprimir
                </p>
                <div class="form-group">
                    <label for="clasif">Clasificaciones</label>
                    <select class="form-control" id="clasif">
                    ';

                    $sql = "SELECT desc_c FROM clasificacion";
                    $res = $con->query($sql);
                    $res->execute();

                    foreach ($res as $a) {
                        $salida .= '<option>' . $a['desc_c'] .  '</option>';
                    }
    $salida .= '
                    </select>
                </div>
                <br>
                <button class="btn btn-info btn-block btn-lg" id="impclasif">
                    <i class="fa-duotone fa-print-magnifying-glass"></i> Imprimir reporte
                </button>
                
            </div>
            ';

    echo $salida;
?>

<script src="actions/reportes/actinventory.js"></script>