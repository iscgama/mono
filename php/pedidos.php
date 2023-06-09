<?php

    require_once 'conexion.php';

    $sql = "SELECT p.pedidon_ped, p.fecha_ped, p.hora_ped, 
                    u.name_u, p.monto_ped, pr.nom_pr, p.status_ped
            FROM pedidos p
                INNER JOIN usuarios u ON p.id_u = u.id_u
                INNER JOIN proveedor pr ON p.id_pr = pr.id_pr
            ";

    $res = $con->query($sql);
    $res->execute();

    $salida = '<table id="example" class="table dt-responsive table-striped table-bordered tablas" style="width:100%">
        		 <thead>
		            <tr>
		            	<th>No</th>
		                <th>Fecha</th>
		                <th>Hora</th>
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
		switch ($a['status_ped']) {
			case 0:
				$estadoent = 'Pendiente';
				break;
			case 1:
				$estadoent = 'Guardado';
				break;
			case 2:
				$estadoent = 'Surtido';
				break;
		}
        $salida .= '<tr>';
		$salida .= '
					<td>' . $a['pedidon_ped'] .  '</td>
					<td>' . $a['fecha_ped'] . '</td>
					<td>' . $a['hora_ped'] . '</td>
					<td>' . $a['name_u'] . '</td>
					<td>$' . number_format($a['monto_ped'], 2) . '</td>
					<td>' . $estadoent . '</td>
					';
                    
					$salida .= "
								<td>
										<a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
											<i class='fas fa-cog'></i>
										</a>
									<div class='dropdown-menu' aria-labelledby='navbarDropdown'>";
									if ($a['status_ped'] == 1) {
										
									}
									$salida .= "	 <a class='dropdown-item' id='" . $a['pedidon_ped'] . "' onclick='imprimir_pedido(this.id)'><i class='fal fa-print'></i> Visualizar ticket</a>";
									if ($a['status_ped'] == 1 || $a['status_ped'] == 0) {
									$salida .=  "     <a class='dropdown-item' id='" . $a['pedidon_ped'] . "' onclick='eliminar_pedido(this.id)'><i class='fas fa-eraser'></i> Borrar pedido</a>";
									$salida .= "<a class='dropdown-item' id='" . $a['pedidon_ped'] . "' onclick='surtir_pedido(this.id)'><i class='fal fa-flag-checkered'></i> Surtir pedido</a>";
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