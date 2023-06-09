<?php

    require_once '../conexion.php';

    $sql = "SELECT nom_s, id_s FROM sucursales";
    $res = $con->query($sql);
    $res->execute();

    $salida = ' <br>
                <div class="container-fluid">
                    <h1 class="display-4">
                        <i class="fas fa-store-alt"></i> Reportes de Ventas por Sucursal
                    </h1>
                    <hr class="display-4">
                    <div class="form-group">
                        <label for="sucursales">Seleccionar sucursal</label>
                        <input list="sucursales" id="sucreport" class="form-control" placeholder="Deje en blanco si desea el reporte de todos">
                        <datalist id="sucursales">';

                        foreach ($res as $a) {
                            $salida .= '<option value="' . $a['nom_s'] . '"></option> ';
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
                    <button class="btn btn-outline-dark btn-block" onclick="generar_reporte_3()">
                        <i class="fal fa-file-chart-pie"></i> Generar reporte
                    </button>

                    <div id="reporte_3">
                    
                    </div>
                </div>

                <br><br><br><br>
              ';


    echo $salida;


?>

<script src="actions/reportes/vtasuc.js"></script>