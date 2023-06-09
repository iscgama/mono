<?php

    require_once 'conexion.php';

    $id = $_POST['id'];


    //Verificamos que no exista productos con esta clasificacion
    //Antes de borrarla y modificarlos para pasarlos a la general
    $sql = "SELECT id_a FROM articulos WHERE id_c = " . $id;
    $res = $con->query($sql);
    $res->execute();

    //Por cada elemento encontrado lo cambiamos a clasificacion General
    foreach ($res as $a) {
        $sql2 = "UPDATE articulos SET id_c = 1 WHERE id_a = " . $a['id_a'];
        $res2 = $con->query($sql2);
        $res2->execute();
    }

    //Al final borramos la clasificación
    $sql = "DELETE FROM clasificacion WHERE id_c = :id";

    $statement = $con->prepare($sql);
    $statement->bindParam(':id', $id);
    
    $statement->execute();
        
    echo 1;
?>