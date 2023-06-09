<?php

    require_once 'conexion.php';

    $codigo = $_POST['code'];
    $numero = $_POST['count'];
    $price = $_POST['price'];
    $compra = $_POST['compra'];
    $idu = $_POST['idu'];
    //$sucursal = $_POST['sucursal'];
    $prov = $_POST['prov'];
    

    //Comprobar si existe la compra en el sistema
    $sql = "SELECT id_pr FROM proveedor WHERE nom_pr = '" . $prov . "'";



    $res = $con->query($sql);
    $res->execute();

    $idpr = 0;

    foreach ($res as $a) {
        $idpr = $a['id_pr'];
    }


    //Comprobar si existe la compra en el sistema
    $sql = "SELECT compran_com FROM compras WHERE compran_com = " . $compra;
    $res = $con->query($sql);
    $res->execute();

    $comp = 0;

    foreach ($res as $a) {
        $comp = $a['compran_com'];
    }

    if ($comp == 0) {
        $sql = "INSERT INTO `compras`(`id_com`,`compran_com`, `fecha_com`, 
                                        `hora_com`, `id_u`, `monto_com`, `id_pr`,
                                         `status_com`) 
                    VALUES (null, :compra, NOW(), NOW(), :idu, 0, :idpr, 0);";
    
            
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
        $sql = "SELECT id_a, cant_com FROM compras2 WHERE id_com = " . $compra . " AND id_a = " . $num;
        //echo $sql;
        $res = $con->query($sql);
        $res->execute();

        $idrep = 0;
        $cantrep = 0;

        foreach ($res as $a) {
            $idrep = $a['id_a'];
            $cantrep = $a['cant_com'];
        }

        if ($idrep == 0) {
            $sql = "INSERT INTO `compras2`(`id_com`, `idc_com`, `cant_com`, `id_a`, `costo_com`) 
                        VALUES (:compra, null, :numero, :num, :price);";
        
                
                $statement = $con->prepare($sql);
                $statement->bindParam(':compra', $compra);
                $statement->bindParam(':numero', $numero);
                $statement->bindParam(':num', $num);
                $statement->bindParam(':price', $price);
        
                $statement->execute();   
        }else {
            $numero += $cantrep;

            $sql = "UPDATE compras2 SET cant_com = " . $numero . " WHERE id_com = " . $compra . " AND id_a = " . $num;
            //echo $sql;
            $res = $con->query($sql);
            $res->execute();
    
            //$statement->execute();
        }

    }

    echo 0;


?>