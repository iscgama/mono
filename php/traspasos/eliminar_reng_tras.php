<?php

    require_once '../conexion.php';

    $id = $_POST['id'];

    $sql = "DELETE FROM traspasos2 WHERE idc_tr = :id";

    $statement = $con->prepare($sql);
    $statement->bindParam(':id', $id);
    
    $statement->execute();
        
    echo 1;
?>