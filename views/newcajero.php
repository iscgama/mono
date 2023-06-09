<?php

    require_once '../php/conexion.php';

    $nom_ca = '';
    $pin_ca = '';
    $id_s = '';

    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        $sql = "SELECT nom_ca, pin_ca, id_s 
                    FROM cajeros WHERE id_ca = " . $id;

        $res = $con->query($sql);
        $res->execute();

        foreach ($res as $a) {
            $nom_ca = $a['nom_ca'];
            $pin_ca = $a['pin_ca'];
            $id_s = $a['id_s'];
        }
    }

    $sql = "SELECT nom_s FROM sucursales";

    $res = $con->query($sql);
    $res->execute();

    $salida = '
            <h1 class="display-4">
            <i class="fas fa-feather-alt"></i> Registro
            </h1>
            <hr class="display-4">
            <div class="form-group">
                <label for="nombre">Nombre completo</label>
                <input type="text" id="nombre" class="form-control" value="' . $nom_ca . '" placeholder="Escribe el nombre completo del cajero">
            </div>   
            <div class="form-group">
                <label for="pin">PIN del cajero</label>
                <input type="number" id="pin" class="form-control" value="' . $pin_ca . '" placeholder="Escribe el PIN cajero para iniciar sesión">
            </div>   
            ';
    $salida .= '
            <div class="form-group">
                <label for="sucursales">Sucursal donde trabaja</label>
                <select class="form-control" id="sucursales">';
                $sql = "SELECT nom_s FROM sucursales";

                $res = $con->query($sql);
                $res->execute();
        
                foreach ($res as $a) {
                    $salida .= '<option>' . $a['nom_s'] . '</option>';
                }

    $salida .= '
    </select>
            </div>
            <br>
            <div class="alert alert-danger" role="alert" id="error" style="display: none;">
  
            </div>
            <br>
         ';

    if (isset($_POST['id'])) {
        $salida .= '
                    <button class="btn btn-outline-danger btn-block" onclick="editar_cajeros(' . $id . ')">
                        <i class="fas fa-hdd"></i> Actualizar datos
                    </button>
                    ';
    }else {
        $salida .= '
                    <button class="btn btn-outline-danger btn-block" id="gcajero">
                        <i class="fas fa-hdd"></i> Guardar datos
                    </button>
                    ';
    }
    echo $salida;

?>

<script src="actions/newcajero.js"></script>