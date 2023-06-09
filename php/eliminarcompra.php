<?php


    require_once 'conexion.php';

    $id = $_POST['id'];
    $sucursal = $_POST['sucursal'];
    $idu = $_POST['idu'];

    //Obtenemos toda la información de la compra actual
    $sql = "SELECT cant_com, id_a, costo_com FROM compras2 WHERE id_com = " . $id;
    $res = $con->query($sql);
    $res->execute();


    
    //Por cada renglon afectamos el inventario
    foreach ($res as $a) {
        $sql2 = "SELECT exist_e, id_a FROM existsuc 
                    WHERE id_a = " . $a['id_a'] . " AND id_s = " . $sucursal;
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
                            VALUES(:sucursal, :ida, :exist, :idu)";
        
            $existcompra = $existcompra * -1; 
                
            $statement = $con->prepare($sql3);
            $statement->bindParam(':sucursal', $sucursal);
            $statement->bindParam(':ida', $a['id_a']);
            $statement->bindParam(':exist', $existcompra);
            $statement->bindParam(':idu', $idu);

            $statement->execute();
        }else {
            $exist = $actual - $existcompra;

            $sql3 = "UPDATE existsuc SET exist_e = :exist WHERE id_a = :ida AND id_s = :sucursal";
        
                
            $statement = $con->prepare($sql3);
            $statement->bindParam(':exist', $exist);
            $statement->bindParam(':ida', $a['id_a']);
            $statement->bindParam(':sucursal', $sucursal);

            $statement->execute();
        }

    }

    //Confirmamos el estado de la compra
    $sql3 = "UPDATE compras SET status_com = 2 WHERE compran_com = :id";
    
            
    $statement = $con->prepare($sql3);
    $statement->bindParam(':id', $id);

    $statement->execute();

    echo 1;

?>