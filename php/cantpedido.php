<?php


    require_once 'conexion.php';

    $cantidad = $_POST['cantidad'];
    $renglon = $_POST['renglon'];
    $modo = $_POST['modo'];


    $sql = "SELECT costo_ped FROM pedidos2 WHERE idc_ped = " . $renglon;
    $res = $con->query($sql);
    $res->execute();

    $sub = 0;

    foreach ($res as $a) {
        $sub = $a['costo_ped'];
    }

    $sub = $cantidad * $sub;

    $sql = "UPDATE pedidos2 SET cant_ped = " . $cantidad . "
                    WHERE idc_ped = " . $renglon;
    $res = $con->query($sql);
    $res->execute();

    echo 1;

?>
