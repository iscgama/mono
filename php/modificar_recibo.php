<?php


    require_once 'conexion.php';

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $concepto = $_POST['concepto'];
    $monto = $_POST['monto'];
    

    $sql = "UPDATE `recibos` SET nombre_re = :nombre, 
                        concepto_re = :concepto, monto_re = :monto
            WHERE id_re = :id";
    
            
    $statement = $con->prepare($sql);
    $statement->bindParam(':nombre', $nombre);
    $statement->bindParam(':concepto', $concepto);
    $statement->bindParam(':monto', $monto);
    $statement->bindParam(':id', $id);


    $statement->execute();


    echo 1;

?>