<?php


    require_once 'conexion.php';

    $id = $_POST['id'];
    $cantidad = $_POST['cantidad'];
    $granel = $_POST['granel'];

    if ($granel == 0) {
        $cantidad = intval($cantidad);
    }

    //Esto actualiza la cantidad de venta
    $sql = "UPDATE ventas2 SET cant_v = " . $cantidad . " WHERE idc_v = " . $id;
    $res = $con->query($sql);
    $res->execute();



    $sql = "SELECT id_v FROM ventas2 WHERE idc_v = " . $id;
    $res = $con->query($sql);
    $res->execute();

    foreach ($res as $a) {
        $venta = $a['id_v'];
    }

    
     //Actualizamos monto de venta en base a los reglones de la venta
     $sql = "SELECT SUM(cant_v * precio_v) As Total FROM ventas2 WHERE id_v = " . $venta;
     $res = $con->query($sql);
     $res->execute();
 
     $total = 0;
 
     foreach ($res as $a) {
         $total += $a['Total'];
     }
 
 
     $sql = "UPDATE ventas SET monto_v = " . $total . " WHERE ventan_v = " . $venta;
     $res = $con->query($sql);
     $res->execute();



    echo 1;

?>