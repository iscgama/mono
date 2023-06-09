<?php

	require_once 'conexion.php';

	$num = 0;

	$id = $_POST['id'];

	$id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

	$sql = "UPDATE works SET status_t = 'CANCELADO' WHERE id_t = " . $id;
	
	$resultado = $con->query($sql);
	$resultado->execute();

	$con = null;

	$num = 1;

	echo $num;


?>