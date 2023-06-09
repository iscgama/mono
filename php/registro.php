<?php

    require_once 'conexion.php';


    //'usuario=' + id + '&fecha=' + fecha + '&concepto=' 
    //+ concepto + '&monto=' + monto + '&tipo=' + tipo,


    $usuario = $_POST['usuario'];
	$fecha = $_POST['fecha'];
	$concepto = $_POST['concepto'];
	$monto = $_POST['monto'];
	$tipo = $_POST['tipo'];
	

	if (isset($_POST['socio'])) {
		$socio = $_POST['socio'];
	}

	


	if ($tipo != 'I') {
		$sql = "SELECT COUNT(id_c) As Contador FROM socios WHERE nuevo_c = 0";

		$resultado = $con->query($sql);
		$resultado->execute();

		$numsocios = 0;

		foreach ($resultado as $fila) {
			$numsocios = $fila['Contador'];
		}


		$pagosociedad = $monto / $numsocios;


		if ($numsocios > 0) {

			$sql = "SELECT id_c FROM socios WHERE nuevo_c = 0";

			$resultado = $con->query($sql);
			$resultado->execute();

			$numsocio = 0;

			foreach ($resultado as $fila) {
				$sql = "INSERT INTO flujos (fecha_f, hora_f, concepto_f, monto_f, id_u, tipo_f, id_c) 
				VALUES ( :fecha, NOW(), :concepto, :monto, :usuario, :tipo, :socio)";
			

				// echo $sql;

				$statement = $con->prepare($sql);
				$statement->bindParam(':fecha', $fecha);
				$statement->bindParam(':concepto', $concepto);
				$statement->bindParam(':monto', $pagosociedad);
				$statement->bindParam(':usuario', $usuario);
				$statement->bindParam(':tipo', $tipo);
				$statement->bindParam(':socio', $fila['id_c']);

				$statement->execute();

				
			}

			$con = null;

			echo 'Operación realizada con éxito';
		}else {
			echo 'No existe el socio para hacer la operación';
		}
	}else {

			$sql = "SELECT id_c FROM socios WHERE name_c = '" . $socio . "'";

			$resultado = $con->query($sql);
			$resultado->execute();

			$numsocio = 0;

			foreach ($resultado as $fila) {
				$numsocio = $fila['id_c'];
			}

			$sql = "INSERT INTO flujos (fecha_f, hora_f, concepto_f, monto_f, id_u, tipo_f, id_c) 
				VALUES ( :fecha, NOW(), :concepto, :monto, :usuario, :tipo, :socio)";
		

			//echo $sql;

			$statement = $con->prepare($sql);
			$statement->bindParam(':fecha', $fecha);
			$statement->bindParam(':concepto', $concepto);
			$statement->bindParam(':monto', $monto);
			$statement->bindParam(':usuario', $usuario);
			$statement->bindParam(':tipo', $tipo);
			$statement->bindParam(':socio', $numsocio);

			$statement->execute();

			$con = null;

			//echo 'Operación realizada con éxito';
	}

	

?>