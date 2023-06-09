<?php

    require_once 'conexion.php';

    $forma = $_POST['forma'];
    $monto = $_POST['monto'];
    $adeudo = $_POST['adeudo'];
    $cliente = $_POST['cliente'];
    $id = $_POST['id'];
    $idu = $_POST['idu'];

    $restante = $adeudo - $monto;


    //Obtener ID cliente
    $sql = "SELECT id_ct, saldo_ct FROM clientes WHERE nom_ct = '" . $cliente . "'";
    $res = $con->query($sql);
    $res->execute();

    $idc = 0;
    $saldo_ct = 0;

    foreach ($res as $a) {
        $idc = $a['id_ct'];
        $saldo_ct = $a['saldo_ct'];
    }

    //Primero insertamos el renglon de abonos
    $sql = "INSERT INTO `abonos`(`id_ab`, `id_cb`, `fecha_ab`, `hora_ab`, 
                            `forma_ab`, `monto_cb`, `id_u`) 
                VALUES (NULL, :cobranza, NOW(), NOW(), :forma, :monto, :idu)";
    

    $statement = $con->prepare($sql);
    $statement->bindParam(':cobranza', $id);
    $statement->bindParam(':forma', $forma);
    $statement->bindParam(':monto', $monto);
    $statement->bindParam(':idu', $idu);
    $statement->execute();

   $saldoactual = $saldo_ct - $monto;


    //Actualizamos el saldo de la cobranza del cliente
    $sql = "UPDATE cobranza SET saldo_cb = " . $restante . " WHERE id_cb = " . $id;
    $res = $con->query($sql);
    $res->execute();

    //Actualizamos el saldo del cliente
    $sql = "UPDATE clientes SET saldo_ct = " . $saldoactual . " WHERE id_ct = " . $idc;
    $res = $con->query($sql);
    $res->execute();

    //Obtenemos el ID Maximo de abono
    $sql = "SELECT MAX(id_ab) As Maximo FROM abonos";

    $res = $con->query($sql);
    $res->execute();

    $abono = 0;

    foreach ($res as $a) {
        $abono = $a['Maximo'];
    }

    echo $abono;
?>