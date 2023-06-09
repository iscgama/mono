<?php


    require_once 'conexion.php';

    $cantidad = $_POST['cantidad'];
    $renglon = $_POST['renglon'];
    $modo = $_POST['modo'];


    $sql = "SELECT costo_com FROM compras2 WHERE idc_com = " . $renglon;
    $res = $con->query($sql);
    $res->execute();

    $sub = 0;

    foreach ($res as $a) {
        $sub = $a['costo_com'];
    }

    $sub = $cantidad * $sub;

    $sql = "UPDATE compras2 SET cant_com = " . $cantidad . "
                    WHERE idc_com = " . $renglon;
    $res = $con->query($sql);
    $res->execute();

    echo 1;

?>
