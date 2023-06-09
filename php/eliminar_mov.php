<?php


    require_once 'conexion.php';


    $id = $_POST['id'];

    $sql = "DELETE FROM caja WHERE id_cj = " . $id;
    $res = $con->query($sql);
    $res->execute();

    echo 1;


?>