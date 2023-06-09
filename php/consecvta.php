<?php
    
    require_once 'conexion.php';

    $idu = $_POST['idu'];
    $sucursal = $_POST['sucursal'];

    //echo 'El idu=' . $idu . ' la sucursal='  . $sucursal;
    /*
        Conseguimos el siguiente consecutivo de venta
    */
    $sql = "SELECT ventas_cs FROM consecutivos WHERE id_cs = 1";
    $res = $con->query($sql);
    $res->execute();


    $consecutivo = 0;

    if ( $res->rowCount() > 0 ) {
        foreach ($res as $a) {
            $consecutivo = $a['ventas_cs'];
        }
    }else {
        $consecutivo = 0;
    }

    // //Lo incrementamos en una unidad
    $consecutivo += 1;

    $sql = "INSERT INTO ventas (
        ventan_v, id_ct, id_u, id_ca, monto_v, 
        pago_v, cambio_v, forma_v, status_v,
        corte_v, id_s, fecha_v, hora_v
    ) VALUES (
        :consecutivo, 1, :idu, 0, 0, 0, 0, '', 1, 0, :sucursal, NOW(), NOW()
    )";    

    $stm = $con->prepare( $sql );
    $stm->bindParam(":consecutivo", $consecutivo);
    $stm->bindParam(":idu", $idu);
    $stm->bindParam(":sucursal", $sucursal);

    $stm->execute();



    //Actualizamos el consecutivo de ventas + 1
    $sql = "UPDATE consecutivos SET ventas_cs = " . $consecutivo . " WHERE id_cs = 1";
    $res = $con->query($sql);
    $res->execute();

    // echo $consecutivo;        
    echo $consecutivo;
?>