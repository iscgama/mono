<?php

    require_once 'conexion.php';

    $id = $_POST['id'];

    $sql = "DELETE FROM sucursales WHERE id_s = :id";

    $statement = $con->prepare($sql);
    $statement->bindParam(':id', $id);
    
    $statement->execute();
        
    echo 1;
?>