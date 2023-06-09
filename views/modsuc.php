<?php

    require_once '../php/conexion.php';

    $id = $_POST['id'];

    $sql = "SELECT nom_s, dir_s, tel_s, cp_s, ciudad_s, estado_s
         FROM sucursales WHERE id_s = " . $id;

    $res = $con->query($sql);
    $res->execute();


    foreach ($res as $a) {
        $nom_s = $a['nom_s'];
        $dir_s = $a['dir_s'];
        $tel_s = $a['tel_s'];
        $cp_s = $a['cp_s'];
        $ciudad_s = $a['ciudad_s'];
        $estado_s = $a['estado_s'];
    }

    $salida = '
                <h1 class="display-4">
                <i class="fas fa-feather-alt"></i> Actualizar
                </h1>
                <hr class="display-4">
                <div class="form-group">
                    <label for="sucursal">Nombre de la Sucursal</label>
                    <input type="text" id="sucursal" class="form-control"
                    value = "' . $nom_s . '" placeholder="Escribe el nombre de la sucursal">
                </div>   
                <div class="form-group">
                    <label for="direccion">Dirección de la sucursal</label>
                    <input type="text" id="direccion" class="form-control"
                    value = "' . $dir_s . '" placeholder="Escribe la direccion de la sucursal">
                </div>   
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="tel" id="telefono" class="form-control"
                    value = "' . $tel_s . '" placeholder="Escribe la telefono de la sucursal">
                </div>   
                <div class="form-group">
                    <label for="cp">Código Postal</label>
                    <input type="text" id="cp" class="form-control"
                    value = "' . $cp_s . '" placeholder="Escribe la poblacion de la sucursal">
                </div>   
                <div class="form-group">
                    <label for="ciudad">Ciudad de la sucursal</label>
                    <input type="text" id="ciudad" class="form-control"
                    value = "' . $ciudad_s . '" placeholder="Escribe la ciudad de la sucursal">
                </div>
                <div class="form-group">
                    <label for="estado">Estado de la sucursal</label>
                    <input type="text" id="estado" class="form-control"
                    value = "' . $estado_s . '" placeholder="Escribe el estado de la sucursal">
                </div>
                <br>
                <div class="alert alert-danger" role="alert" id="error" style="display: none;">

                </div>
                <br>
                <button class="btn btn-outline-danger btn-block" onclick="guardar_sucursal(1, ' . $id . ')">
                    <i class="fas fa-hdd"></i> Guardar datos
                </button>
                    ';

    echo $salida;

?>

<script src="actions/newsuc.js"></script>