<?php

    require_once 'conexion.php';


    $sucursal = $_POST['sucursal'];
    $usuario = $_POST['usuario'];
    $dinero = $_POST['dinero'];

    $salida = '';


    //Obtenermos el consecutivo de corte de caja y lo incrementos en 1
    $sql = "SELECT cortes_cs FROM consecutivos WHERE id_cs = 1";
    $res = $con->query($sql);
    $res->execute();

    foreach ($res as $a) {
        $consecutivo = $a['cortes_cs'];
    }

    $consecutivo++;


    //Actualizamos el num corte
     //Cerramos todas las ventas del corte
     $sql = "UPDATE consecutivos SET cortes_cs = " . $consecutivo . " WHERE id_cs = " . 1;
     $res = $con->query($sql);
     $res->execute();


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

     $total_vtas = $efectivo;
     $total_vtas += ($ingresos - $egresos);

     $dineroextra = abs($total_vtas - $dinero);


     $palabra = ($dineroextra < 0) ? 'SOBRANTE: ' : 'FALTANTE: ';

    $salida = '
                <center>
                    CORTE #: ' . $consecutivo . ' <br>
                    <b>Sucursal:</b> ' . $nom_s . ' <br>
                    <b>Usuario:</b> ' . $usuario . ' <br>
                    <b>Fecha/Hora:</b> ' . date('d-m-Y') . ' / ' . date('H:m:i') . ' <br>
                    ------------------------------------------ <br>
                    <b>DETALLE DE VENTAS</b> <br>
                    ------------------------------------------ <br>
                    Ventas en efectivo: $ ' . number_format($efectivo, 2) . ' <br>
                    Ventas con tarjeta: $ ' . number_format($tarjeta, 2) . ' <br>
                    Ventas a crédito: $ ' . number_format($credito, 2) . ' <br>
                    ------------------------------------------ <br>
                    Total de ventas: $ ' . number_format($efectivo, 2) . ' <br>
                    ------------------------------------------ <br>
                    DETALLE DE MOVIMIENTOS DE CAJA <br>
                    ------------------------------------------ <br>
                    Ingresos: $ ' . number_format($ingresos, 2) . ' <br>
                    Egresos: $ ' . number_format($egresos, 2) . ' <br>
                    ------------------------------------------ <br>
                    Total de movimientos de caja: $ ' . number_format($ingresos - $egresos, 2) . ' <br>
                    ------------------------------------------ <br><br>
                    TOTAL EN CAJA: $ ' . number_format($total_vtas, 2) . ' <br>
                    DINERO CONTADO: $ ' .  number_format($dinero, 2) .  ' <br> ' 
                    . $palabra . ' $ ' . number_format($dineroextra, 2)  . ' <br>
                    -------------------------------------------
                </center>
               ';

    // // Consultar las ventas antes de cerrar el corte
    
    $productos = array();
    $cantidades =array();
    $productos =array();
    


    $sql = "SELECT ventan_v FROM ventas 
                WHERE corte_v = 0 AND status_v = 1";
    $res = $con->query( $sql );
    $res->execute( );

    if ($res->rowCount() > 0) {
        foreach ($res as $a) {
            $busq = "SELECT id_a, cant_v
                    FROM ventas2 
                    WHERE id_v = " . $a['ventan_v'];
            $res2 = $con->query( $busq );
            $res2->execute( );

            if ($res2->rowCount() > 0) {
                foreach ($res2 as $a2) {
                    $numero = array_search( $a2['id_a'], $productos );
                    if ( is_numeric( $numero ) ) {
                        $cantidades[ $numero ] += $a2['cant_v'];
                    }else {
                        $productos[] = $a2['id_a'];
                        $cantidades[] = $a2['cant_v'];
                    }
                }
            }
        }
    }

    $salida .= '<br>
        Se encontraron: ' .count($productos) .  '
    ';

    for ($a=0; $a < count( $productos ); $a++) { 
        $salida .= $productos[$a] . '<br>';
    }
   

    



    require '../phpmailer/PHPMailer.php';
    require '../phpmailer/SMTP.php';
    require '../phpmailer/Exception.php';


    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;


    $mail = new PHPMailer();

    $mail->isSMTP();

    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = "true";
    $mail->SMTPSecure = "ssl";
    $mail->Port = 465;
    $mail->isHTML(true);
    $mail->Username = "correo.mail.gamasoft@gmail.com";
    $mail->Password = "pawpnuudqooixvny";
    $mail->Subject = "Corte";
    $mail->setFrom("correo.mail.gamasoft@gmail.com");

    $mail->Body = $salida;
    $mail->addAddress("iscgama@gmail.com");


    if ($mail->Send()) {
        echo "Send good...";
    }else {
        echo "Error not send";
    }


    $mail->smtpClose();
    

    //Cerramos todas las ventas del corte
    $sql = "UPDATE ventas SET corte_v = 1 WHERE corte_v = 0 AND id_s = " . $sucursal;
    $res = $con->query($sql);
    $res->execute();

    //Cerramos todas los flujos de caja
    $sql = "UPDATE flujos SET corte_f = 1 WHERE corte_f = 0 AND id_s = " . $sucursal;
    $res = $con->query($sql);
    $res->execute();

    

    echo 1;
?>