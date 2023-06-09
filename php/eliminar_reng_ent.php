<?php

    require_once 'conexion.php';

    $id = $_POST['id'];

    $sql = "DELETE FROM entradas2 WHERE idc_e = :id";

    $statement = $con->prepare($sql);
    $statement->bindParam(':id', $id);
    
    $statement->execute();
        
    echo 1;
?>