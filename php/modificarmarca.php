<?php


    require_once 'conexion.php';

    $desc = $_POST['desc'];
    $anterior = $_POST['anterior'];

    $sql = "SELECT id_m FROM marcas WHERE desc_m = '" . $desc . "' AND id_m <> " . $anterior;
    $res = $con->query($sql);
    $res->execute();

    $idm = 0;

    foreach ($res as $a) {
        $idm = $a['id_m'];
    }

    if ($idm == 0) {
        $sql = "UPDATE marcas SET desc_m = '" . $desc . "' WHERE id_m = " . $anterior;
        $res = $con->query($sql);
        $res->execute();

        echo 1;
    }else {
        echo 'Ya existe una marca con ese nombre, intenta de nuevo con otro';
    }

?>