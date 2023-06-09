<?php

    require_once 'conexion.php';



    $sql = "SELECT salidas_cs FROM consecutivos WHERE id_cs = 1";
    $res = $con->query($sql);
    $res->execute();

    $consecutivo = 0;

    foreach ($res as $a) {
        $consecutivo = $a['salidas_cs'];
    }

    $consecutivo += 1;

    echo $consecutivo;


?>