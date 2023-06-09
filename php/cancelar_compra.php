<?php

    require_once 'conexion.php';
    $compra = $_POST['compra'];
    $sucursal = $_POST['sucursal'];
    $idu = $_POST['idu'];


    

    $sql = "DELETE FROM compras WHERE compran_com = " . $compra;
    $res = $con->query($sql);
    $res->execute();


    $sql = "DELETE FROM compras2 WHERE id_com = " . $compra;
    $res = $con->query($sql);
    $res->execute();

    $compra -= 1;

    $sql = "UPDATE consecutivos SET compras_cs = " . $compra . " WHERE id_cs = 1";
    $res = $con->query($sql);
    $res->execute();

    echo 1;

 
?>