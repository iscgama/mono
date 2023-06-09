<?php

    require_once '../conexion.php'; 
 
    $producto = $_POST['producto'];
    $cantidad = $_POST['cantidad'];
    $sucursal = $_POST['sucursal'];
    $numtras = $_POST['numtras'];

    //Consultamos el costo que tiene actualmente
    $sql = "SELECT costo_a, id_a FROM articulos WHERE cod_a = '" . $producto . "'";
    $res = $con->query($sql);
    $res->execute();

    $costop = 0;
    $ida = 0;

    foreach ($res as $a) {
        $costop = $a['costo_a'];
        $ida = $a['id_a'];
    }


    //Primero verificamos cuantas piezas existen en el traspaso de este mismo articulo y las sumamos
    $sql = "SELECT idc_tr, cant_tr, costo_tr FROM traspasos2 WHERE id_tr = " . $numtras . " AND id_a = " . $ida;
    $res = $con->query($sql);
    $res->execute();

    $piezas = 0;
    $costo = 0;
    $renglon = 0;

    foreach ($res as $a) {
        $piezas = $a['cant_tr'];
        $costo = $a['costo_tr'];
        $renglon = $a['idc_tr'];
    }

    if ($piezas > 0) {
        $cantidadfinal = $piezas + $cantidad;
        //Actualizamos el renglon del trapaso.
        $sql = "UPDATE traspasos2 SET cant_tr = " . $cantidadfinal . " WHERE idc_tr = " . $renglon;
        $res = $con->query($sql);
        $res->execute();
    }else {
        
        //Insertamos un nuevo renglón del traspaso
        $sql = "INSERT INTO `traspasos2`(`id_tr`, `idc_tr`, `cant_tr`, `id_a`, `costo_tr`) 
                            VALUES (:numtras, null, :cantidad, :producto, :costo)";

        $statement = $con->prepare($sql);
        $statement->bindParam(':numtras', $numtras);
        $statement->bindParam(':cantidad', $cantidad);
        $statement->bindParam(':producto', $ida);
        $statement->bindParam(':costo', $costop);
        $statement->execute();
    }


?>