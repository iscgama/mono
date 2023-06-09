<?php

    require_once 'conexion.php';

    
    $operacion = $_POST['operacion'];
    $nombre = $_POST['nombre'];
    $pin = $_POST['pin'];
    $sucursales = $_POST['sucursales'];
    $anterior = $_POST['anterior'];
    

        
    //Consultamos el ID de la sucursal
    $sql = "SELECT id_s FROM sucursales WHERE nom_s = '" . $sucursales . "'";
    $res = $con->query($sql);
    $res->execute();


    $ids = '';

    foreach ($res as $a) {
        $ids = $a['id_s'];
    }
    

    if ($operacion == 0) {

        //Consultamos que no se repita el pin del cajero
        $sql = "SELECT id_ca FROM cajeros WHERE pin_ca = '" . $pin . "'";
        $res = $con->query($sql);
        $res->execute();

        $numca = 0;

        foreach ($res as $a) {
            $numca = $a['id_ca'];
        }

        if ($numca == 0) {
            
            $sql = "INSERT INTO `cajeros`(`id_ca`, `nom_ca`, `pin_ca`, `id_s`) 
                    VALUES (null, :nombre, :pin, :ids);";
    
            
            $statement = $con->prepare($sql);
            $statement->bindParam(':nombre', $nombre);
            $statement->bindParam(':pin', $pin);
            $statement->bindParam(':ids', $ids);
    
            $statement->execute();
            echo 1;
        }else {
            echo 'El PIN del cajero ya esta registrado intente con otro diferente';
        }

        
        
    }else {

        $sql = "SELECT id_ca FROM cajeros WHERE nom_ca = '" . $nombre . "' AND id_ca <> '" . $anterior . "'";
        $res = $con->query($sql);
        $res->execute();


        $repetido = 0;

        foreach ($res as $a) {
            $repetido++;
        }

        if ($repetido > 0) {
            echo 'El cajero que intentas actualizar ya existe';
        }else {
            $sql = "UPDATE cajeros SET nom_ca = :nombre, pin_ca = :pin, id_s = :ids
                         WHERE id_ca = :anterior";

    
            $statement = $con->prepare($sql);
            $statement->bindParam(':nombre', $nombre);
            $statement->bindParam(':pin', $pin);
            $statement->bindParam(':ids', $ids);
            $statement->bindParam(':anterior', $anterior);

            $statement->execute();

            echo 1;
        }

    }

?>