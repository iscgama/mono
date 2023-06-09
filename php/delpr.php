<?php

    require_once 'conexion.php';

    $id = $_POST['id'];

    $sql = "DELETE FROM proveedor WHERE id_pr = :id";

    $statement = $con->prepare($sql);
    $statement->bindParam(':id', $id);
    
    $statement->execute();
        
    echo 1;
?>