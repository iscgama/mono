<?php


    require_once '../conexion.php';

    $id = $_POST['id'];


    //Confirmamos el estado de la compra
    $sql3 = "DELETE FROM traspasos WHERE traspason_tr = :id";
    
            
    $statement = $con->prepare($sql3);
    $statement->bindParam(':id', $id);

    $statement->execute();

    //Confirmamos el estado de la compra
    $sql3 = "DELETE FROM traspasos2 WHERE id_tr = :id";
    
            
    $statement = $con->prepare($sql3);
    $statement->bindParam(':id', $id);

    $statement->execute();

    echo 1;

?>