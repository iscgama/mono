<?php


    require_once 'conexion.php';

    $precio = $_POST['precio'];
    $renglon = $_POST['renglon'];


    //$cantidad = $precio * $cantidad;

    $sql = "UPDATE entradas2 SET costo_e = " . $precio . "
                    WHERE idc_e = " . $renglon;
    $res = $con->query($sql);
    $res->execute();

    echo 1;

?>
