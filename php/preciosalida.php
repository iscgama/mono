<?php


    require_once 'conexion.php';

    $precio = $_POST['precio'];
    $renglon = $_POST['renglon'];


    //$cantidad = $precio * $cantidad;

    $sql = "UPDATE salidas2 SET costo_sa = " . $precio . "
                    WHERE idc_sa = " . $renglon;
    $res = $con->query($sql);
    $res->execute();

    echo 1;

?>
