<?php

    require_once 'conexion.php';


    // nombre=' + nombre + '&dir=' + dir + '&telefono=' + telefono
    //+ '&colonia=' + colonia + '&cp=' + cp + '&ciudad=' + ciudad,


    $id = $_POST['id'];
	

    $sql = "DELETE FROM socios WHERE id_c = :id";
		


	$statement = $con->prepare($sql);
	$statement->bindParam(':id', $id);
    
	$statement->execute();

	$con = null;

	echo 1;



?>