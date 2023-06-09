<?php

    require_once 'conexion.php';

    $sql = "SELECT e.id_e, e.entradan_e, DATE_FORMAT(e.fecha_e, '%d-%m-%Y') As fecha_e, 
					e.hora_e, ce.desc_ce, u.name_u, e.monto_e, e.status_e
            FROM entradas e
                INNER JOIN usuarios u ON e.id_u = u.id_u
                INNER JOIN conceptos_ent ce ON e.id_ce = ce.id_ce
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
		switch ($a['status_e']) {
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
					<td>' . $a['entradan_e'] .  '</td>
					<td>' . $a['fecha_e'] . '</td>
					<td>' . $a['hora_e'] . '</td>
					<td>' . $a['desc_ce'] . '</td>
					<td>' . $a['name_u'] . '</td>
					<td>$' . number_format($a['monto_e'], 2) . '</td>
					<td>' . $estadoent . '</td>
					';
                    
		$salida .= "
					<td>
							<a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
								<i class='fas fa-cog'></i>
							</a>
						<div class='dropdown-menu' aria-labelledby='navbarDropdown'>";
						if ($a['status_e'] == 1) {
							$salida .=  "     <a class='dropdown-item' id='" . $a['entradan_e'] . "' onclick='eliminar_entrada(this.id)'><i class='fas fa-eraser'></i> Cancelar entrada</a>";
						}
		$salida .= "	 <a class='dropdown-item' id='" . $a['entradan_e'] . "' onclick='imprimir_formato(this.id, \"entrada\")'><i class='fal fa-print'></i> Visualizar ticket</a>";
					if ($a['status_e'] == 0 || $a['status_e'] == 2) {
						$salida .= "<a class='dropdown-item' id='" . $a['entradan_e'] . "' onclick='finalizar_entrada(this.id)'><i class='fal fa-flag-checkered'></i> Completar entrada</a>";
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