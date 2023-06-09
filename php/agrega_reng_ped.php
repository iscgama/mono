<?php

    require_once 'conexion.php';

    $codigo = $_POST['code'];
    $numero = $_POST['count'];
    $price = $_POST['price'];
    $compra = $_POST['compra'];
    $idu = $_POST['idu'];
    //$sucursal = $_POST['sucursal'];
    $pr = $_POST['pr'];
    

    //Comprobar el concepto de entrada
    if ($pr != '') {
        $sql = "SELECT id_pr FROM proveedor WHERE nom_pr = '" . $pr . "'";



        $res = $con->query($sql);
        $res->execute();

        $idpr = 0;

        foreach ($res as $a) {
            $idpr = $a['id_pr'];
        }
    }else {
        $idpr = 1;
    }


    //Comprobar si existe el pedido en el sistema
    $sql = "SELECT pedidon_ped FROM pedidos WHERE pedidon_ped = " . $compra;
    $res = $con->query($sql);
    $res->execute();

    $comp = 0;

    foreach ($res as $a) {
        $comp = $a['pedidon_ped'];
    }

    if ($comp == 0) {
        $sql = "INSERT INTO `pedidos`(`id_ped`, `pedidon_ped`, `fecha_ped`,
                                 `hora_ped`, `id_u`, `monto_ped`, `status_ped`, `id_pr`) 
                    VALUES (null, :compra, NOW(), NOW(), :idu, 0, 0, :idpr);";
    
            
            $statement = $con->prepare($sql);
            $statement->bindParam(':compra', $compra);
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
        $sql = "SELECT id_a, cant_ped FROM pedidos2 WHERE id_ped = " . $compra . " AND id_a = " . $num;
        //echo $sql;
        $res = $con->query($sql);
        $res->execute();

        $idrep = 0;
        $cantrep = 0;

        foreach ($res as $a) {
            $idrep = $a['id_a'];
            $cantrep = $a['cant_ped'];
        }

        if ($idrep == 0) {
            $sql = "INSERT INTO `pedidos2`(`id_ped`, `idc_ped`, `cant_ped`, `id_a`, `costo_ped`) 
                        VALUES (:compra, null, :numero, :num, :price);";
        
                
                $statement = $con->prepare($sql);
                $statement->bindParam(':compra', $compra);
                $statement->bindParam(':numero', $numero);
                $statement->bindParam(':num', $num);
                $statement->bindParam(':price', $price);
        
                $statement->execute();   
        }else {
            $numero += $cantrep;

            $sql = "UPDATE pedidos2 SET cant_ped = " . $numero . " WHERE id_ped = " . $compra . " AND id_a = " . $num;
            //echo $sql;
            $res = $con->query($sql);
            $res->execute();
    
            //$statement->execute();
        }

    }



?>