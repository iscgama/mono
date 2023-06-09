<?php

	require_once 'conexion.php';


	$sql = "SELECT f.id_f As No, DATE_FORMAT(f.fecha_f, '%d-%m-%Y') As Fecha, f.hora_f As Hora, s.name_c As Concepto,
                    f.monto_f As Monto, u.name_u As Usuario FROM flujos f 
			INNER JOIN usuarios u ON f.id_u = u.id_u 
			INNER JOIN socios s ON f.id_c = s.id_c
			WHERE f.tipo_f = 'I'
			";

	$resultado = $con->query($sql);
	$resultado->execute();


	$salida = '<table id="example" class="table dt-responsive table-striped table-bordered tablas" style="width:100%">
        		 <thead>
		            <tr>
		            	<th>#</th>
		                <th>Fecha</th>
		                <th>Hora</th>
		                <th>Concepto</th>
		                <th>Monto</th>
		                <th>Usuario</th>
		                <th>Acciones</th>
		            </tr>
		        </thead>
		        <tbody>
        	   ';

	$cons = 1;

	foreach ($resultado as $fila) {
		$salida .= '<tr>';
		$salida .= '
					<td>' . $cons .  '</td>
					<td>' . $fila['Fecha'] . '</td>
					<td>' . $fila['Hora'] . '</td>
					<td>' . $fila['Concepto'] . '</td>
					<td>$' . number_format($fila['Monto'],2) . '</td>
					<td>' . $fila['Usuario'] . '</td>
					<td>
						';

					
					$salida.='<span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Modificar">
							<button class="btn btn-warning" onclick="modificar_ingreso(this.id)" id="' . $fila['No'] . '">
								<i class="fas fa-exchange"></i>
							</button>
						</span>
						<span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Eliminar">
							<button class="btn btn-danger" onclick="eliminar_ingreso(this.id)" id="' . $fila['No'] . '"><i class="fas fa-trash"></i>
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
	                messageTop: 'AMIC CD HIDALGO - Relación de ingresos Fecha: ' + fecha_actual2()
	            }
	        ]
		});
	});
</script>