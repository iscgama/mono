<?php

    require_once 'conexion.php';

    $sql = "SELECT s.salidan_sa, s.fecha_sa, cs.desc_cs, s.hora_sa, 
                    u.name_u, s.monto_sa, s.status_sa
            FROM salidas s
                INNER JOIN usuarios u ON s.id_u = u.id_u
                INNER JOIN conceptos_sal cs ON s.id_cs = cs.id_cs
            ";

    $res = $con->query($sql);
    $res->execute();

    $salida = '<table id="example" class="table dt-responsive table-striped table-bordered tablas" style="width:100%">
        		 <thead>
		            <tr>
		            	<th>No</th>
		                <th>Fecha</th>
		                <th>Hora</th>
		                <th>Motivo</th>
                        <th>Usuario</th>
                        <th>Monto</th>
		                <th>Status</th>
		                <th>Acciones</th>
		            </tr>
		        </thead>
		        <tbody>
               ';
    $num = 1;
    foreach ($res as $a) {
		$estadoent = '';
		switch ($a['status_sa']) {
			case 0:
				$estadoent = 'Pendiente';
				break;
			case 1:
				$estadoent = 'Confirmada';
				break;
			case 2:
				$estadoent = 'Cancelada';
				break;
		}
        $salida .= '<tr>';
		$salida .= '
					<td>' . $a['salidan_sa'] .  '</td>
					<td>' . $a['fecha_sa'] . '</td>
					<td>' . $a['hora_sa'] . '</td>
					<td>' . $a['desc_cs'] . '</td>
					<td>' . $a['name_u'] . '</td>
					<td>$' . number_format($a['monto_sa'], 2) . '</td>
					<td>' . $estadoent . '</td>
					';
                    
					$salida .= "
					<td>
							<a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
								<i class='fas fa-cog'></i>
							</a>
						<div class='dropdown-menu' aria-labelledby='navbarDropdown'>";
						if ($a['status_sa'] == 1) {
							$salida .=  "     <a class='dropdown-item' id='" . $a['salidan_sa'] . "' onclick='eliminar_salida(this.id)'><i class='fas fa-eraser'></i> Cancelar salida</a>";
						}
		$salida .= "	 <a class='dropdown-item' id='" . $a['salidan_sa'] . "' onclick='imprimir_formato(this.id, \"salida\")'><i class='fal fa-print'></i> Visualizar ticket</a>";
					if ($a['status_sa'] == 0 || $a['status_sa'] == 2) {
						$salida .= "<a class='dropdown-item' id='" . $a['salidan_sa'] . "' onclick='finalizar_salida(this.id)'><i class='fal fa-flag-checkered'></i> Completar salida</a>";
					}
		$salida .=             "       </div> 
					</td>
				";
        
        $salida .= '</tr>';
        $num += 1;
    }
	$salida .= '</tbody></table>';
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
	                messageTop: 'CyberSoft'
	            },
	            {
	                extend: 'pdf',
	                messageBottom: null
	            }
	        ]
		});
	});
</script>