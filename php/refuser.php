<?php

    require_once 'conexion.php';
    
    
    $anterior = $_POST['anterior'];
    $nombre = $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $pass = $_POST['pass'];
    $roles = $_POST['roles'];
    $sucursales = $_POST['sucursales'];
   
    
    
    //Consultar ID de rol
    $sql = "SELECT id_r FROM roles WHERE desc_r = '" . $roles . "'";
    $res = $con->query($sql);
    $res->execute();

    foreach ($res as $a) {
        $roles = $a['id_r'];
    }

    //Consultar ID de sucursal
    $sql = "SELECT id_s FROM sucursales WHERE nom_s = '" . $sucursales . "'";
    $res = $con->query($sql);
    $res->execute();

    foreach ($res as $a) {
        $sucursales = $a['id_s'];
    }      

    
    if ($usuario <> $anterior) {
        $sql = "SELECT user_u FROM usuarios WHERE user_u = '" . $usuario . "'";
        $res = $con->query($sql);
        $res->execute();
        $cont = 0;

        foreach ($res as $a) {
            $cont++;           
        }
    }else {
        $cont = 0;
    }
    

    if ($cont > 0) {
        echo 'El usuario que intentas actualizar ya existe';
    }else {
        $sql = "UPDATE usuarios SET name_u = '" . $nombre . "', user_u = '" . $usuario . "', pass_u = '" . $pass . "', id_r = " . $roles . ", id_s = " . $sucursales . " WHERE user_u = '" . $anterior . "'";
        $res = $con->query($sql);
        $res->execute();

        
        echo 1;
    }


?>