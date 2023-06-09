<?php

    require_once 'conexion.php';

    $fecha = $_POST['fecha'];
    $sucursal = $_POST['sucursal'];

    $sql = "SELECT 
            v.ventan_v, DATE_FORMAT(v.fecha_v, '%d-%m-%Y') As fecha_v, v.hora_v, 
            c.nom_ct, u.user_u, v.monto_v, v.status_v 
            FROM ventas v 
                INNER JOIN clientes c ON v.id_ct = c.id_ct
                INNER JOIN usuarios u ON v.id_u = u.id_u
            WHERE v.id_s = " . $sucursal . " AND monto_v <> 0
                AND v.fecha_v = '" . $fecha . "'
            ORDER BY v.ventan_v DESC
            ";

    //echo $sql;

    $res = $con->query($sql);
    $res->execute();


    $totalesvta = 0;

    $salida = '<table id="example" class="table dt-responsive table-striped table-bordered tablas" style="width:100%">
        		 <thead>
		            <tr>
		            	<th>#</th>
		                <th>Fecha</th>
		                <th>Hora</th>
                        <th>Cliente</th>
                        <th>Usuario Vta</th>
                        <th>Estado</th>
		                <th>Monto</th>
		                <th>Acciones</th>
		            </tr>
		        </thead>
		        <tbody>
               ';

    foreach ($res as $a) {
        
        if ($a['status_v'] == 1) {
            $estadov = 'Confirmada';
            $totalesvta += $a['monto_v'];
        }else {
            $estadov = 'Cancelada';
        }

        $salida .= '<tr>';
		$salida .= '
					<td>' . $a['ventan_v'] .  '</td>
					<td>' . $a['fecha_v'] . '</td>
					<td>' . $a['hora_v'] . '</td>
					<td>' . $a['nom_ct'] . '</td>
					<td>' . $a['user_u'] . '</td>
					<td>' . $estadov  . '</td>
					<td>$' . number_format($a['monto_v'], 2) . '</td>
					';
                    
        $salida .= "
                        <td>
                                <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    <i class='fas fa-cog'></i>
                                </a>
                            <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                <a class='dropdown-item' id='" . $a['ventan_v'] . "' onclick='imprimir_formato(this.id, \"\")'><i class='fas fa-feather-alt'></i> Imprimir</a>
                                <a class='dropdown-item' id='" . $a['ventan_v'] . "' onclick='cancelar_venta(this.id)'><i class='fas fa-window-close'></i> Cancelar venta</a>
                            </div> 
                        </td>
                    ";
    }

    $salida .= '</tbody></table>
                <br><br><br>
                <center>
                    <h1 class="title">
                        Total de Ventas: $' . number_format($totalesvta, 2) . '
                    </h1>
                </center>
                <br><br><br><br><br><br>
                ';

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
	                messageTop: 'GamaSoft Relación de Ventas'
	            },
	            {
	                extend: 'pdf',
	                messageBottom: null
	            }
	        ]
		});
	});
</script>