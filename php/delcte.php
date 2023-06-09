<?php

    require_once 'conexion.php';

    $id = $_POST['id'];

    $sql = "DELETE FROM clientes WHERE id_ct = :id";

    $statement = $con->prepare($sql);
    $statement->bindParam(':id', $id);
    
    $statement->execute();
        
    echo 1;
?>