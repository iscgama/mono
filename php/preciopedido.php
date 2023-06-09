<?php


    require_once 'conexion.php';

    $precio = $_POST['precio'];
    $renglon = $_POST['renglon'];


    //$cantidad = $precio * $cantidad;

    $sql = "UPDATE pedidos2 SET costo_ped = " . $precio . "
                    WHERE idc_ped = " . $renglon;
    $res = $con->query($sql);
    $res->execute();

    echo 1;

?>
