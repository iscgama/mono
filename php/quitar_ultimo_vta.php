<?php

    require_once 'conexion.php';

    $venta = $_POST['venta'];

    $sql = "SELECT COUNT(id_v) As renglones FROM ventas2 WHERE id_v = " . $venta;

    $res = $con->query($sql);
    $res->execute();

    $count = 0;

    foreach ($res as $a) {
        $count++;       
    }

    if ($count > 0 ) {
        $sql = "SELECT MAX(idc_v) As Maximo FROM ventas2 WHERE id_v = " . $venta;

        $res = $con->query($sql);
        $res->execute();

        foreach ($res as $a) {
            $maximo = $a['Maximo'];
        }

        $sql = "DELETE FROM ventas2 WHERE idc_v = " . $maximo . " AND id_v  = " . $venta; 
        $res = $con->query($sql);
        $res->execute();
        
        //Actualizamos monto de venta en base a los reglones de la venta
        $sql = "SELECT SUM(cant_v * precio_v) As Total FROM ventas2 WHERE id_v = " . $venta;
        $res = $con->query($sql);
        $res->execute();

        $total = 0;

        foreach ($res as $a) {
            $total = $a['Total'];
        }

        $total = ($total == null) ? 0 : $total;


        $sql = "UPDATE ventas SET monto_v = " . $total . " WHERE ventan_v = " . $venta;
        $res = $con->query($sql);
        $res->execute();

        echo 1;
    }else {
        echo 0;
    }

?>