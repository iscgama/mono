<?php

    require_once 'conexion.php';


    // nombre=' + nombre + '&dir=' + dir + '&telefono=' + telefono
    //+ '&colonia=' + colonia + '&cp=' + cp + '&ciudad=' + ciudad,


    $nombre = $_POST['nombre'];
    $id = $_POST['id'];
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

    $sql = "UPDATE socios SET name_c = :nombre, dir_c = :dir, tel_c = :telefono, col_c = :colonia,
                            cp_c = :cp, ciudad_c = :ciudad, razon_c = :razon, estado_c = :estado,
							fecha_c = :fecha, rfc_c = :rfc, correo_c  = :correo, nuevo_c  = :nuevo 
							 WHERE id_c = :id";
		

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
	$statement->bindParam(':id', $id);
    
	$statement->execute();

	$con = null;

	echo 1;



?>