<?php

    require_once '../conexion.php';

    $idu = $_POST['idu'];
    $sucursal = $_POST['sucursal'];


    /*
        Conseguimos el siguiente consecutivo de venta
    */
    $sql = "SELECT traspasos_cs FROM consecutivos WHERE id_cs = 1";
    $res = $con->query($sql);
    $res->execute();

    $consecutivo = 0;

    foreach ($res as $a) {
        $consecutivo = $a['traspasos_cs'];
    }

    //Lo incrementamos en una unidad
    $consecutivo += 1;

    //Guardamos la venta como pendiente de este consecutivo
    $sql = "INSERT INTO `traspasos`(`id_tr`, `traspason_tr`, `fecha_tr`,
                                     `hora_tr`, `id_u`, `monto_tr`, `status_tr`, `id_s`, `origen_tr`) 
            VALUES (null, :venta, NOW(), NOW(), :idu, 0, 0, :sucursal, 0);";

    
    $statement = $con->prepare($sql);
    $statement->bindParam(':venta', $consecutivo);
    $statement->bindParam(':idu', $idu);
    $statement->bindParam(':sucursal', $sucursal);

    $statement->execute();


    //Actualizamos el consecutivo de traspasos + 1
    $sql = "UPDATE consecutivos SET traspasos_cs = " . $consecutivo . " WHERE id_cs = 1";
    $res = $con->query($sql);
    $res->execute();


    echo $consecutivo;

?>