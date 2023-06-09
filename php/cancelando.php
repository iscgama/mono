<?php

    require_once 'conexion.php';

    $id = $_POST['id'];
    $sucursal = $_POST['sucursal'];

    $sql = "UPDATE ventas SET status_v = 2 WHERE ventan_v = " . $id;
    $res = $con->query($sql);
    $res->execute();


    //Despues de actualizar la venta a estatus 0 = Cancelada reintegramos cada producto a existencia de la sucursal
    $sql = "SELECT cant_v, id_a FROM ventas2 WHERE id_v = " . $id;
    $res = $con->query($sql);
    $res->execute();


    foreach ($res as $a) {
        //Obtenemos la existencia de la sucursal y le sumamos la devolucion
        $sql2 = "SELECT exist_e FROM existsuc WHERE id_s = " . $sucursal . " AND id_a = " . $a['id_a'];
        $res2 = $con->query($sql2); 
        $res2->execute();

        foreach ($res2 as $a2) {
            $existencia = $a2['exist_e'];
        }

        $existencia += $a['cant_v'];

        $sql2 = "UPDATE existsuc SET exist_e = " . $existencia . " WHERE id_a = " . $a['id_a'] . " AND id_s = " . $sucursal;
        $res2 = $con->query($sql2); 
        $res2->execute();
    }

    echo 1;


?>