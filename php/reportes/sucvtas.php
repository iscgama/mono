<?php

    require_once '../conexion.php';

    $sucursal = $_POST['sucursal'];
    $fechai = $_POST['fechai'];
    $fechaf = $_POST['fechaf'];
    $totalvtas = 0;

    $condicion = '';
    
    //Si el reporte maneja un usuario entonces bucamos el ID en la BD
    if ($sucursal != '') {
        $sql = "SELECT id_s FROM sucursales WHERE nom_s = '" . $sucursal . "'";
        $res = $con->query($sql);
        $res->execute();

        $ids = 0;

        foreach ($res as $a) {
            $ids = $a['id_s'];
        }

        if ($ids != 0) {
            $condicion = " WHERE id_s = " . $ids;
        }else {
            $condicion = '';
        }
    }
    
    $salida = '<br>
                <table id="example" class="table dt-responsive table-striped table-bordered tablas" style="width:100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Sucursal</th>
                    <th>Ventas</th>
                </tr>
            </thead>
            <tbody>
            ';
    
    $sql = "SELECT id_s, nom_s FROM sucursales" . $condicion;
    $res = $con->query($sql);
    $res->execute();
    $num = 1;
    foreach ($res as $a) {
        $sql2 = "SELECT SUM(monto_v) As Total FROM ventas WHERE id_s = " . $a['id_s'] 
                    . " AND fecha_v BETWEEN '" . $fechai . "' AND '" . $fechaf . "'";
        
        $res2 = $con->query($sql2);
        $res2->execute();
        
        foreach ($res2 as $a2) {
            $salida .= '<tr>';
            $salida .= '
                        <td>' . $num .  '</td>
                        <td>' . $a['nom_s'] . '</td>
                        <td>$' . number_format($a2['Total'], 2) . '</td>
                        ';
            $salida .= '</tr>';
            $num += 1;
            $totalvtas += $a2['Total'];
        }

    }

    $salida .= '</tbody></table>
                <br>
                <center>
                    <h1 class="title">
                        Total de ventas: $' . number_format($totalvtas, 2) . '
                    </h1>
                </center>
                ';

    echo $salida;

    
?>