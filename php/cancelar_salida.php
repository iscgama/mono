<?php

    require_once 'conexion.php';

    $compra = $_POST['compra'];

    $sql = "DELETE FROM salidas WHERE salidan_s = " . $compra;
    $res = $con->query($sql);
    $res->execute();


    $sql = "DELETE FROM salidas2 WHERE id_s = " . $compra;
    $res = $con->query($sql);
    $res->execute();

    $compra -= 1;

    $sql = "UPDATE consecutivos SET salidas_cs = " . $compra . " WHERE id_cs = 1";
    $res = $con->query($sql);
    $res->execute();

    echo 1;


?>