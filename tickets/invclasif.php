<?php
	include "fpdf/fpdf.php";

	$clasif = $_GET['clasif'];
	$sucursal = $_GET['sucursal'];
	$usuario = $_GET['usuario'];
    

	require_once '../php/conexion.php';


    $sql = "SELECT id_c FROM clasificacion WHERE desc_c = '" . $clasif . "'";
    $res = $con->query($sql);
    $res->execute();

    foreach ($res as $a) {
        $idc = $a['id_c'];
    }


	// $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

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
	$pdf->Cell(45,$textypos,utf8_decode(' == CLASIFICACION =='), 0, 0, 'C');
    $textypos+=6;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('"' . $clasif . '"'), 0, 0, 'C');
	$pdf->SetFont('Helvetica','', 7);    //Letra Helvetica, negrita (Bold), tam. 20
	$textypos+=8;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Fecha ' . date('d /m/ Y') ), 0, 0, 'C');
    $textypos+=6;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Hora ' . date('H:m:s')), 0, 0, 'C');
	$textypos+=7;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('Usuario: ' . $usuario), 0, 0, 'C');
    $textypos+=6;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,'_________________________________________________', 0, 0, 'C');
	$textypos+=9;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,utf8_decode('CODIGO  DESCRIP     CANTIDAD'), 0, 0, 'L');
	$textypos+=2;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,'_________________________________________________', 0, 0, 'C');

	
    //Obtenemos los campos necesarios para la clasificacion
	$sql = "SELECT a.cod_a, e.exist_e, a.desc_a
    FROM existsuc e INNER JOIN articulos a ON e.id_a = a.id_a
    WHERE a.id_c = " . $idc;



    $resultado = $con->query($sql);
    $resultado->execute();

    $id_a = '';
    $exist_e = '';
    $desc_c = '';

    foreach ($resultado as $fila) {
        $cod_a = $fila['cod_a'];
        $exist_e = $fila['exist_e'];
        $desc_a = $fila['desc_a'];

        $textypos+=11;
        $pdf->setX(1);
        $pdf->Cell(45,$textypos,utf8_decode('Cod: ' . $cod_a . '       Exist.: ' . $exist_e), 0, 0, 'L');
        $textypos+=6;
        $pdf->setX(1);
        $pdf->Cell(30,$textypos,utf8_decode( $desc_a ), 0, 0, 'L');
    }

	$textypos+=2;
	$pdf->setX(1);
	$pdf->Cell(45,$textypos,'_________________________________________________', 0, 0, 'C');
	$pdf->output();
?>