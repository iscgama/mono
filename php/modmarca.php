<?php


    require_once 'conexion.php';

    $id = $_POST['id'];

    $sql = "SELECT desc_m FROM marcas WHERE id_m = " . $id;
    $res = $con->query($sql);
    $res->execute();

    foreach ($res as $a) {
        $desc_c = $a['desc_m'];
    }
    
    $salida = '
                <h1 class="display-4">
                    <i class="fas fa-feather-alt"></i> Actualizar
                </h1>
                <hr class="display-4">
                <div class="form-group">
                    <label for="desc">Descripción de la marca</label>
                    <input type="text" id="desc" value="' . $desc_c . '" class="form-control">
                </div>
                <br>
                <div class="alert alert-danger" role="alert" id="error" style="display: none;">

                </div>
                <br>
                <button class="btn btn-outline-danger btn-block" id="' . $id . '"
                        onclick="actualizar_marca(this.id)">
                    <i class="fas fa-hdd"></i> Actualizar datos
                </button>
              ';

    echo $salida;

?>

<script src="actions/modmarca.js"></script>
