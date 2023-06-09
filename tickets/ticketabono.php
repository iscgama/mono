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




	//Obtenemos todos los datos del abono
	$sql = "SELECT a.fecha_ab, ct.nom_ct, a.hora_ab, a.forma_ab, a.monto_cb, u.name_u
                FROM abonos a
                INNER JOIN cobranza c ON a.id_cb = c.id_cb
                INNER JOIN clientes ct ON c.id_ct = ct.id_ct
                INNER JOIN usuarios u ON a.id_u = u.id_u
            WHERE a.id_ab =" . $id;



	
	$resultado = $con->query($sql);
	$resultado->execute();
	
	$fecha_ab = '';
    $hora_ab = '';
    $forma_ab = '';
    $monto_cb = '';
    $name_u = '';



	foreach ($resultado as $fila) {
		$fecha_ab = $fila['fecha_ab'];
        $hora_ab = $fila['hora_ab'];
        $forma_ab = $fila['forma_ab'];
        $monto_cb = $fila['monto_cb'];
        $name_u = $fila['name_u'];
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
	$pdf->SetFont('Helvetica','', 7);    //Letra Helvetica, negrita (Bold), tam. 20
	$textypos+=8;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Fecha / Hora:' . $fecha_ab . ' / ' . $hora_ab), 0, 0, 'C');
	$textypos+=6;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Usuario: ' . $name_u), 0, 0, 'C');
	$textypos+=6;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Abono de pago'), 0, 0, 'C');
	$textypos+=6;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Monto: ' . $monto_cb), 0, 0, 'C');
	$textypos+=6;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,'_________________________________________________', 0, 0, 'C');
	$pdf->SetFont('Helvetica','B', 9);
	$textypos+=7;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('FIRMA DE CONFORMIDAD'), 0, 0, 'C');
	$pdf->output();
?>