<?php

    require_once 'conexion.php';

    $modo = $_POST['modo'];
    $venta = $_POST['venta'];


    $sql = "SELECT MAX(idc_v) As maximo FROM ventas2 WHERE id_v = " . $venta;
    $res = $con->query($sql);
    $res->execute();

    $reng = 0;

    foreach ($res as $a) {
        $reng = $a['maximo'];
    }

    if ($reng != 0) {
        $sql = "SELECT cant_v FROM ventas2 WHERE idc_v = " . $reng;
        $res = $con->query($sql);
        $res->execute();

        foreach ($res as $a) {
            $cantidad = $a['cant_v'];
        }

        if ($modo == 1) {
            $cantidad += 1;
        }else {
            $cantidad -= 1;
            if ($cantidad < 1) {
                $cantidad = 1;
            }
        }

    

        $sql = "UPDATE ventas2 SET cant_v = :cantidad WHERE idc_v = :reng";
        $statement = $con->prepare($sql);
        $statement->bindParam(':cantidad', $cantidad);
        $statement->bindParam(':reng', $reng);
        $statement->execute();


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
    }


    echo 0;
?>