<?php

    require_once 'conexion.php';

    $desc = $_POST['desc'];
    $idu = $_POST['idu'];


    
    $sql = "SELECT id_cs FROM conceptos_sal WHERE desc_cs = '" . $desc . "'";
    //echo $sql;

    $res = $con->query($sql);
    $res->execute();


    $idc = 0;

    foreach ($res as $a) {
        $idc = $a['id_cs'];
    }


    if ($idc == 0 && $idc != 1) {
        
        $sql = "INSERT INTO `conceptos_sal`(`id_cs`, `desc_cs`, `id_u`) 
                VALUES (null, :descrip, :idu);";
    
        $statement = $con->prepare($sql);
        $statement->bindParam(':descrip', $desc);
        $statement->bindParam(':idu', $idu);
    
    
        $statement->execute();
       
        
        echo 1;
    }else {
        echo 'El concepto que intentas registrar ya existe intente de nuevo con otra descripción';
    }


?>