<?php


    require_once 'conexion.php';

    $nombre = $_POST['nombre'];
    $concepto = $_POST['concepto'];
    $monto = $_POST['monto'];
    $fecha = $_POST['fecha'];

    $sql = "INSERT INTO `recibos`(`id_re`, `nombre_re`, `concepto_re`, `monto_re`, `fecha_re`, `status_re`)   
                    VALUES (null, :nombre, :concepto, :monto, :fecha, 0);";
    
            
    $statement = $con->prepare($sql);
    $statement->bindParam(':nombre', $nombre);
    $statement->bindParam(':concepto', $concepto);
    $statement->bindParam(':monto', $monto);
    $statement->bindParam(':fecha', $fecha);


    $statement->execute();


    $sql = "SELECT MAX(id_re) As Maximo FROM recibos";
    $res = $con->query($sql);
    $res->execute();

    $recibo = 0;

    foreach ($res as $a) {
        $recibo = $a['Maximo'];
    }

    echo $recibo;

?>