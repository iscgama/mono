<?php
	include "fpdf/fpdf.php";

    $sucursal = $_GET['sucursal'];
    $usuario = $_GET['usuario'];
	$contado = $_GET['contado'];
    
	require_once '../php/conexion.php';



	//Obtenemos todos los datos de la empresa
	$sql = "SELECT nom_emp, dir_emp, tel_emp, cp_emp, ciudad_emp, estado_emp 
			FROM datos_emp 
			WHERE id_emp = 1
	";

	

	
	$resultado = $con->query($sql);
	$resultado->execute();

	$nom_emp = '';
	$dir_emp = '';
	$tel_emp = '';
	$cp_emp = '';
	$ciudad_emp = '';
	$estado_emp = '';

	

	foreach ($resultado as $fila) {	
		$nom_emp = $fila['nom_emp'];
		$dir_emp = $fila['dir_emp'];
		$tel_emp = $fila['tel_emp'];
		$cp_emp = $fila['cp_emp'];
		$ciudad_emp = $fila['ciudad_emp'];
		$estado_emp = $fila['estado_emp'];
	}



    //Obtenermos el consecutivo de corte de caja y lo incrementos en 1
    $sql = "SELECT cortes_cs FROM consecutivos WHERE id_cs = 1";
    $res = $con->query($sql);
    $res->execute();

    foreach ($res as $a) {
        $consecutivo = $a['cortes_cs'];
    }

    $consecutivo++;


    //Obtenemos los datos de la sucursal de la que haremos corte
    $sql = "SELECT `nom_s`, `dir_s`, `tel_s`, `cp_s`, 
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
                FROM ventas WHERE status_v = 1 
                AND corte_v = 0 AND forma_v='Efectivo'
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
                FROM ventas WHERE status_v = 1 
                AND corte_v = 0 AND forma_v='Tarjeta'
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
                 FROM flujos WHERE corte_f = 0 AND tipo_f = 'I'
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
                 FROM flujos WHERE corte_f = 0 AND tipo_f = 'E'
                 AND id_s = " . $sucursal;
     $res = $con->query($sql);
     $res->execute();
 
     foreach ($res as $a) {
         $egresos = $a['Egresos'];
     }
 
     $egresos = ($egresos == null ? 0 : $egresos);

     $total_vtas = 0;

     $total_vtas = $efectivo ;
     $total_vtas += ($ingresos - $egresos);

 
	

	$pdf = new FPDF($orientation='P',$unit='mm', array(45,350));
	$pdf->AddPage();
	$textypos = 5;
	$pdf->Image('../img/logo.jpg',9,2.5,33);
	$pdf->SetFont('Helvetica','', 7);    //Letra Helvetica, negrita (Bold), tam. 20
	$textypos+=30;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode($nom_emp), 0, 0, 'C');
	$textypos+=6;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode($dir_emp), 0, 0, 'C');
	$textypos+=6;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Teléfono: ' . $tel_emp), 0, 0, 'C');
	$textypos+=6;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode($ciudad_emp . ',' . $estado_emp . ', C.P.: ' . $cp_emp), 0, 0, 'C');
	$textypos+=6;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,'_________________________________________________', 0, 0, 'C');
	$pdf->SetFont('Helvetica','B', 8);    //Letra Helvetica, negrita (Bold), tam. 20
	$textypos+=8;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Corte #' . $consecutivo), 0, 0, 'C');
	$pdf->SetFont('Helvetica','', 7);    //Letra Helvetica, negrita (Bold), tam. 20
	$textypos+=8;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Fecha / Hora:' . date('d-m-Y') . ' / ' . date('H:m:i')), 0, 0, 'C');
	$textypos+=6;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Usuario: ' . $usuario), 0, 0, 'C');
	$textypos+=6;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Sucursal: ' . $nom_s), 0, 0, 'C');
	$textypos+=6;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,'_________________________________________________', 0, 0, 'C');
	$pdf->SetFont('Helvetica','B', 9);
	$textypos+=7;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('DETALLE DE VENTAS'), 0, 0, 'C');
	$pdf->SetFont('Helvetica','', 6);
	$textypos+=4;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,'_________________________________________________', 0, 0, 'C');
	$textypos+=7;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Ventas en efectivo: $ ' . number_format($efectivo, 2)), 0, 0, 'L');
    $textypos+=6;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Ventas con tarjeta: $ ' . number_format($tarjeta, 2)), 0, 0, 'L');
	$textypos+=6;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Ventas a crédito: $ ' . number_format($credito, 2)), 0, 0, 'L');
	$textypos+=2;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,'_________________________________________________', 0, 0, 'C');
    $textypos+=7;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Total de ventas: $ ' . number_format($efectivo + $tarjeta, 2)), 0, 0, 'L');
	$textypos+=2;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,'_________________________________________________', 0, 0, 'C');
    $textypos+=6;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,'_________________________________________________', 0, 0, 'C');
	$pdf->SetFont('Helvetica','B', 9);
	$textypos+=7;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('MOVIMIENTOS DE CAJA'), 0, 0, 'C');
	$pdf->SetFont('Helvetica','', 6);
	$textypos+=4;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,'_________________________________________________', 0, 0, 'C');
	$textypos+=7;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Ingresos: $ ' . number_format($ingresos, 2)), 0, 0, 'L');
    $textypos+=6;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Egresos: $ ' . number_format($egresos, 2)), 0, 0, 'L');
	$textypos+=2;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,'_________________________________________________', 0, 0, 'C');
    $textypos+=7;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Total: $ ' . number_format($ingresos - $egresos, 2)), 0, 0, 'L');
	$textypos+=2;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,'_________________________________________________', 0, 0, 'C');
    $textypos+=7;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('TOTAL DE CAJA: $' . number_format($total_vtas,2)), 0, 0, 'L');
	if ($contado > 0) {
		$textypos+=6;
		$pdf->setX(1);
		$pdf->Cell(45,$textypos,utf8_decode('DINERO CONTADO: $ ' . number_format($contado, 2)), 0, 0, 'L');
		if ($contado > $total_vtas) {
			$mostrar_m = 'SOBRANTE: ' . number_format($contado - abs($total_vtas), 2);
		}else {
			$mostrar_m = 'FALTANTE: ' . number_format($contado - abs($total_vtas), 2);
		}
		$textypos+=6;
		$pdf->setX(1);
		$pdf->Cell(45,$textypos,utf8_decode($mostrar_m), 0, 0, 'L');
	}
	$pdf->SetFont('Helvetica','', 6);
	$textypos+=4;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,'_________________________________________________', 0, 0, 'C');


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


	for ($a=0; $a < count( $productos ); $a++) { 
        $textypos+=6;
		$pdf->setX(1);
		$pdf->Cell(45,$textypos, $productos[$a] . ' ' . $cantidades[$a] , 0, 0, 'L');
    }






	$pdf->output();
    

?>