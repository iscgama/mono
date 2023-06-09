<?php

    require_once 'conexion.php';

    $desc = $_POST['desc'];
    $idu = $_POST['idu'];


    
    $sql = "SELECT id_c FROM clasificacion WHERE desc_c = '" . $desc . "'";
    //echo $sql;

    $res = $con->query($sql);
    $res->execute();


    $idc = 0;

    foreach ($res as $a) {
        $idc = $a['id_c'];
    }


    if ($idc == 0 && $idc != 1) {
        
        $sql = "INSERT INTO `clasificacion`(`id_c`, `desc_c`, `id_u`) 
                VALUES (null, :descrip, :idu);";
    
        $statement = $con->prepare($sql);
        $statement->bindParam(':descrip', $desc);
        $statement->bindParam(':idu', $idu);
    
    
        $statement->execute();
       
        
        echo 1;
    }else {
        echo 'La clasificacion que intentas registrar ya existe intente de nuevo con otra descripción';
    }


?>