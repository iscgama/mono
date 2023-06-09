<?php


    require_once 'conexion.php';

    $cantidad = $_POST['cantidad'];
    $renglon = $_POST['renglon'];
    $modo = $_POST['modo'];


    $sql = "SELECT costo_e FROM entradas2 WHERE idc_e = " . $renglon;
    $res = $con->query($sql);
    $res->execute();

    $sub = 0;

    foreach ($res as $a) {
        $sub = $a['costo_e'];
    }

    $sub = $cantidad * $sub;

    $sql = "UPDATE entradas2 SET cant_e = " . $cantidad . "
                    WHERE idc_e = " . $renglon;
    $res = $con->query($sql);
    $res->execute();

    echo 1;

?>
