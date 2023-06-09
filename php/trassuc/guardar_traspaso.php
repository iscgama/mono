<?php

    require_once '../conexion.php';

    $sucursal = $_POST['sucursal'];
    $origen = $_POST['origen'];
    $numtras = $_POST['numtras'];


    function nom_suc ($id, $con) {
        //Consultamos el ID de la sucursal seleccionada
        $sql = "SELECT id_s FROM sucursales WHERE nom_s = '" . $id . "'";
        $res = $con->query($sql);
        $res->execute();

        $ids = 0;

        foreach ($res as $a) {
            $ids = $a['id_s'];
        }

        return $ids;
    }

    $id_origen = nom_suc($origen, $con);
    $id_destino = nom_suc($sucursal, $con);

    

    if ($id_origen != 0 && $id_destino != 0) {
        $sql = "UPDATE traspasos SET id_s = " . $id_destino . ", origen_tr = " . $id_origen . " WHERE traspason_tr = " . $numtras;
        $res = $con->query($sql);
        $res->execute();

        echo 1;
    }else {
        echo 'La(s) sucursal(es) seleccionada(s) no existe(n), intenta con otro(s) nombre(s)';
    }

?>