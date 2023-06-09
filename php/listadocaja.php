<?php

    require_once 'conexion.php';

    $sql = "SELECT id_cj, DATE_FORMAT(fecha_cj, '%d-%m-%Y') As fecha_cj, concepto_cj,
                    monto_cj, tipo_cj
            FROM caja ORDER BY id_cj DESC";
    
    $res = $con->query($sql);
    $res->execute();

    $salida = '<table id="example" class="table dt-responsive table-striped table-bordered tablas" style="width:100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Concepto</th>
                    <th>Monto</th>
                    <th>Tipo de Movimiento</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            ';

    $ingresos = 0;
    $egresos = 0;

    foreach ($res as $a) {
        if ($a['tipo_cj'] == 'I') {
            $estadov = 'Ingreso';
            $ingresos += $a['monto_cj'];
        }else {
            $estadov = 'Egreso';
            $egresos += $a['monto_cj'];
        }

        $salida .= '<tr>';
		$salida .= '
					<td>' . $a['id_cj'] .  '</td>
					<td>' . $a['fecha_cj'] . '</td>
					<td>' . $a['concepto_cj'] . '</td>
					<td>' . number_format($a['monto_cj'], 2) . '</td>
					<td>' . $estadov . '</td>
					';
                    
        $salida .= "
                        <td>
                                <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    <i class='fas fa-cog'></i>
                                </a>
                            <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                <a class='dropdown-item' id='" . $a['id_cj'] . "' onclick='cancelar_movimiento(this.id)'><i class='fas fa-window-close'></i> Cancelar movimiento</a>
                            </div> 
                        </td>
                    ";
    }

    $saldo = $ingresos - $egresos;

    $salida .= '</tbody></table>
            <br><br><br>
            <h1 class="display-4">
                Saldo actual: $ ' . number_format($saldo, 2) . '
            </h1>
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