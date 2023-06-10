<?php

    require_once 'conexion.php';

    
    $operacion = $_POST['operacion'];
    $razon = $_POST['razon'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $poblacion = $_POST['poblacion'];
    $estado = $_POST['estado'];
    $colonia = $_POST['colonia'];
    $saldo = $_POST['saldo'];
    $idu = $_POST['idu'];
    $anterior = $_POST['anterior'];


    if ( $saldo == '' ) {
        $saldo = 0;
    }

    if ($operacion == 0) {



        $sql = "INSERT INTO `proveedor`(`nom_pr`, `repr_pr`, `dir_pr`, `tel_pr`, 
                                        `pob_pr`, `est_pr`, `col_pr`, `saldo_pr`)
			    VALUES (:razon, :nombre, :direccion, :telefono, :poblacion,
                             :estado, :colonia, :saldo )";

        
        $stm = $con->prepare($sql);
        $stm->bindParam(':razon', $razon);
        $stm->bindParam(':nombre', $nombre);
        $stm->bindParam(':direccion', $direccion);
        $stm->bindParam(':telefono', $telefono);
        $stm->bindParam(':poblacion', $poblacion);
        $stm->bindParam(':estado', $estado);
        $stm->bindParam(':colonia', $colonia);
        $stm->bindParam(':saldo', $saldo);


        $stm->execute();
        
    }else {


        $sql = "SELECT id_pr FROM proveedor WHERE nom_pr = '" . $nombre . "' AND id_pr <> '" . $anterior . "'";
        $res = $con->query($sql);
        $res->execute();


        $repetido = 0;

        foreach ($res as $a) {
            $repetido++;
        }

        if ($repetido > 0) {
            echo 'El proveedor que intentas actualizar ya existe';
        }else {
            $sql = "UPDATE proveedor SET nom_pr = :razon, repr_pr = :nombre, dir_pr = :direccion,
                            tel_pr = :telefono, pob_pr = :poblacion, est_pr = :estado,
                            col_pr = :colonia, saldo_pr = :saldo
                    WHERE id_pr = :anterior";
            
    
            $statement = $con->prepare($sql);
            $statement->bindParam(':razon', $razon);
            $statement->bindParam(':nombre', $nombre);
            $statement->bindParam(':direccion', $direccion);
            $statement->bindParam(':telefono', $telefono);
            $statement->bindParam(':poblacion', $poblacion);
            $statement->bindParam(':estado', $estado);
            $statement->bindParam(':colonia', $colonia);
            $statement->bindParam(':saldo', $saldo);
            $statement->bindParam(':anterior', $anterior);

            $statement->execute();
        }
    }


    echo 1;

?>