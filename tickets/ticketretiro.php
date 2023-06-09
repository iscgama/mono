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
	$sql = "SELECT f.motivo_f, f.monto_f, f.fecha_f, f.hora_f, 
                    u.name_u, s.nom_s, f.tipo_f
			FROM flujos f
			INNER JOIN usuarios u ON f.id_u = u.id_u
			INNER JOIN sucursales s ON f.id_s = s.id_s
		WHERE f.id_f = " . $id;


	
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
		$motivo_f = $fila['motivo_f'];
        $monto_f = $fila['monto_f'];
        $fecha_f = $fila['fecha_f'];
        $hora_f = $fila['hora_f'];
        $nom_s = $fila['nom_s'];
        $tipo_f = $fila['tipo_f'];
        $name_u = $fila['name_u'];
	}

	

    $tipodoc = ($tipo_f == 'I' ? 'Entrada de dinero' : 'Salida de dinero');
        


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
	$pdf->Cell(45,$textypos,utf8_decode( $tipodoc ), 0, 0, 'C');
	$pdf->SetFont('Helvetica','', 7);    //Letra Helvetica, negrita (Bold), tam. 20
	$textypos+=8;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Fecha / Hora:' . $fecha_f . ' / ' . $hora_f), 0, 0, 'C');
	$textypos+=6;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Usuario: ' . $name_u), 0, 0, 'C');
	$textypos+=6;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Concepto: ' . $motivo_f), 0, 0, 'C');
	$textypos+=6;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Monto: ' . $monto_f), 0, 0, 'C');
	$textypos+=6;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,'_________________________________________________', 0, 0, 'C');
	$pdf->SetFont('Helvetica','B', 9);
	$textypos+=7;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('FIRMA DE CONFORMIDAD'), 0, 0, 'C');
	$pdf->output();
?>