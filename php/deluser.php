<?php

    require_once 'conexion.php';

    $id = $_POST['id'];

    $sql = "DELETE FROM usuarios WHERE id_u = :id";

    $statement = $con->prepare($sql);
    $statement->bindParam(':id', $id);
    
    $statement->execute();
        
    echo 1;
?>