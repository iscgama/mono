<?php

    require_once 'conexion.php';

    
    $operacion = $_POST['operacion'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $poblacion = $_POST['poblacion'];
    $estado = $_POST['estado'];
    $lista = $_POST['lista'];
    $clasifica = $_POST['clasifica'];
    $limite = $_POST['limite'];
    $idu = $_POST['idu'];
    $anterior = $_POST['anterior'];


    
        
    //Consultamos el ID de la clasificacion del producto
    $sql = "SELECT id_ctc FROM clasifcte WHERE desc_ctc = '" . $clasifica . "'";
    $res = $con->query($sql);
    $res->execute();


    $idc = '';

    foreach ($res as $a) {
        $idc = $a['id_ctc'];
    }
    

    if ($operacion == 0) {
        $sql = "INSERT INTO `clientes`(`id_ct`, `nom_ct`, `dir_ct`, `tel_ct`, `pob_ct`,
                                     `est_ct`, `saldo_ct`, `lprecio_ct`, `id_ctc`, `limite_ct`) 
			    VALUES (null, :nombre, :direccion, :telefono, :poblacion, :estado,
                        0.00, :lista, :clasifica, :limite);";

        
        $statement = $con->prepare($sql);
        $statement->bindParam(':nombre', $nombre);
        $statement->bindParam(':direccion', $direccion);
        $statement->bindParam(':telefono', $telefono);
        $statement->bindParam(':poblacion', $poblacion);
        $statement->bindParam(':estado', $estado);
        $statement->bindParam(':lista', $lista);
        $statement->bindParam(':clasifica', $idc);
        $statement->bindParam(':limite', $limite);


        $statement->execute();
        
    }else {


        $sql = "SELECT id_ct FROM clientes WHERE nom_ct = '" . $nombre . "' AND id_ct <> '" . $anterior . "'";
        $res = $con->query($sql);
        $res->execute();


        $repetido = 0;

        foreach ($res as $a) {
            $repetido++;
        }

        if ($repetido > 0) {
            echo 'El cliente que intentas actualizar ya existe';
        }else {
            $sql = "UPDATE clientes SET nom_ct = :nombre, dir_ct = :direccion,
                            tel_ct = :telefono, pob_ct = :poblacion, est_ct = :estado,
                            lprecio_ct = :lista, id_ctc = :clasifica, limite_ct = :limite
                    WHERE id_ct = :anterior";

    
            $statement = $con->prepare($sql);
            $statement->bindParam(':nombre', $nombre);
            $statement->bindParam(':direccion', $direccion);
            $statement->bindParam(':telefono', $telefono);
            $statement->bindParam(':poblacion', $poblacion);
            $statement->bindParam(':estado', $estado);
            $statement->bindParam(':lista', $lista);
            $statement->bindParam(':clasifica', $idc);
            $statement->bindParam(':limite', $limite);
            $statement->bindParam(':anterior', $anterior);

            $statement->execute();
        }
    }

    echo 1;


?>