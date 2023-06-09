<?php


    require_once 'conexion.php';

    $cantidad = $_POST['cantidad'];
    $renglon = $_POST['renglon'];
    $modo = $_POST['modo'];


    $sql = "SELECT costo_sa FROM salidas2 WHERE idc_sa = " . $renglon;
    $res = $con->query($sql);
    $res->execute();

    $sub = 0;

    foreach ($res as $a) {
        $sub = $a['costo_sa'];
    }

    $sub = $cantidad * $sub;

    $sql = "UPDATE salidas2 SET cant_sa = " . $cantidad . "
                    WHERE idc_sa = " . $renglon;
    $res = $con->query($sql);
    $res->execute();

    echo 1;

?>
