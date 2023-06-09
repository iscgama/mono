<?php
	include "fpdf/fpdf.php";

	$id = $_GET['id'];

	require_once '../php/conexion.php';


	$id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

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




	//Obtenemos todos los datos de la compra
	$sql = "SELECT v.ventan_v, DATE_FORMAT(v.fecha_v, '%d-%m-%Y') As fecha_v,
					 v.hora_v, u.name_u, v.monto_v, v.pago_v, v.cambio_v, 
					 c.nom_ct, v.status_v
			FROM ventas v
			INNER JOIN usuarios u ON v.id_u = u.id_u
			INNER JOIN clientes c ON v.id_ct = c.id_ct
		WHERE v.ventan_v = " . $id;


	
	$resultado = $con->query($sql);
	$resultado->execute();
	
	$ventan_v = '';
	$fecha_v = '';
	$hora_v = '';
	$name_u = '';
	$monto_v = '';
	$pago_v = '';
	$cambio_v = '';
	$nom_ct = '';
	$status_v = '';


	foreach ($resultado as $fila) {
		$ventan_v = $fila['ventan_v'];
		$fecha_v = $fila['fecha_v'];
		$hora_v = $fila['hora_v'];
		$name_u = $fila['name_u'];
		$monto_v = $fila['monto_v'];
		$pago_v = $fila['pago_v'];
		$cambio_v = $fila['cambio_v'];
		$nom_ct = $fila['nom_ct'];
		$status_v = $fila['status_v'];
	}

	$estadocomp = '';
	switch ($status_v) {
		case 0:
			$estadocomp = 'Pendiente';
			break;
		case 1:
			$estadocomp = 'Confirmada';
			break;
		case 2:
			$estadocomp = 'Cancelada';
			break;
	}





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
	$pdf->Cell(45,$textypos,utf8_decode('No. Ticket #' . $id), 0, 0, 'C');
	$pdf->SetFont('Helvetica','', 7);    //Letra Helvetica, negrita (Bold), tam. 20
	$textypos+=8;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Fecha / Hora:' . $fecha_v . ' / ' . $hora_v), 0, 0, 'C');
	$textypos+=6;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Usuario: ' . $name_u), 0, 0, 'C');
	$textypos+=6;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Cliente: ' . $nom_ct), 0, 0, 'C');
	$textypos+=6;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Estado: ' . $estadocomp), 0, 0, 'C');
	$textypos+=6;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,'_________________________________________________', 0, 0, 'C');
	$pdf->SetFont('Helvetica','B', 9);
	$textypos+=7;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('DETALLE DE LA VENTA'), 0, 0, 'C');
	$pdf->SetFont('Helvetica','', 7);
	$textypos+=4;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,'_________________________________________________', 0, 0, 'C');
	$pdf->SetFont('Helvetica','', 6);
	$textypos+=7;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('CANT.  DESCRIP.       P.UNIT  SUBTOTAL'), 0, 0, 'L');
	$textypos+=2;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,'_________________________________________________', 0, 0, 'C');

	//Obtenemos los detalles de la compra
	$sql = "SELECT c.cant_v, a.desc_a, c.precio_v, m.desc_m 
				FROM ventas2 c
				INNER JOIN articulos a ON c.id_a = a.id_a
				INNER JOIN marcas m ON a.id_m = m.id_m
			WHERE id_v = " . $id;

	$res = $con->query($sql);
	$res->execute();

	foreach ($res as $a) {
		$textypos+=6;
		$pdf->setX(1);
		$pdf->Cell(45,$textypos,utf8_decode(number_format($a['cant_v'], 2) . '        ' . $a['desc_a'] . ' ' . $a['desc_m']), 0, 0, 'L');
		$textypos+=6;
		$pdf->setX(1);
		$pdf->Cell(30,$textypos,utf8_decode('$' . number_format($a['precio_v'], 2)), 0, 0, 'R');
		$pdf->setX(2);
		$pdf->Cell(40,$textypos,utf8_decode('$' . number_format($a['cant_v'] * $a['precio_v'], 2)), 0, 0, 'R');
	}
	$textypos+=2;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,'_________________________________________________', 0, 0, 'C');
	$pdf->SetFont('Helvetica','B', 12);    //Letra Helvetica, negrita (Bold), tam. 20
	$textypos+=14;
	$pdf->setX(2);
	$pdf->Cell(40,$textypos,utf8_decode('Total: ' . number_format($monto_v, 2)), 0, 0, 'R');
	$textypos+=10;
	$pdf->setX(2);
	$pdf->Cell(40,$textypos,utf8_decode('Pago: ' . number_format($pago_v, 2)), 0, 0, 'R');
	$textypos+=10;
	$pdf->setX(2);
	$pdf->Cell(40,$textypos,utf8_decode('Cambio: ' . number_format($cambio_v, 2)), 0, 0, 'R');
	$pdf->SetFont('Helvetica','B', 6);
	$textypos+=14;
	$pdf->setX(2);
	$pdf->Cell(40,$textypos,utf8_decode('*** GRACIAS POR SU PREFERENCIA ***'), 0, 0, 'C');
	$pdf->output();
?>