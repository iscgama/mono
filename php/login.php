<?php

	require_once 'conexion.php';

	header('Content-Type:application/json');


	$usuario = $_POST['usuario'];
	$password = $_POST['password'];

	$usuario = filter_var($usuario, FILTER_SANITIZE_STRING);
	$password = filter_var($password, FILTER_SANITIZE_STRING);


	$usercryp = $usuario;
	$passcryp = md5($password);


	$sql = "SELECT id_u, id_r FROM usuarios WHERE user_u = '" . $usercryp . "' AND pass_u = '" . $passcryp . "'";

	$resultado = $con->query($sql);
	$resultado->execute();


	$tipo = 0;
	$idu = 0;

	foreach ($resultado as $fila) {
		$tipo = $fila['id_r'];
		$idu = $fila['id_u'];
	}

	$con = null;
	
	if ($idu != 0) {
		$datos = array (
			'estado' => 'ok',
			'tipo' => $tipo,
			'idu' => $idu
		);
	}else {
		$datos = array (
			'estado' => 'error'
		);	
	}

	echo json_encode($datos, JSON_FORCE_OBJECT);
	//echo $usercryp;

?>