<?php

    require_once 'conexion.php';

    
    $operacion = $_POST['operacion'];
    $sucursal = $_POST['sucursal'];
    $anterior = $_POST['anterior'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $cp = $_POST['cp'];
    $ciudad = $_POST['ciudad'];
    $estado = $_POST['estado'];
    $idu = $_POST['idu'];
    
    

    if ($operacion == 0) {
        $sql = "INSERT INTO `sucursales`(`id_s`, `nom_s`, `dir_s`, `tel_s`, `cp_s`, 
                                        `ciudad_s`, `estado_s`) 
			    VALUES (null, :sucursal, :direccion, :telefono, :cp, :ciudad, :estado);";

        
        $statement = $con->prepare($sql);
        $statement->bindParam(':sucursal', $sucursal);
        $statement->bindParam(':direccion', $direccion);
        $statement->bindParam(':telefono', $telefono);
        $statement->bindParam(':cp', $cp);
        $statement->bindParam(':ciudad', $ciudad);
        $statement->bindParam(':estado', $estado);


        $statement->execute();

        echo 1;
        
    }else {


        $sql = "SELECT id_s FROM sucursales WHERE nom_s = '" . $sucursal . "' AND id_s <> " . $anterior;
        $res = $con->query($sql);
        $res->execute();


        $repetido = 0;

        foreach ($res as $a) {
            $repetido++;
        }

        if ($repetido > 0) {
            echo 'La sucursal que intentas actualizar ya existe';
        }else {
            $sql = "UPDATE `sucursales` SET `nom_s`= :sucursal,`dir_s`= :direccion,
                            `tel_s`= :telefono,`cp_s`= :cp,`ciudad_s`= :ciudad,
                            `estado_s`= :estado WHERE `id_s` = :anterior";

            $statement = $con->prepare($sql);
            $statement->bindParam(':sucursal', $sucursal);
            $statement->bindParam(':direccion', $direccion);
            $statement->bindParam(':telefono', $telefono);
            $statement->bindParam(':cp', $cp);
            $statement->bindParam(':ciudad', $ciudad);
            $statement->bindParam(':estado', $estado);
            $statement->bindParam(':anterior', $anterior);


            $statement->execute();

            echo 1;
        }
    }


    
    //echo '$ida= ' .  $ida . ' idc=' . $idc;


?>