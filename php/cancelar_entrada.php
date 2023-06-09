<?php

    require_once 'conexion.php';

    $compra = $_POST['compra'];

    $sql = "DELETE FROM entradas WHERE entradan_e = " . $compra;
    $res = $con->query($sql);
    $res->execute();


    $sql = "DELETE FROM entradas2 WHERE id_e = " . $compra;
    $res = $con->query($sql);
    $res->execute();

    $compra -= 1;

    $sql = "UPDATE consecutivos SET entradas_cs = " . $compra . " WHERE id_cs = 1";
    $res = $con->query($sql);
    $res->execute();

    echo 1;


?>