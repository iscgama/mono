<?php

    require_once 'conexion.php';

    $id = $_POST['id'];

    $sql = "DELETE FROM articulos WHERE id_a = " . $id;


    $res = $con->query($sql);
    $res->execute();

    echo 1;
?>