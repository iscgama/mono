<?php


    require_once 'conexion.php';

    $desc = $_POST['desc'];
    $anterior = $_POST['anterior'];

    $sql = "SELECT id_c FROM clasificacion WHERE desc_c = '" . $desc . "' AND id_c <> " . $anterior;
    $res = $con->query($sql);
    $res->execute();

    $idc = 0;

    foreach ($res as $a) {
        $idc = $a['id_c'];
    }

    if ($idc == 0) {
        $sql = "UPDATE clasificacion SET desc_c = '" . $desc . "' WHERE id_c = " . $anterior;
        $res = $con->query($sql);
        $res->execute();

        echo 1;
    }else {
        echo 'Ya existe una clasificación con ese nombre, intenta de nuevo con otro';
    }

?>