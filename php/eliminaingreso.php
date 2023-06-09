<?php

    require_once 'conexion.php';


    // nombre=' + nombre + '&dir=' + dir + '&telefono=' + telefono
    //+ '&colonia=' + colonia + '&cp=' + cp + '&ciudad=' + ciudad,


    $id = $_POST['id'];
    
    $sql = "DELETE FROM flujos WHERE id_f = " . $id;
	
	$resultado = $con->query($sql);
	$resultado->execute();

	$con = null;

    


?>