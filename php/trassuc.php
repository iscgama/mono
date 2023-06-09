<?php

    require_once 'conexion.php';


    function sucursales ($id, $con) {
        $sql = "SELECT nom_s FROM sucursales WHERE id_s = " . $id;

        $res = $con->query($sql);
        $res->execute();

        $noms = '';

        foreach ($res as $a) {
            $noms = $a['nom_s'];
        }

        return $noms;
    }

    $sql = "SELECT t.traspason_tr,t.fecha_tr,t.hora_tr,
                    u.name_u,t.monto_tr,t.status_tr, t.origen_tr, t.id_s
            FROM traspasos t
                INNER JOIN usuarios u ON t.id_u = u.id_u
            WHERE t.origen_tr <> 0
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
                        <th>Origen</th>
                        <th>Destino</th>
                        <th>Monto</th>
		                <th>Status</th>
		                <th>Acciones</th>
		            </tr>
		        </thead>
		        <tbody>
               ';
    $num = 1;
    foreach ($res as $a) {
        $origen = sucursales($a['origen_tr'], $con);
        $destino = sucursales($a['id_s'], $con);

        $salida .= '<tr>';
		$salida .= '
					<td>' . $a['traspason_tr'] .  '</td>
					<td>' . $a['fecha_tr'] . '</td>
					<td>' . $a['hora_tr'] . '</td>
					<td>' . $a['name_u'] . '</td>
					<td>' . $origen . '</td>
					<td>' . $destino . '</td>
					<td>$' . number_format($a['monto_tr'], 2) . '</td>
					<td>' . ($a['status_tr'] ? 'Confirmada' : 'Pendiente') . '</td>
					';
                    
        $salida .= "
                        <td>
                                <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    <i class='fas fa-cog'></i>
                                </a>
								<div class='dropdown-menu' aria-labelledby='navbarDropdown'>
								<a class='dropdown-item' id='" . $a['traspason_tr'] . "' onclick='imprimir_traspaso(this.id)'><i class='fal fa-print'></i> Visualizar ticket</a>";
				if ($a['status_tr'] == 0) {
					$salida .="             <a class='dropdown-item' id='" . $a['traspason_tr'] . "' onclick='editar_traspaso_suc(this.id)'><i class='fas fa-feather'></i> Editar traspaso</a>";
					$salida .="             <a class='dropdown-item' id='" . $a['traspason_tr'] . "' onclick='aplicar_traspaso_suc(this.id)'><i class='fas fa-clipboard-check'></i> Confirmar traspaso</a>";
					$salida .="             <a class='dropdown-item' id='" . $a['traspason_tr'] . "' onclick='eliminar_traspaso_suc(this.id)'><i class='fas fa-eraser'></i> Cancelar traspaso</a>";
				}
		$salida .= "    </div> 
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