<?php

    require_once 'conexion.php';


    //'usuario=' + id + '&fecha=' + fecha + '&concepto=' 
    //+ concepto + '&monto=' + monto + '&tipo=' + tipo,


    $usuario = $_POST['usuario'];
    $id = $_POST['id'];
	$fecha = $_POST['fecha'];
	$concepto = $_POST['concepto'];
	$monto = $_POST['monto'];
	$socio = $_POST['socio'];
	//$tipo = $_POST['tipo'];


	$sql = "SELECT id_c FROM socios  
			WHERE name_c = '" . $socio . "'";

	$resultado = $con->query($sql);
	$resultado->execute();

	$numsocio = 0;

	foreach ($resultado as $fila) {
		$numsocio = $fila['id_c'];
	}


	if ($numsocio != 0) {
        $sql = "UPDATE flujos SET fecha_f = :fecha, concepto_f = :concepto, monto_f = :monto,
                                    id_u = :usuario, id_c = :socio
                                     WHERE id_f = :id";
	
        

		$statement = $con->prepare($sql);
		$statement->bindParam(':fecha', $fecha);
		$statement->bindParam(':concepto', $concepto);
		$statement->bindParam(':monto', $monto);
		$statement->bindParam(':usuario', $usuario);
		$statement->bindParam(':socio', $numsocio);
		$statement->bindParam(':id', $id);

		$statement->execute();

		$con = null;

		echo 'Operación realizada con éxito';
	}else {
		echo 'No existe el socio para hacer la operación';
	}

?>