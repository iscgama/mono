<?php

    require_once 'conexion.php';
    include 'funciones.php';

    $ida = $_POST['ida'];
    $precio = $_POST['precio'];
    $venta = $_POST['venta'];
    $idu = $_POST['idu'];
    $sucursal = $_POST['sucursal'];
    $cliente = $_POST['cliente'];

    $valores = array(
        'precio' => '',
        'mensaje' => ''
    );
    

    //Obtenemos el ID del cliente actual
    $sql = "SELECT id_ct FROM clientes WHERE nom_ct = '" . $cliente . "'";
    $res = $con->query($sql);
    $res->execute();

    $idct = 0;

    foreach ($res as $a) {
        $idct = $a['id_ct'];
    }

    if ($idct == 0) {
        $idct = 1;
    }

  


    //Verificar si existe un articulo en la lista para actualizar el anterior
    $sql = "SELECT id_a, cant_v FROM ventas2 WHERE id_v = " . $venta . " AND id_a = " . $ida;
    $res = $con->query($sql);
    $res->execute();

    $idrep = 0;
    $cantrep = 0;

    foreach ($res as $a) {
        $idrep = $a['id_a'];
        $cantrep = $a['cant_v']; 
    }

    $numero = 1;


    
    if ($idrep == 0) {
        //Verificamos que el cliente no sea de mostrador
        if ($idct != 1) {
            $valores = precios_cliente($idct, $ida, $con);
            $precio = ($valores['precio'] == 0 ? $precio : $valores['precio']);
        }else {
            $valores = validar_precio($ida, $numero, $con);
            $precio = ($valores['precio'] == 0 ? $precio : $valores['precio']);
        }
        $sql = "INSERT INTO `ventas2`(`id_v`, `idc_v`, `cant_v`, `id_a`, `precio_v`) 
                    VALUES (:venta, null, :numero, :ida, :precio);";
    
            
            $statement = $con->prepare($sql);
            $statement->bindParam(':venta', $venta);
            $statement->bindParam(':numero', $numero);
            $statement->bindParam(':ida', $ida);
            $statement->bindParam(':precio', $precio);
    
            $statement->execute();   
    }else {
        //En caso de que exista el renglón de la venta lo actualizamos con el precio marcado por el cliente
        $numero += $cantrep;

        //Verificamos que el cliente no sea de mostrador
        if ($idct != 1) {
            
        }else {
            $valores = validar_precio($ida, $numero, $con);
            $precio = ($valores['precio'] == 0 ? $precio : $valores['precio']); 
        }

        $sql = "UPDATE ventas2 SET cant_v = " . $numero . ", precio_v = " . $precio . " WHERE id_v = " . $venta . " AND id_a = " . $idrep;
        $res = $con->query($sql);
        $res->execute();
    }


    //Actualizamos monto de venta en base a los reglones de la venta
    $sql = "SELECT SUM(cant_v * precio_v) As Total FROM ventas2 WHERE id_v = " . $venta;
    $res = $con->query($sql);
    $res->execute();

    $total = 0;

    foreach ($res as $a) {
        $total += $a['Total'];
    }


    $sql = "UPDATE ventas SET monto_v = " . $total . ", id_ct = " . $idct . " WHERE ventan_v = " . $venta;
    $res = $con->query($sql);
    $res->execute();

    echo $valores['mensaje'];
?>