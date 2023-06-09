<?php

    require_once '../conexion.php';

    $fechai = $_POST['fechai'];
    $fechaf = $_POST['fechaf'];
    $sucursal = $_POST['sucursal'];

    $totalvtas = 0;

    
    
    $salida = '<br>
                <table id="example" class="table dt-responsive table-striped table-bordered tablas" style="width:100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
            ';
    
    $sql = "SELECT DISTINCT(vp.id_a) FROM ventas2 vp 
                INNER JOIN ventas v ON vp.id_v = v.ventan_v
                INNER JOIN articulos a ON vp.id_a = a.id_a 
                WHERE v.id_s = " . $sucursal 
                    . " AND v.fecha_v BETWEEN '" . $fechai . "' AND '" . $fechaf . "' AND v.status_v = 1";
    

    $res = $con->query($sql);
    $res->execute();

    foreach ($res as $a) {

        //Obtenemos la descripcion y el precio
        $sql2 = "SELECT desc_a FROM articulos WHERE id_a = " . $a['id_a'];
        $res2 = $con->query($sql2);
        $res2->execute();

        $desca = 0;

        foreach ($res2 as $a2) {
            $desca = $a2['desc_a'];
        }
        
        //Obtenemos la cantidad de productos vendidos
        $sql2 = "SELECT SUM(vp.cant_v) As Cantidad, vp.precio_v, 
                    DATE_FORMAT(v.fecha_v, '%d-%m-%Y') As fecha_v FROM ventas2 vp 
                    INNER JOIN ventas v ON vp.id_v = v.ventan_v
                    WHERE vp.id_a = " . $a['id_a'] . " AND v.id_s = " . $sucursal
                    . " AND v.fecha_v BETWEEN '" . $fechai . "' AND '" . $fechaf . "' AND status_v ";

        
        $res2 = $con->query($sql2);
        $res2->execute();

        $num = 1;
        foreach ($res2 as $a2) {
            $salida .= '<tr>';
            $salida .= '
                        <td>' . $num .  '</td>
                        <td>' . $a2['fecha_v'] . '</td>
                        <td>' . $desca . '</td>
                        <td>' . number_format($a2['Cantidad'], 2) . '</td>
                        <td>$' . number_format($a2['precio_v'], 2) . '</td>
                        <td>$' . number_format($a2['Cantidad'] * $a2['precio_v'], 2) . '</td>
                        ';
            $salida .= '</tr>';
            $num++;
            $totalvtas += $a2['Cantidad'] * $a2['precio_v'];
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

<script>
    $(document).ready(function () {
        $('.tablas').DataTable();
    });
</script>