<?php

    require_once 'conexion.php';

    $id = $_POST['id'];

    $sql = "DELETE FROM pedidos2 WHERE idc_ped = :id";

    $statement = $con->prepare($sql);
    $statement->bindParam(':id', $id);
    
    $statement->execute();
        
    echo 1;
?>