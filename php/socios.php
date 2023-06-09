<?php

	require_once 'conexion.php';


	$sql = "SELECT id_c As No, name_c As Nombre, dir_c As Direccion, tel_c As Telefono,
                    col_c As Colonia, cp_c As CP, ciudad_c As Ciudad ,
					razon_c As Razon, estado_c As Estado,
					DATE_FORMAT(fecha_c, '%d-%m-%Y') As Fecha, rfc_c As RFC, correo_c As Correo,
					nuevo_c 
                FROM socios 
			
			";
	
	$resultado = $con->query($sql);
	$resultado->execute();


	$salida = '<table id="example" class="table dt-responsive table-striped table-bordered tablas" style="width:100%">
        		 <thead>
		            <tr>
		            	<th>#</th>
		                <th>Nombre</th>
		                <th>Dirección</th>
		                <th>Telefono</th>
		                <th>Colonia</th>
		                <th>Codigo Postal</th>
		                <th>Ciudad</th>
		                <th>Razon Social</th>
		                <th>Estado</th>
		                <th>Fecha Afiliación</th>
		                <th>RFC</th>
		                <th>Correo electrónico</th>
		                <th>Nuevo Socio?</th>
		                <th>Acciones</th>
		            </tr>
		        </thead>
		        <tbody>
        	   ';

	$cons = 1;

	foreach ($resultado as $fila) {
		$estado = ($fila['nuevo_c'] == 1) ? 'Si' : 'No';

		$salida .= '<tr>';
		$salida .= '
					<td>' . $cons .  '</td>
					<td>' . $fila['Nombre'] . '</td>
					<td>' . $fila['Direccion'] . '</td>
					<td>' . $fila['Telefono'] . '</td>
					<td>' . $fila['Colonia'] . '</td>
					<td>' . $fila['CP'] . '</td>
					<td>' . $fila['Ciudad'] . '</td>
					<td>' . $fila['Razon'] . '</td>
					<td>' . $fila['Estado'] . '</td>
					<td>' . $fila['Fecha'] . '</td>
					<td>' . $fila['RFC'] . '</td>
					<td>' . $fila['Correo'] . '</td>
					<td>' . $estado . '</td>
					<td>
						';

					
					$salida.='<span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Modificar">
							<button class="btn btn-warning" onclick="modificar_socio(this.id)" id="' . $fila['No'] . '">
								<i class="fas fa-exchange"></i>
							</button>
						</span>
						<span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Eliminar">
							<button class="btn btn-danger" onclick="eliminar_socio(this.id)" id="' . $fila['No'] . '"><i class="fas fa-trash"></i>
							</button>
						</span>
					</td>
					';
		$salida .= '</tr>';
		$cons += 1;
	}

	$salida .= '
						</tbody>
					</table>
				';


	$con = null;

	echo $salida;

?>

<script>
	$(document).ready(function() {
		$('.tablas').DataTable({
			dom: 'Bfrtip',
	        buttons: [
	            'copy',
	            {
	                extend: 'excel',
	                messageTop: 'AMIC CD HIDALGO - Lista de socios Fecha: ' + fecha_actual2()
	            }
	        ]
		});
	});
</script>