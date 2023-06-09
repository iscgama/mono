<?php

    require_once 'conexion.php';
    
    $renglon = $_POST['renglon'];
    $actualizar = $_POST['actualizar'];
    $articulo = $_POST['articulo'];
    $sucursal = $_POST['sucursal'];
    $cantidad = $_POST['cantidad'];
    $idu = $_POST['idu'];



    //Obtenemos el consecutivo de la venta para actualizar el monto
    $sql = "SELECT id_v, precio_v FROM ventas2 WHERE idc_v = " . $renglon;
    $res = $con->query($sql);
    $res->execute();

    $venta = 0;

    foreach ($res as $a) {
        $venta = $a['id_v'];
        $precio_v = $a['precio_v'];
    }

    //Actualizamos las cantidades en la venta anterior
    $sql = "UPDATE ventas2 SET cant_v = " . $actualizar . " WHERE idc_v = " . $renglon;
    $res = $con->query($sql);
    $res->execute();


    //Actualizamos el monto de la venta
    $sql = "SELECT SUM(cant_v * precio_v) As Total FROM ventas2 WHERE id_v = " . $venta;
    $res = $con->query($sql);
    $res->execute();

    $totalvta = 0;

    foreach ($res as $a) {
        $totalvta = $a['Total'];
    }

    $sql = "UPDATE ventas SET monto_v = " . $totalvta . " WHERE ventan_v = " . $venta;
    $res = $con->query($sql);
    $res->execute();


    //Obtenemos las existencias actuales de la sucursal
    $sql = "SELECT exist_e FROM existsuc WHERE id_a = " . $articulo . " AND id_s = " . $sucursal;
    $res = $con->query($sql);
    $res->execute();
    
    //Afectamos el inventario de manera positiva
    foreach ($res as $a) {
        $cantfinal = $a['exist_e'] + $cantidad;
    }

    $sql = "UPDATE existsuc SET exist_e = " . $cantfinal . " WHERE id_a = " . $articulo;
    $res = $con->query($sql);
    $res->execute();

    //Creamos una salida de dinero por la cantidad devuelta
    $sql = "INSERT INTO flujos (id_f, motivo_f, monto_f, fecha_f, hora_f,
                                id_u, id_s, corte_f, tipo_f)
            VALUES (null, 'DEVOLUCION VENTA ', ($cantidad * $precio_v),
                            NOW(), NOW(), " . $idu . ", " . $sucursal . ", 0, 'E')";
    $res = $con->query($sql);
    $res->execute();

    
    //Insertar la devolución de la venta
    $sql = "INSERT INTO `devoluciones` (`id_de`, `fecha_de`, `hora_de`, `id_u`, `id_v`, 
                                        `id_s`, `id_a`, `cant_de`, `precio_de`, `corte_de`) 
                            VALUES (null, NOW(), NOW(), :idu, :idv, :sucursal, :articulo,
                            :cantidad, :precio,  0)";

    $statement = $con->prepare($sql);
    $statement->bindParam(':idu', $idu);
    $statement->bindParam(':idv', $venta);
    $statement->bindParam(':sucursal', $sucursal);
    $statement->bindParam(':articulo', $articulo);
    $statement->bindParam(':cantidad', $cantidad);
    $statement->bindParam(':precio', $precio_v);
    $statement->execute();

?>