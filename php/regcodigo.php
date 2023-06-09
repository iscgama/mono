<?php


    require_once 'conexion.php';


    $codigo = $_POST['codigo'];
    $idu = $_POST['idu'];
    $cod_actual = $_POST['ida'];


    $sql = "SELECT id_a FROM articulos WHERE cod_a = '" . $codigo . "'";
    $res = $con->query($sql);
    $res->execute();

    $ida = 0;

    foreach ($res as $a) {
        $ida = $a['id_a'];
    }

    if ($ida != 0) {
        echo 'El código que intentas registrar ya existe, intenta con otro diferente';
    }else {
        $sql = "SELECT coda_b FROM codigos WHERE cod_b = '" . $codigo . "'";
        $res = $con->query($sql);
        $res->execute();

        $ida = 0;

        foreach ($res as $a) {
            $ida = $a['coda_b'];
        }

        if ($ida != 0) {
            echo 'El código que intentas registrar ya existe, intenta con otro diferente';
        }else {

            //Obtenemos el id_a del producto que vamos a actualizar
            $sql = "SELECT id_a FROM articulos WHERE cod_a = '" . $cod_actual . "'";
            $res = $con->query($sql);
            $res->execute();


            $id_actual = 0;

            foreach ($res as $a) {
                $id_actual = $a['id_a'];
            }

            //Actualizamos el id_a de los codigos existentes de este producto
            $sql = "UPDATE codigos SET coda_b = :codigo WHERE coda_b = :cod_actual";

            $statement = $con->prepare($sql);
            $statement->bindParam(':codigo', $codigo);
            $statement->bindParam(':cod_actual', $cod_actual);
            $statement->execute();



            //Agregamos el codigo nuevo que ingresamos junto con el anterior
            $sql = "INSERT INTO `codigos`(`id_b`, `coda_b`, `cod_b`, `id_u`)  
                        VALUES (null, :codigo, :cod_actual, :idu);";

            $statement = $con->prepare($sql);
            $statement->bindParam(':codigo', $codigo);
            $statement->bindParam(':cod_actual', $cod_actual);
            $statement->bindParam(':idu', $idu);
            $statement->execute();
            
            //Actualizamos el código nuevo al producto
            $sql = "UPDATE articulos SET cod_a = :codigo WHERE id_a = :id_actual";

            $statement = $con->prepare($sql);
            $statement->bindParam(':codigo', $codigo);
            $statement->bindParam(':id_actual', $id_actual);
            $statement->execute();

            echo 1;
        }

    }


?>