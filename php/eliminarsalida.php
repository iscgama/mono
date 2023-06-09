<?php


    require_once 'conexion.php';

    $id = $_POST['id'];
    $sucursal = $_POST['sucursal'];


    //Obtenemos toda la información de la compra actual
    $sql = "SELECT cant_sa, id_a FROM salidas2 WHERE id_sa = " . $id;
    $res = $con->query($sql);
    $res->execute();

    
    //Por cada renglon afectamos el inventario
    foreach ($res as $a) {
        $sql2 = "SELECT exist_e FROM existsuc WHERE id_a = " . $a['id_a'] . " AND id_s = " . $sucursal;
        $res2 = $con->query($sql2);
        $res2->execute();
        
        //echo $sql2;
        $existcompra = 0;

        $existcompra = $a['cant_sa'];

        $actual = 0;

        foreach ($res2 as $a2) {
            $actual = $a2['exist_e'];
        }

        $exist = $actual + $existcompra;

        $sql3 = "UPDATE existsuc SET exist_e = :exist WHERE id_a = :ida AND id_s = :sucursal";
    
            
        $statement = $con->prepare($sql3);
        $statement->bindParam(':exist', $exist);
        $statement->bindParam(':ida', $a['id_a']);
        $statement->bindParam(':sucursal', $sucursal);

        $statement->execute();

    }

    //Confirmamos el estado de la compra
    $sql3 = "UPDATE salidas SET status_sa = 2 WHERE salidan_sa = :id";
    
            
    $statement = $con->prepare($sql3);
    $statement->bindParam(':id', $id);

    $statement->execute();

    echo 1;

?>