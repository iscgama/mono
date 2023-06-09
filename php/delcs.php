<?php

    require_once 'conexion.php';

    $id = $_POST['id'];


    //Verificamos que no exista productos con esta clasificacion
    //Antes de borrarla y modificarlos para pasarlos a la general
    $sql = "SELECT id_sa FROM salidas WHERE id_sa = " . $id;
    $res = $con->query($sql);
    $res->execute();

    //Por cada elemento encontrado lo cambiamos a clasificacion General
    foreach ($res as $a) {
        $sql2 = "UPDATE salidas SET id_sa = 1 WHERE id_cs = " . $a['id_sa'];
        $res2 = $con->query($sql2);
        $res2->execute();
    }

    //Al final borramos la clasificación
    $sql = "DELETE FROM conceptos_sal WHERE id_cs = :id";

    $statement = $con->prepare($sql);
    $statement->bindParam(':id', $id);
    
    $statement->execute();
        
    echo 1;
?>