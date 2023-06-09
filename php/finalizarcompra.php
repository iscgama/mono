<?php


    require_once 'conexion.php';

    $id = $_POST['id'];
    $sucursal = $_POST['sucursal'];
    $usuario = $_POST['usuario'];

    //Obtenemos toda la información de la compra actual
    $sql = "SELECT cant_com, id_a, costo_com FROM compras2 WHERE id_com = " . $id;
    $res = $con->query($sql);
    $res->execute();

    
    //Por cada renglon afectamos el inventario
    foreach ($res as $a) {
        $sql2 = "SELECT exist_e, id_a FROM existsuc WHERE id_a = " . $a['id_a'];
        $res2 = $con->query($sql2);
        $res2->execute();
        
        //echo $sql2;
        $existcompra = 0;

        $existcompra = $a['cant_com'];

        $actual = 0;
        $ida = 0;

        foreach ($res2 as $a2) {
            $actual = $a2['exist_e'];
            $ida = $a2['id_a'];
        }

        if ($ida == 0) {
            $sql3 = "INSERT INTO existsuc (id_s, id_a, exist_e, id_u) 
                            VALUES(:sucursal, :ida, :exist, :usuario)";
        
                
            $statement = $con->prepare($sql3);
            $statement->bindParam(':sucursal', $sucursal);
            $statement->bindParam(':ida', $a['id_a']);
            $statement->bindParam(':exist', $existcompra);
            $statement->bindParam(':usuario', $usuario);

            $statement->execute();
        }else {
            $exist = $existcompra + $actual;

            $sql3 = "UPDATE existsuc SET exist_e = :exist WHERE id_a = :ida";
        
                
            $statement = $con->prepare($sql3);
            $statement->bindParam(':exist', $exist);
            $statement->bindParam(':ida', $a['id_a']);

            $statement->execute();
        }


        //Afectamos el costo de cada producto
        $sql3 = "UPDATE articulos SET costo_a = :costo WHERE id_a = :ida";
        
        $statement = $con->prepare($sql3);
        $statement->bindParam(':costo', $a['costo_com']);
        $statement->bindParam(':ida', $a['id_a']);

        $statement->execute();

    }

    //Confirmamos el estado de la compra
    $sql3 = "UPDATE compras SET status_com = 1 WHERE compran_com = :id";
    
            
    $statement = $con->prepare($sql3);
    $statement->bindParam(':id', $id);

    $statement->execute();

    //Actualizamos el folio de la compra
    $sql = "SELECT compras_cs FROM consecutivos WHERE id_cs = 1";
    $res = $con->query($sql);
    $res->execute();

    $consecutivo = 0;

    foreach ($res as $a) {
        $consecutivo = $a['compras_cs'];
    }

    $consecutivo += 1;

    $sql3 = "UPDATE consecutivos SET compras_cs = :consecutivo WHERE id_cs = 1";
    
            
    $statement = $con->prepare($sql3);
    $statement->bindParam(':consecutivo', $consecutivo);

    $statement->execute();

    echo 1;

?>