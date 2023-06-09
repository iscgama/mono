<?php

    require_once 'conexion.php';

    $nombre = $_POST['nombre'];
    $direccion = $_POST['dir'];
    $telefono = $_POST['tel'];
    $codigo = $_POST['codigo'];
    $ciudad = $_POST['ciudadr'];
    $estado = $_POST['estador'];

    $sql = "UPDATE datos_emp SET nom_emp = :nombre, dir_emp = :direccion, tel_emp = :telefono,
                cp_emp = :codigo, ciudad_emp = :ciudad, estado_emp = :estado
            WHERE id_emp = 1";

    $statement = $con->prepare($sql);
    $statement->bindParam(':nombre', $nombre);
    $statement->bindParam(':direccion', $direccion);
    $statement->bindParam(':telefono', $telefono);
    $statement->bindParam(':codigo', $codigo);
    $statement->bindParam(':ciudad', $ciudad);
    $statement->bindParam(':estado', $estado);


    $statement->execute();


?>