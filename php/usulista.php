<?php

	require_once 'conexion.php';


	$sql = "SELECT u.id_u, u.usuario_u, u.nombre_u, r.descrip_r FROM usuarios u 
			INNER JOIN roles r ON u.id_r = r.id_r WHERE u.usuario_u <> 'master'
			";

	$resultado = $con->query($sql);
	$resultado->execute();


	$salida = '<table id="example" class="table dt-responsive table-striped table-bordered tablas" style="width:100%">
        		 <thead>
		            <tr>
		            	<th>#</th>
		                <th>Usuario</th>
		                <th>Nombre</th>
		                <th>Rol de usuario</th>
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
					<td>' . $fila['usuario_u'] . '</td>
					<td>' . $fila['nombre_u'] . '</td>
					<td>' . $fila['descrip_r'] . '</td>
					<td>
						';

					
					$salida.='<span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Modificar">
							<button class="btn btn-warning" onclick="modificar_usuario(this.id)" id="' . $fila['id_u'] . '">
								<i class="fas fa-exchange"></i>
							</button>
						</span>
						<span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Eliminar">
							<button class="btn btn-danger" onclick="eliminar_usuario(this.id)" id="' . $fila['id_u'] . '"><i class="fas fa-trash"></i>
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
		$('.tablas').DataTable();
	});
</script>