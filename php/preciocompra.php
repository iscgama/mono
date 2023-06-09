<?php


    require_once 'conexion.php';

    $precio = $_POST['precio'];
    $renglon = $_POST['renglon'];


    //$cantidad = $precio * $cantidad;

    $sql = "UPDATE compras2 SET costo_com = " . $precio . "
                    WHERE idc_com = " . $renglon;
    $res = $con->query($sql);
    $res->execute();

    echo 1;

?>
