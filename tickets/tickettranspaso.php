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




	//Obtenemos todos los datos del traspaso
	$sql = "SELECT t.traspason_tr, t.fecha_tr, t.hora_tr, u.name_u, 
                    t.monto_tr, t.status_tr, s.nom_s
			FROM traspasos t
			INNER JOIN usuarios u ON t.id_u = u.id_u
			INNER JOIN sucursales s ON t.id_s = s.id_s
		WHERE t.traspason_tr = " . $id;


	
	$resultado = $con->query($sql);
	$resultado->execute();
	
	$traspason_tr = '';
	$fecha_tr = '';
	$hora_tr = '';
	$name_u = '';
	$monto_tr = '';
	$status_tr = '';
	$nom_s = '';


	foreach ($resultado as $fila) {
		$traspason_tr = $fila['traspason_tr'];
        $fecha_tr = $fila['fecha_tr'];
        $hora_tr = $fila['hora_tr'];
        $name_u = $fila['name_u'];
        $monto_tr = $fila['monto_tr'];
        $status_tr = $fila['status_tr'];
        $nom_s = $fila['nom_s'];
	}

	$estadocomp = '';
	switch ($status_tr) {
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
	$pdf->Cell(45,$textypos,utf8_decode('No. Traspaso #' . $id), 0, 0, 'C');
	$pdf->SetFont('Helvetica','', 7);    //Letra Helvetica, negrita (Bold), tam. 20
	$textypos+=8;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Fecha / Hora:' . $fecha_tr . ' / ' . $hora_tr), 0, 0, 'C');
	$textypos+=6;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Usuario: ' . $name_u), 0, 0, 'C');
	$textypos+=6;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Sucursal dest: ' . $nom_s), 0, 0, 'C');
	$textypos+=6;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Estado: ' . $estadocomp), 0, 0, 'C');
	$textypos+=6;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,'_________________________________________________', 0, 0, 'C');
	$pdf->SetFont('Helvetica','B', 9);
	$textypos+=7;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('DETALLE DEL TRASPASO'), 0, 0, 'C');
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
	$sql = "SELECT t.idc_tr, t.cant_tr, a.desc_a, t.costo_tr, m.desc_m	 
				FROM traspasos2 t
				INNER JOIN articulos a ON t.id_a = a.id_a
				INNER JOIN marcas m ON a.id_m = m.id_m
			WHERE t.id_tr = " . $id;

	$res = $con->query($sql);
	$res->execute();

	foreach ($res as $a) {
		$textypos+=6;
		$pdf->setX(1);
		$pdf->Cell(45,$textypos,utf8_decode(number_format($a['cant_tr'], 2) . '        ' . $a['desc_a'] . ' ' . $a['desc_m']), 0, 0, 'L');
		$textypos+=6;
		$pdf->setX(1);
		$pdf->Cell(30,$textypos,utf8_decode('$' . number_format($a['costo_tr'], 2)), 0, 0, 'R');
		$pdf->setX(2);
		$pdf->Cell(40,$textypos,utf8_decode('$' . number_format($a['cant_tr'] * $a['costo_tr'], 2)), 0, 0, 'R');
	}
	$textypos+=2;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,'_________________________________________________', 0, 0, 'C');
	$pdf->SetFont('Helvetica','B', 14);    //Letra Helvetica, negrita (Bold), tam. 20
	$textypos+=14;
	$pdf->setX(2);
	$pdf->Cell(45,$textypos,utf8_decode('Total: ' . number_format($monto_tr, 2)), 0, 0, 'C');
	$pdf->output();
?>