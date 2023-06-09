<?php

    require_once '../conexion.php';

    $sucursal = $_POST['sucursal'];
    $numtras = $_POST['numtras'];

    //Consultamos el ID de la sucursal seleccionada
    $sql = "SELECT id_s FROM sucursales WHERE nom_s = '" . $sucursal . "'";
    $res = $con->query($sql);
    $res->execute();

    $ids = 0;

    foreach ($res as $a) {
        $ids = $a['id_s'];
    }

    if ($ids != 0) {
        $sql = "UPDATE traspasos SET id_s = " . $ids . " WHERE traspason_tr = " . $numtras;
        $res = $con->query($sql);
        $res->execute();

        echo 1;
    }else {
        echo 'La sucursal seleccionada no existe, intenta con otro nombre';
    }

?>