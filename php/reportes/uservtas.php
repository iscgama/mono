<?php

    require_once '../conexion.php';

    $usuario = $_POST['usuario'];
    $fechai = $_POST['fechai'];
    $fechaf = $_POST['fechaf'];
    $totalvtas = 0;

    $condicion = '';
    
    //Si el reporte maneja un usuario entonces bucamos el ID en la BD
    if ($usuario != '') {
        $sql = "SELECT id_u FROM usuarios WHERE name_u = '" . $usuario . "'";
        $res = $con->query($sql);
        $res->execute();

        $idu = 0;

        foreach ($res as $a) {
            $idu = $a['id_u'];
        }

        if ($idu != 0) {
            $condicion = " WHERE id_u = " . $idu;
        }else {
            $condicion = '';
        }
    }
    
    $salida = '<br>
                <table id="example" class="table dt-responsive table-striped table-bordered tablas" style="width:100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Usuario</th>
                    <th>Ventas</th>
                </tr>
            </thead>
            <tbody>
            ';
    
    $sql = "SELECT id_u, name_u FROM usuarios" . $condicion;
    $res = $con->query($sql);
    $res->execute();

    foreach ($res as $a) {
        $sql2 = "SELECT SUM(monto_v) As Total FROM ventas WHERE id_u = " . $a['id_u'] 
                    . " AND fecha_v BETWEEN '" . $fechai . "' AND '" . $fechaf . "'";
        
        $res2 = $con->query($sql2);
        $res2->execute();
        $num = 1;
        foreach ($res2 as $a2) {
            $salida .= '<tr>';
            $salida .= '
                        <td>' . $num .  '</td>
                        <td>' . $a['name_u'] . '</td>
                        <td>$' . number_format($a2['Total'], 2) . '</td>
                        ';
            $salida .= '</tr>';
            $num++;
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