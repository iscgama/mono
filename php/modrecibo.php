<?php


    require_once 'conexion.php';

    $id = $_POST['id'];

    $sql = "SELECT nombre_re, fecha_re, monto_re, concepto_re FROM recibos WHERE id_re = " . $id;

    $res = $con->query($sql);
    $res->execute();

    foreach ($res as $a) {
        $nombre_re = $a['nombre_re'];
        //$fecha_re = $a['fecha_re'];
        $monto_re = $a['monto_re'];
        $concepto_re = $a['concepto_re'];
    }


    $salida = '
                <h1 class="display-4">
                <i class="fas fa-feather-alt"></i> Modificar recibo
                </h1>
                <hr class="display-4">
                <div class="form-group">
                    <label for="nombre">Nombre completo</label>
                    <input type="text" id="nombre" class="form-control" value="' . $nombre_re . '"
                             placeholder="Escribe el nombre completo del cliente">
                </div>   
                <div class="form-group">
                    <label for="concepto">Concepto</label>
                    <input type="text" id="concepto" class="form-control" value="' . $concepto_re . '"
                            placeholder="Escribe el concepto del recibo">
                </div>   
                <div class="form-group">
                    <label for="monto">Monto</label>
                    <input type="number" id="monto" class="form-control" value="' . $monto_re . '"
                                placeholder="0.00">
                </div>   
                <br>
                <div id="error" class="alert alert-danger" style="display: none;" role="alert">
                </div>
                <br>
                <button class="btn btn-outline-dark btn-block" onclick="modificar_recibo(' . $id . ');">
                    <i class="fas fa-save"></i> Generar recibo
                </button>';

    echo $salida;

?>