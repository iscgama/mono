<?php

    require_once 'conexion.php';

    $idu = $_POST['idu'];
    $sucursal = $_POST['sucursal'];
    $concepto = $_POST['concepto'];
    $monto = $_POST['monto'];
    $tipo = $_POST['tipo'];    



    


    //Creamos una salida de dinero por la cantidad devuelta
    $sql = "INSERT INTO flujos (motivo_f, monto_f, fecha_f, 
                            hora_f, id_u, id_s, corte_f, tipo_f)
            VALUES (:concepto, :monto, NOW(),
                         NOW(), :idu, :sucursal, 0, :tipo)";
 


    $statement = $con->prepare($sql);
    $statement->bindParam(':concepto', $concepto);
    $statement->bindParam(':monto', $monto);
    $statement->bindParam(':idu', $idu);
    $statement->bindParam(':sucursal', $sucursal);
    $statement->bindParam(':tipo', $tipo); 
    

    $statement->execute();


    $sql = "SELECT MAX(id_f) As id_f FROM flujos WHERE id_u = " . $idu . " AND id_s = " . $sucursal . " AND motivo_f = '" . $concepto . "' AND monto_f = " . $monto . "";
    $res = $con->query($sql);
    $res->execute();

    $idf = 0;

    foreach ($res as $a) {
        $idf = $a['id_f'];
    }

    echo $idf;

?>