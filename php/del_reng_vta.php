<?php

    require_once 'conexion.php';

    $id = $_POST['id'];
    $idu = $_POST['idu'];
    $venta = $_POST['venta'];

    
        $sql = "DELETE FROM ventas2 WHERE idc_v = :id";

        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);
        
        $statement->execute();


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
?>