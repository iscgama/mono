<?php

    require_once 'conexion.php';

    $id = $_POST['id'];

    $sql = "DELETE FROM roles WHERE id_r = :id";

    $statement = $con->prepare($sql);
    $statement->bindParam(':id', $id);
    
    $statement->execute();
        
    echo 1;
?>