<?php


    require_once 'conexion.php';
    include 'funciones.php';

    $renglon = $_POST['renglon'];
    $modo = $_POST['modo'];
    $venta = $_POST['venta'];
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


    //Obtenermos la cantidad y el precio del renglón
    $sql = "SELECT cant_v, precio_v, id_a FROM ventas2 WHERE idc_v = " . $renglon;
    $res = $con->query($sql);
    $res->execute();

    $cant = 0;

    foreach ($res as $a) {
        $cant = $a['cant_v'];
        $precio = $a['precio_v'];
        $ida = $a['id_a'];
    }
    
    if ($modo == 0) {
        if ($cant > 1) {
            $cant--;
        }
    }else {
        $cant++;
    }

   
    if ($idct != 1) {
        $valores = precios_cliente($idct, $ida, $con);
        $precio = ($valores['precio'] == 0 ? $precio : $valores['precio']);      
    }else {
        $valores = validar_precio($ida, $cant, $con);
        $precio = ($valores['precio'] == 0 ? $precio : $valores['precio']);
    }

    // $preciocliente = 0;

    // if ($cliente != 'Cliente de Mostrador') {
    //     $preciocliente = precios_cliente($cliente, $idrep, $con);

    //     $precio = ($preciocliente == 0 ? $precio : $preciocliente);
    // }
    //$sub = $cantidad * $sub;

    $sql = "UPDATE ventas2 SET cant_v = " . $cant . ", precio_v = " . $precio . "
                    WHERE idc_v = " . $renglon;
    $res = $con->query($sql);
    $res->execute();

    //Actualizamos monto de venta en base a los reglones de la venta
    $sql = "SELECT SUM(cant_v * precio_v) As Total FROM ventas2 WHERE id_v = " . $venta;
    $res = $con->query($sql);
    $res->execute();

    $total = 0;

    foreach ($res as $a) {
        $total += $a['Total'];
    }


    $sql = "UPDATE ventas SET monto_v = " . $total . " WHERE ventan_v = " . $venta;
    $res = $con->query($sql);
    $res->execute();

    echo $valores['mensaje'];

?>
