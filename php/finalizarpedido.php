<?php


    require_once 'conexion.php';

    $id = $_POST['id'];


    //Confirmamos el estado de la compra
    $sql3 = "UPDATE pedidos SET status_ped = 1 WHERE pedidon_ped = :id";
    
            
    $statement = $con->prepare($sql3);
    $statement->bindParam(':id', $id);

    $statement->execute();

    //Actualizamos el folio de la compra
    $sql = "SELECT pedidos_cs FROM consecutivos WHERE id_cs = 1";
    $res = $con->query($sql);
    $res->execute();

    $consecutivo = 0;

    foreach ($res as $a) {
        $consecutivo = $a['pedidos_cs'];
    }

    $consecutivo += 1;

    $sql3 = "UPDATE consecutivos SET pedidos_cs = :consecutivo WHERE id_cs = 1";
    
            
    $statement = $con->prepare($sql3);
    $statement->bindParam(':consecutivo', $consecutivo);

    $statement->execute();

    echo 1;

?>