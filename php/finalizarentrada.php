<?php


    require_once 'conexion.php';

    $id = $_POST['id'];

    //Obtenemos toda la información de la entrada actual
    $sql = "SELECT cant_e, id_a FROM entradas2 WHERE id_e = " . $id;
    $res = $con->query( $sql );
    $res->execute();

    
    //Por cada renglon afectamos el inventario
    foreach ($res as $a) {
        $sql2 = "SELECT egral_a FROM articulos WHERE id_a = " . $a['id_a'];
        $res2 = $con->query($sql2);
        $res2->execute();
        
        //echo $sql2;
        $existcompra = 0;

        $existcompra = $a['cant_e'];

        $actual = 0;

        foreach ($res2 as $a2) {
            $actual = $a2['egral_a'];
        }

        $exist = $existcompra + $actual;

        $sql3 = "UPDATE articulos SET egral_a = :exist WHERE id_a = :ida";
    
            
        $statement = $con->prepare($sql3);
        $statement->bindParam(':exist', $exist);
        $statement->bindParam(':ida', $a['id_a']);

        $statement->execute();

    }

    //Confirmamos el estado de la compra
    $sql3 = "UPDATE entradas SET status_e = 1 WHERE entradan_e = :id";
    
            
    $statement = $con->prepare($sql3);
    $statement->bindParam(':id', $id);

    $statement->execute();

    //Actualizamos el folio de la compra
    $sql = "SELECT entradas_cs FROM consecutivos WHERE id_cs = 1";
    $res = $con->query($sql);
    $res->execute();

    $consecutivo = 0;

    foreach ($res as $a) {
        $consecutivo = $a['entradas_cs'];
    }

    $consecutivo += 1;

    $sql3 = "UPDATE consecutivos SET entradas_cs = :consecutivo WHERE id_cs = 1";
    
            
    $statement = $con->prepare($sql3);
    $statement->bindParam(':consecutivo', $consecutivo);

    $statement->execute();

    echo 1;

?>