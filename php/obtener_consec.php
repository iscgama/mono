<?php

    require_once 'conexion.php';



    $sql = "SELECT compras_cs FROM consecutivos WHERE id_cs = 1";
    $res = $con->query($sql);
    $res->execute();

    $consecutivo = 0;

    foreach ($res as $a) {
        $consecutivo = $a['compras_cs'];
    }

    $consecutivo += 1;

    echo $consecutivo;


?>