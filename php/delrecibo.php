<?php


    require_once 'conexion.php';

    $id = $_POST['id'];

    $sql = "DELETE FROM recibos WHERE id_re = " . $id;
    $res = $con->query($sql);
    $res->execute();

    echo 1;

?>