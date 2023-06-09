<?php

    require_once '../conexion.php';

    $sql = "SELECT name_u, id_u FROM usuarios WHERE id_u <> 1";
    $res = $con->query($sql);
    $res->execute();

    $salida = ' <br>
                <div class="container-fluid">
                    <h1 class="display-4">
                        <i class="fas fa-street-view"></i> Reportes de Ventas por Usuario
                    </h1>
                    <hr class="display-4">
                    <div class="form-group">
                        <label for="usuarios">Seleccionar usuario</label>
                        <input list="usuarios" id="userrpt" class="form-control" placeholder="Deje en blanco si desea el reporte de todos">
                        <datalist id="usuarios">';

                        foreach ($res as $a) {
                            $salida .= '<option value="' . $a['name_u'] . '"></option> ';
                        }

    $salida .=          '</datalist>    
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fechai">Fecha inicial</label>
                                <input type="date" id="fechai" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fechaf">Fecha final</label>
                                <input type="date" id="fechaf" class="form-control">
                            </div>
                        </div>
                    </div>
                    <br>
                    <button class="btn btn-outline-dark btn-block" onclick="generar_reporte()">
                        <i class="fal fa-file-chart-pie"></i> Generar reporte
                    </button>

                    <div id="reporte_1">
                    
                    </div>
                </div>

                <br><br><br><br>
              ';


    echo $salida;


?>

<script src="actions/reportes/vtasuser.js"></script>