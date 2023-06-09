<?php

    require_once '../conexion.php';

    $sql = "SELECT nom_s FROM sucursales";
    $res = $con->query($sql);
    $res->execute();

    $salida = '<br>
                <div class="container-fluid">
                
                    <h1 class="display-4">
                        Reporte de existencias por sucursal
                    </h1>
                    <hr class="display">
                    <div class="form-group">
                        <label for="sucursales">Selecciona una sucursal</label>
                        <select  id="sucursales" class="form-control">';
                    foreach ($res as $a) {
                        $salida .= '<option>' . $a['nom_s'] . '</option> ';
                    }
     $salida .= '   </select>
                  </div>
                  <br>
                  <button class="btn btn-outline-dark btn-block" onclick="mostrar_inv();">
                    Generar reporte
                  </button>
                  <br>
                  <div id="listaexistencias">
                  
                  </div>
                  <br><br><br><br>
                </div>
            ';
  echo $salida;


?>

<script src="actions/invgral.js"></script>