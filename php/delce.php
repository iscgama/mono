<?php

    require_once 'conexion.php';

    $id = $_POST['id'];


    //Verificamos que no exista productos con esta clasificacion
    //Antes de borrarla y modificarlos para pasarlos a la general
    $sql = "SELECT pedidon_ped FROM pedidos WHERE id_ped = " . $id;
    $res = $con->query($sql);
    $res->execute();

    //Por cada elemento encontrado lo cambiamos a clasificacion General
    foreach ($res as $a) {
        $sql2 = "UPDATE pedidos SET id_ped = 1 WHERE id_ce = " . $a['id_ce'];
        $res2 = $con->query($sql2);
        $res2->execute();
    }

    //Al final borramos la clasificación
    $sql = "DELETE FROM conceptos_ent WHERE id_ce = :id";

    $statement = $con->prepare($sql);
    $statement->bindParam(':id', $id);
    
    $statement->execute();
        
    echo 1;
?>