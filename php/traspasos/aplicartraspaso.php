<?php

    require_once '../conexion.php';

    $id = $_POST['id'];
    $idu = $_POST['idu'];

    //Obtenemos todos los datos del traspaso
    $sql = "SELECT id_s FROM traspasos WHERE traspason_tr = " . $id;
    $res = $con->query($sql);
    $res->execute();

    //Obtenemos la sucursal a la que vamos a afectar
    $ids = 0;

    foreach ($res as $a) {
        $ids = $a['id_s'];
    }

    //Obtenemos cada renglón del traspaso que vamos a realizar a la sucursal
    $sql = "SELECT cant_tr, id_a FROM traspasos2 WHERE id_tr = " . $id;
    $res = $con->query($sql);
    $res->execute();

    foreach ($res as $a) {
        $ida1 = $a['id_a'];
        $canta1 = $a['cant_tr'];
        //Consultamos si existen existencias asociadas a la sucursal del producto que vamos a modificar
        $sql2 = "SELECT exist_e, id_a FROM existsuc WHERE id_s = " . $ids . " AND id_a = " . $ida1;
        $res2 = $con->query($sql2);
        $res2->execute();

        $cantactual = 0;
        $ida = 0;

        foreach ($res2 as $a2) {
            $cantactual = $a2['exist_e'];
            $ida = $a2['id_a'];
        }

        //Sino existe la asignación de existencias solo insertamos la cantidad
        if ($ida == 0) {
            $sql3 = "INSERT INTO `existsuc`(`id_ex`, `id_s`, `id_a`, `exist_e`, `id_u`) 
                        VALUES (null, :ids, :ida, :cant, :idu)";
             $statement = $con->prepare($sql3);
             $statement->bindParam(':ids', $ids);
             $statement->bindParam(':ida', $ida1);
             $statement->bindParam(':cant', $canta1);
             $statement->bindParam(':idu', $idu);
         
         
             $statement->execute();

        }else {
            //Si ya existen existencias actuales en la sucursal las agregamos
            $cantfinal = floatval($cantactual) + floatval($canta1);

            $sql3 = "UPDATE existsuc SET exist_e = :cant WHERE id_a = :ida AND id_s = :ids";
             $statement = $con->prepare($sql3);
             $statement->bindParam(':cant', $cantfinal);
             $statement->bindParam(':ida', $ida1);
             $statement->bindParam(':ids', $ids);
             $statement->execute();
        }
        //Actualizamos las existencias de la principal
        $sql4 = "SELECT egral_a FROM articulos WHERE id_a = " . $ida1;
        $res4 = $con->query($sql4);
        $res4->execute();


        foreach ($res4 as $a4) {
            $existencias = floatval($a4['egral_a']) - floatval($canta1);

             $sql3 = "UPDATE articulos SET egral_a = :existencias WHERE id_a = :ida";
             $statement = $con->prepare($sql3);
             $statement->bindParam(':existencias', $existencias);
             $statement->bindParam(':ida', $ida1);
             $statement->execute();
        }
    }


     //Actualizamos el estado del traspaso
     $sql = "UPDATE traspasos SET status_tr = 1 WHERE traspason_tr = " . $id;
     $res = $con->query($sql);
     $res->execute();

    echo 1;


?>