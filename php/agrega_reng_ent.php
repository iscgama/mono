<?php

    require_once 'conexion.php';

    $codigo = $_POST['code'];
    $numero = $_POST['count'];
    $price = $_POST['price'];
    $compra = $_POST['compra'];
    $idu = $_POST['idu'];
    //$sucursal = $_POST['sucursal'];
    $concepto = $_POST['concepto'];
    

    //Comprobar el concepto de entrada
    if ($concepto != '') {
        $sql = "SELECT id_ce FROM conceptos_ent WHERE desc_ce = '" . $concepto . "'";



        $res = $con->query($sql);
        $res->execute();

        $idpr = 0;

        foreach ($res as $a) {
            $idpr = $a['id_ce'];
        }
    }else {
        $idpr = 1;
    }


    //Comprobar si existe la entrada en el sistema
    $sql = "SELECT entradan_e FROM entradas WHERE entradan_e = " . $compra;
    $res = $con->query($sql);
    $res->execute();

    $comp = 0;

    foreach ($res as $a) {
        $comp = $a['entradan_e'];
    }

    if ($comp == 0) {
        $sql = "INSERT INTO `entradas`(`id_e`, `entradan_e`, `fecha_e`, 
                                        `hora_e`, `id_ce`, `id_u`, `monto_e`, `status_e`)  
                    VALUES (null, :compra, NOW(), NOW(), :idpr, :idu, 0, 0);";
    
            
            $statement = $con->prepare($sql);
            $statement->bindParam(':compra', $compra);
            $statement->bindParam(':idpr', $idpr);
            $statement->bindParam(':idu', $idu);
            $statement->bindParam(':idpr', $idpr);
    
            $statement->execute();
    }



    $sql = "SELECT id_a FROM articulos WHERE cod_a = '" . $codigo . "'";

    $res = $con->query($sql);
    $res->execute();


    $num = 0;

    foreach ($res as $a) {
        $num = $a['id_a'];
    }

    if ($num == 0) {
        echo 'El producto seleccionado no existe, intente de nuevo con otro codigo válido';
    }else {

        
        //Verificar si existe un articulo en la lista para actualizar el anterior
        $sql = "SELECT id_a, cant_e FROM entradas2 WHERE id_e = " . $compra . " AND id_a = " . $num;
        //echo $sql;
        $res = $con->query($sql);
        $res->execute();

        $idrep = 0;
        $cantrep = 0;

        foreach ($res as $a) {
            $idrep = $a['id_a'];
            $cantrep = $a['cant_e'];
        }

        if ($idrep == 0) {
            $sql = "INSERT INTO `entradas2`(`id_e`, `idc_e`, `cant_e`, `id_a`, `costo_e`)  
                        VALUES (:compra, null, :numero, :num, :price);";
        
                
                $statement = $con->prepare($sql);
                $statement->bindParam(':compra', $compra);
                $statement->bindParam(':numero', $numero);
                $statement->bindParam(':num', $num);
                $statement->bindParam(':price', $price);
        
                $statement->execute();   
        }else {
            $numero += $cantrep;

            $sql = "UPDATE entradas2 SET cant_e = " . $numero . " WHERE id_e = " . $compra . " AND id_a = " . $num;
            //echo $sql;
            $res = $con->query($sql);
            $res->execute();
    
            //$statement->execute();
        }

    }



?>