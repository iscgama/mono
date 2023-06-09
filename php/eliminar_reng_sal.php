<?php

    require_once 'conexion.php';

    $id = $_POST['id'];

    $sql = "DELETE FROM salidas2 WHERE idc_sa = :id";

    $statement = $con->prepare($sql);
    $statement->bindParam(':id', $id);
    
    $statement->execute();
        
    echo 1;
?>