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
	$sql = "SELECT e.entradan_e, DATE_FORMAT(e.fecha_e, '%d-%m-%Y') As fecha_e,
					 e.hora_e, u.name_u, e.monto_e, 
					 c.desc_ce, e.status_e
			FROM entradas e
			INNER JOIN usuarios u ON e.id_u = u.id_u
			INNER JOIN conceptos_ent c ON e.id_ce = c.id_ce
		WHERE e.entradan_e = " . $id;


	
	$resultado = $con->query($sql);
	$resultado->execute();
	
	$entradan_e = '';
	$fecha_e = '';
	$hora_e = '';
	$name_u = '';
	$monto_e = '';
	$desc_ce = '';
	$status_e = '';


	foreach ($resultado as $fila) {
		$entradan_e = $fila['entradan_e'];
		$fecha_e = $fila['fecha_e'];
		$hora_e = $fila['hora_e'];
		$name_u = $fila['name_u'];
		$monto_e = $fila['monto_e'];
		$desc_ce = $fila['desc_ce'];
		$status_e = $fila['status_e'];
	}

	$estadocomp = '';
	switch ($status_e) {
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
	$pdf->Cell(45,$textypos,utf8_decode('No. Entrada #' . $id), 0, 0, 'C');
	$pdf->SetFont('Helvetica','', 7);    //Letra Helvetica, negrita (Bold), tam. 20
	$textypos+=8;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Fecha / Hora:' . $fecha_e . ' / ' . $hora_e), 0, 0, 'C');
	$textypos+=6;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Usuario: ' . $name_u), 0, 0, 'C');
	$textypos+=6;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Concepto: ' . $desc_ce), 0, 0, 'C');
	$textypos+=6;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Estado: ' . $estadocomp), 0, 0, 'C');
	$textypos+=6;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,'_________________________________________________', 0, 0, 'C');
	$pdf->SetFont('Helvetica','B', 9);
	$textypos+=7;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('DETALLE DE LA ENTRADA'), 0, 0, 'C');
	$pdf->SetFont('Helvetica','', 6);
	$textypos+=4;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,'_________________________________________________', 0, 0, 'C');
	$textypos+=7;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('CANT.  DESCRIP.       P.UNIT  SUBTOTAL'), 0, 0, 'L');
	$textypos+=2;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,'_________________________________________________', 0, 0, 'C');

	//Obtenemos los detalles de la compra
	$sql = "SELECT e.cant_e, a.desc_a, e.costo_e, m.desc_m 
				FROM entradas2 e
				INNER JOIN articulos a ON e.id_a = a.id_a
				INNER JOIN marcas m ON a.id_m = m.id_m
			WHERE e.id_e = " . $id;

	$res = $con->query($sql);
	$res->execute();

	foreach ($res as $a) {
		$textypos+=6;
		$pdf->setX(1);
		$pdf->Cell(45,$textypos,utf8_decode(number_format($a['cant_e'], 2) . '        ' . $a['desc_a'] . ' ' . $a['desc_m']), 0, 0, 'L');
		$textypos+=6;
		$pdf->setX(1);
		$pdf->Cell(30,$textypos,utf8_decode('$' . number_format($a['costo_e'], 2)), 0, 0, 'R');
		$pdf->setX(2);
		$pdf->Cell(40,$textypos,utf8_decode('$' . number_format($a['cant_e'] * $a['costo_e'], 2)), 0, 0, 'R');
	}
	$textypos+=2;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,'_________________________________________________', 0, 0, 'C');
	$pdf->SetFont('Helvetica','B', 14);    //Letra Helvetica, negrita (Bold), tam. 20
	$textypos+=14;
	$pdf->setX(2);
	$pdf->Cell(45,$textypos,utf8_decode('Total: ' . number_format($monto_e, 2)), 0, 0, 'C');
	$pdf->output();
?>