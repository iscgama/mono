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
	$sql = "SELECT p.pedidon_ped, DATE_FORMAT(p.fecha_ped, '%d-%m-%Y') As fecha_ped,
					 p.hora_ped, u.name_u, p.monto_ped, 
					 pr.nom_pr, p.status_ped
			FROM pedidos p
			INNER JOIN usuarios u ON p.id_u = u.id_u
			INNER JOIN proveedor pr ON p.id_pr = pr.id_pr
		WHERE p.pedidon_ped = " . $id;


	
	$resultado = $con->query($sql);
	$resultado->execute();
	
		
    $id_ped = '';
    $pedidon_ped = '';
    $fecha_ped = '';
    $hora_ped = '';
    $name_u = '';
    $monto_ped = '';
    $nom_pr = '';
    $status_ped = '';


	foreach ($resultado as $fila) {
        $pedidon_ped = $fila['pedidon_ped'];
        $fecha_ped = $fila['fecha_ped'];
        $hora_ped = $fila['hora_ped'];
        $name_u = $fila['name_u'];
        $monto_ped = $fila['monto_ped'];
		$nom_pr = $fila['nom_pr'];
        $status_ped = $fila['status_ped'];
	}

	$estadocomp = '';
	switch ($status_ped) {
		case 0:
			$estadocomp = 'Pendiente';
			break;
		case 1:
			$estadocomp = 'Guardado';
			break;
		case 2:
			$estadocomp = 'Surtido';
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
	$pdf->Cell(45,$textypos,utf8_decode('No. Pedido #' . $id), 0, 0, 'C');
	$pdf->SetFont('Helvetica','', 7);    //Letra Helvetica, negrita (Bold), tam. 20
	$textypos+=8;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Fecha / Hora:' . $fecha_ped . ' / ' . $hora_ped), 0, 0, 'C');
	$textypos+=6;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Usuario: ' . $name_u), 0, 0, 'C');
	$textypos+=6;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Prov: ' . $nom_pr), 0, 0, 'C');
	$textypos+=6;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Estado: ' . $estadocomp), 0, 0, 'C');
	$textypos+=6;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,'_________________________________________________', 0, 0, 'C');
	$pdf->SetFont('Helvetica','B', 9);
	$textypos+=7;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('DETALLE DEL PEDIDO'), 0, 0, 'C');
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
	$sql = "SELECT p.cant_ped, a.desc_a, p.costo_ped, m.desc_m 
				FROM pedidos2 p
				INNER JOIN articulos a ON p.id_a = a.id_a
				INNER JOIN marcas m ON a.id_m = m.id_m
			WHERE p.id_ped = " . $id;

	$res = $con->query($sql);
	$res->execute();

	foreach ($res as $a) {
		$textypos+=6;
		$pdf->setX(1);
		$pdf->Cell(45,$textypos,utf8_decode(number_format($a['cant_ped'], 2) . '        ' . $a['desc_a'] . ' ' . $a['desc_m']), 0, 0, 'L');
		$textypos+=6;
		$pdf->setX(1);
		$pdf->Cell(30,$textypos,utf8_decode('$' . number_format($a['costo_ped'], 2)), 0, 0, 'R');
		$pdf->setX(2);
		$pdf->Cell(40,$textypos,utf8_decode('$' . number_format($a['cant_ped'] * $a['costo_ped'], 2)), 0, 0, 'R');
	}
	$textypos+=2;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,'_________________________________________________', 0, 0, 'C');
	$pdf->SetFont('Helvetica','B', 14);    //Letra Helvetica, negrita (Bold), tam. 20
	$textypos+=14;
	$pdf->setX(2);
	$pdf->Cell(45,$textypos,utf8_decode('Total: ' . number_format($monto_ped, 2)), 0, 0, 'C');
	$pdf->output();
?>