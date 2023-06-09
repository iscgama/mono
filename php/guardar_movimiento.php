<?php


    require_once 'conexion.php';


    $concepto = $_POST['concepto'];
    $monto = $_POST['monto'];
    $fecha = $_POST['fecha'];
    $tipo = $_POST['tipo'];

    if ($tipo == 1) {
        $tipo = 'I';
    }else {
        $tipo = 'E';
    }

    $sql = "INSERT INTO `caja`( `fecha_cj`, `concepto_cj`, `monto_cj`, `tipo_cj`, `status_cj`)   
                    VALUES (:fecha, :concepto, :monto, :tipo, 0);";
    
            
    $statement = $con->prepare($sql);
    $statement->bindParam(':fecha', $fecha);
    $statement->bindParam(':concepto', $concepto);
    $statement->bindParam(':monto', $monto);
    $statement->bindParam(':tipo', $tipo);


    $statement->execute();

    echo 1;


?>