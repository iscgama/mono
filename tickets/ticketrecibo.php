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




	//Obtenemos los datos del recibo
	$sql = "SELECT nombre_re, DATE_FORMAT(fecha_re, '%d-%m-%Y') As fecha_re, 
				concepto_re, monto_re
			FROM recibos 
			 WHERE id_re = " . $id;


	
	$resultado = $con->query($sql);
	$resultado->execute();
	
	$motivo_f = '';
    $monto_f = '';
    $fecha_f = '';
    $hora_f = '';
    $id_u = '';
    $nom_s = '';
    $tipo_f = '';
    $name_u = '';



	foreach ($resultado as $fila) {
		$nombre_re = $fila['nombre_re'];
        $fecha_re = $fila['fecha_re'];
        $concepto_re = $fila['concepto_re'];
        $monto_re = $fila['monto_re'];
	}

	

    //$tipodoc = ($tipo_f == 'I' ? 'Entrada de dinero' : 'Salida de dinero');
        


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
	$pdf->Cell(45,$textypos,utf8_decode( 'Fecha: ' . $fecha_re ), 0, 0, 'C');
	$pdf->SetFont('Helvetica','', 7);    //Letra Helvetica, negrita (Bold), tam. 20
	$textypos+=8;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('RECIBI LA CANTIDAD DE:'), 0, 0, 'C');
	$pdf->SetFont('Helvetica','B', 10);
	$textypos+=8;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode(number_format($monto_re, 2)), 0, 0, 'C');
	$pdf->SetFont('Helvetica','', 7); 
	$textypos+=8;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('NOMBRE CLIENTE: '), 0, 0, 'C');
	$pdf->SetFont('Helvetica','B', 9);
	$textypos+=7;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode($nombre_re), 0, 0, 'C');
	$pdf->SetFont('Helvetica','', 7); 
	$textypos+=8;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('POR CONCEPTO DE: '), 0, 0, 'C');
	$pdf->SetFont('Helvetica','B', 10); 
	$textypos+=8;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode($concepto_re), 0, 0, 'C');
	$pdf->SetFont('Helvetica','', 8);
	$textypos+=15;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,'__________________________', 0, 0, 'C');
	$pdf->SetFont('Helvetica','B', 9);
	$textypos+=7;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Firma'), 0, 0, 'C');
	$pdf->output();
?>