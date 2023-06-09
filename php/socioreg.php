<?php

    require_once 'conexion.php';


    // nombre=' + nombre + '&dir=' + dir + '&telefono=' + telefono
    //+ '&colonia=' + colonia + '&cp=' + cp + '&ciudad=' + ciudad,


    $nombre = $_POST['nombre'];
	$dir = $_POST['dir'];
	$telefono = $_POST['telefono'];
	$colonia = $_POST['colonia'];
	$cp = $_POST['cp'];
	$ciudad = $_POST['ciudad'];
	$razon = $_POST['razon'];
	$estado = $_POST['estado'];
	$fecha = $_POST['fecha'];
	$rfc = $_POST['rfc'];
	$correo = $_POST['correo'];
	$nuevo = $_POST['nuevo'];


    $sql = "INSERT INTO socios (name_c, dir_c, tel_c, col_c, cp_c, ciudad_c, razon_c, estado_c, fecha_c, rfc_c, correo_c) 
			VALUES ( :nombre, :dir, :telefono, :colonia, :cp, :ciudad, :razon, :estado, :fecha, :rfc, :correo:, :nuevo)";
		

   // echo $sql;

	$statement = $con->prepare($sql);
	$statement->bindParam(':nombre', $nombre);
	$statement->bindParam(':dir', $dir);
    $statement->bindParam(':telefono', $telefono);
    $statement->bindParam(':colonia', $colonia);
	$statement->bindParam(':cp', $cp);
	$statement->bindParam(':ciudad', $ciudad);
	$statement->bindParam(':razon', $razon);
	$statement->bindParam(':estado', $estado);
	$statement->bindParam(':fecha', $fecha);
	$statement->bindParam(':rfc', $rfc);
	$statement->bindParam(':correo', $correo);
	$statement->bindParam(':nuevo', $nuevo);
    
	$statement->execute();

	$con = null;

	echo 1;



?>