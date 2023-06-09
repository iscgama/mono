<?php

    require_once 'conexion.php';
    
    $sucursal = $_POST['sucursal'];
    $usuario = $_POST['usuario'];

    $salida = '';


    //Obtenermos el consecutivo de corte de caja y lo incrementos en 1
    $sql = "SELECT cortes_cs FROM consecutivos WHERE id_cs = 1";
    $res = $con->query($sql);
    $res->execute();

    foreach ($res as $a) {
        $consecutivo = $a['cortes_cs'];
    }

    $consecutivo++;


    //Obtenemos los datos de la sucursal de la que haremos corte
    $sql = "SELECT `id_s`, `nom_s`, `dir_s`, `tel_s`, `cp_s`, 
                    `ciudad_s`, `estado_s` FROM sucursales WHERE id_s = " . $sucursal;
    $res = $con->query($sql);
    $res->execute();

    $id_s = '';
    $nom_s = '';
    $dir_s = '';
    $tel_s = '';
    $cp_s = '';
    $ciudad_s = '';
    $estado_s = '';


    foreach ($res as $a) {
        $id_s = $a['id_s'];
        $nom_s = $a['nom_s'];
        $dir_s = $a['dir_s'];
        $tel_s = $a['tel_s'];
        $cp_s = $a['cp_s'];
        $ciudad_s = $a['ciudad_s'];
        $estado_s = $a['estado_s'];
    }


    //Obtenermos total de ventas en efectivo realizadas
    $efectivo = 0;

    $sql = "SELECT SUM(monto_v) As Efectivo 
                FROM ventas WHERE status_v = 1 AND corte_v = 0 
                AND forma_v='Efectivo'
                AND id_s = " . $sucursal;
    $res = $con->query($sql);
    $res->execute();

    foreach ($res as $a) {
        $efectivo = $a['Efectivo'];
    }

    $efectivo = ($efectivo == null ? 0 : $efectivo);

    //Obtenermos total de ventas con tarjeta realizadas
    $tarjeta = 0;

    $sql = "SELECT SUM(monto_v) As Tarjeta 
                FROM ventas WHERE status_v = 1 AND corte_v = 0 
                AND forma_v='Tarjeta'
                AND id_s = " . $sucursal;
    $res = $con->query($sql);
    $res->execute();

    foreach ($res as $a) {
        $tarjeta = $a['Tarjeta'];
    }

    $tarjeta = ($tarjeta == null ? 0 : $tarjeta);

    //Obtenermos total de ventas con credito realizadas
    $credito = 0;

    $sql = "SELECT SUM(monto_v) As Credito 
                FROM ventas WHERE status_v = 1 AND corte_v = 0 
                AND forma_v='Credito'
                AND id_s = " . $sucursal;
    $res = $con->query($sql);
    $res->execute();

    foreach ($res as $a) {
        $credito = $a['Credito'];
    }

    $credito = ($credito == null ? 0 : $credito);

     //Obtenemos total de ingresos de caja
     $ingresos = 0;

     $sql = "SELECT SUM(monto_f) As Ingresos 
                 FROM flujos WHERE corte_f = 0 
                 AND tipo_f = 'I'
                 AND id_s = " . $sucursal;
     $res = $con->query($sql);
     $res->execute();
 
     foreach ($res as $a) {
         $ingresos = $a['Ingresos'];
     }
 
     $ingresos = ($ingresos == null ? 0 : $ingresos);

     //Obtenemos total de egresos de caja
     $egresos = 0;

     $sql = "SELECT SUM(monto_f) As Egresos 
                 FROM flujos WHERE corte_f = 0 
                 AND tipo_f = 'E'
                 AND id_s = " . $sucursal;
     $res = $con->query($sql);
     $res->execute();
 
     foreach ($res as $a) {
         $egresos = $a['Egresos'];
     } 
 
     $egresos = ($egresos == null ? 0 : $egresos);

     $total_vtas = 0;

     $total_vtas = $efectivo + $tarjeta;
     $total_vtas += ($ingresos - $egresos);

    $salida = '
                <center>
                    Corte diario: ' . $consecutivo . ' <br>
                    <hr class="display-4">
                    Sucursal: ' . $nom_s . ' <br>
                    Usuario: ' . $usuario . ' <br>
                    Fecha/Hora: ' . date('d-m-Y') . ' / ' . date('H:m:i') . ' <br>
                    ------------------------------------------ <br>
                    DETALLE DE VENTAS <br>
                    ------------------------------------------ <br>
                    Ventas en efectivo: $ ' . number_format($efectivo, 2) . ' <br>
                    Ventas con tarjeta: $ ' . number_format($tarjeta, 2) . ' <br>
                    Ventas a crédito: $ ' . number_format($credito, 2) . ' <br>
                    ------------------------------------------ <br>
                    Total de ventas: $ ' . number_format($efectivo + $tarjeta, 2) . ' <br>
                    ------------------------------------------ <br>
                    DETALLE DE MOVIMIENTOS DE CAJA <br>
                    ------------------------------------------ <br>
                    Ingresos: $ ' . number_format($ingresos, 2) . ' <br>
                    Egresos: $ ' . number_format($egresos, 2) . ' <br>
                    ------------------------------------------ <br>
                    Total de movimientos de caja: $ ' . number_format($ingresos - $egresos, 2) . ' <br>
                    ------------------------------------------ <br><br>
                    TOTAL EN CAJA: $ ' . number_format($total_vtas, 2) . ' <br>
                    -------------------------------------------
                </center>
               ';

    

    echo $salida;
?>