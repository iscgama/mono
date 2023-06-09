<?php

    require_once 'conexion.php';

    $sql = "SELECT c.compran_com, DATE_FORMAT(c.fecha_com, '%d-%m-%Y') As fecha_com, 
						c.hora_com, u.name_u, c.monto_com,
                     p.nom_pr, c.status_com
            FROM compras c
                 INNER JOIN usuarios u ON c.id_u = u.id_u
                 INNER JOIN proveedor p ON c.id_pr = p.id_pr
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
		                <th>Proveedor</th>
		                <th>Status</th>
		                <th>Acciones</th>
		            </tr>
		        </thead>
		        <tbody>
               ';
	$num = 1;
    foreach ($res as $a) {
		$estadocomp = '';
		switch ($a['status_com']) {
			case 0:
				$estadocomp = 'Pendiente';
				break;
			case 1:
				$estadocomp = 'Confirmada';
				break;
			case 2:
				$estadocomp = 'Cancelada';
				break;
		}
        $salida .= '<tr>';
		$salida .= '
					<td>' . $a['compran_com'] .  '</td>
					<td>' . $a['fecha_com'] . '</td>
					<td>' . $a['hora_com'] . '</td>
					<td>' . $a['name_u'] . '</td>
					<td>$' . number_format($a['monto_com'], 2) . '</td>
					<td>' . $a['nom_pr'] . '</td>
					<td>' . $estadocomp . '</td>
					';
                    
        $salida .= "
                        <td>
                                <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    <i class='fas fa-cog'></i>
                                </a>
                            <div class='dropdown-menu' aria-labelledby='navbarDropdown'>";
							if ($a['status_com'] == 1) {
								$salida .=  "     <a class='dropdown-item' id='" . $a['compran_com'] . "' onclick='eliminar_compra(this.id)'><i class='fas fa-eraser'></i> Cancelar compra</a>";
							}
				$salida .= "	 <a class='dropdown-item' id='" . $a['compran_com'] . "' onclick='imprimir_formato(this.id, \"compra\")'><i class='fal fa-print'></i> Visualizar ticket</a>";
		if ($a['status_com'] == 0 || $a['status_com'] == 2) {
			$salida .= "<a class='dropdown-item' id='" . $a['compran_com'] . "' onclick='finalizar_compra(this.id)'><i class='fal fa-flag-checkered'></i> Confirmar compra</a>";
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
	        ],
			"order": [6, 'desc']
		});
	});
</script>