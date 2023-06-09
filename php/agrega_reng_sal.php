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
        $sql = "SELECT id_cs FROM conceptos_sal WHERE desc_cs = '" . $concepto . "'";



        $res = $con->query($sql);
        $res->execute();

        $idpr = 0;

        foreach ($res as $a) {
            $idpr = $a['id_cs'];
        }
    }else {
        $idpr = 1;
    }


    //Comprobar si existe la entrada en el sistema
    $sql = "SELECT salidan_sa FROM salidas WHERE salidan_sa = " . $compra;
    $res = $con->query($sql);
    $res->execute();

    $comp = 0;

    foreach ($res as $a) {
        $comp = $a['salidan_sa'];
    }

    if ($comp == 0) {
        $sql = "INSERT INTO `salidas`(`id_sa`, `salidan_sa`, `fecha_sa`, `id_cs`,
                                     `hora_sa`, `id_u`, `monto_sa`, `status_sa`)   
                    VALUES (null, :compra, NOW(), :idpr, NOW(), :idu, 0, 0);";
    
            
            $statement = $con->prepare($sql);
            $statement->bindParam(':compra', $compra);
            $statement->bindParam(':idpr', $idpr);
            $statement->bindParam(':idu', $idu);
    
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
        $sql = "SELECT id_a, cant_sa FROM salidas2 WHERE id_sa = " . $compra . " AND id_a = " . $num;
        //echo $sql;
        $res = $con->query($sql);
        $res->execute();

        $idrep = 0;
        $cantrep = 0;

        foreach ($res as $a) {
            $idrep = $a['id_a'];
            $cantrep = $a['cant_sa'];
        }

        if ($idrep == 0) {
            $sql = "INSERT INTO `salidas2`(`id_sa`, `idc_sa`, `cant_sa`, `id_a`, `costo_sa`)   
                        VALUES (:compra, null, :numero, :num, :price);";
        
                
                $statement = $con->prepare($sql);
                $statement->bindParam(':compra', $compra);
                $statement->bindParam(':numero', $numero);
                $statement->bindParam(':num', $num);
                $statement->bindParam(':price', $price);
        
                $statement->execute();   
        }else {
            $numero += $cantrep;

            $sql = "UPDATE salidas2 SET cant_sa = " . $numero . " WHERE id_sa = " . $compra . " AND id_a = " . $num;
            //echo $sql;
            $res = $con->query($sql);
            $res->execute();
    
            //$statement->execute();
        }

    }



?>