<?php

    require_once 'conexion.php';

    $cliente = $_POST['cliente'];

    $saldopendiente = 0;

    //Obtenemos el ID del cliente para consultar su cobranza
    $sql = "SELECT id_ct FROM clientes WHERE nom_ct = '" . $cliente . "'";
    $res = $con->query($sql);
    $res->execute();

    $idc = 0;

    foreach ($res as $a) {
        $idc = $a['id_ct'];
    }

    if ($idc == 0) {
        echo 'El cliente seleccionado no existe';
        die();
    }else {
        //Consultamos la cobranza del cliente
        $sql = "SELECT c.id_cb, DATE_FORMAT(c.fecha_cb, '%d-%m-%Y') As fecha_cb, 
                    c.hora_cb, c.monto_cb, c.saldo_cb, c.id_v, u.name_u
                    FROM cobranza c INNER JOIN usuarios u ON c.id_u = u.id_u
                WHERE c.id_ct = " . $idc . " AND saldo_cb > 0";

        

        $res = $con->query($sql);
        $res->execute();
        
        $salida = '<br>
                    <table id="example" class="table dt-responsive table-striped table-bordered tablas" style="width:100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Monto</th>
                        <th>Saldo</th>
                        <th>Venta</th>
                        <th>Usuario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                ';

        $num = 1;
        foreach ($res as $a) {
            $salida .= '<tr>';
            $salida .= '
                        <td>' . $num .  '</td>
                        <td>' . $a['fecha_cb'] . '</td>
                        <td>' . $a['hora_cb'] . '</td>
                        <td>$' . number_format($a['monto_cb'], 2) . '</td>
                        <td>$' . number_format($a['saldo_cb'], 2) . '</td>
                        <td>#' . $a['id_v'] . '</td>
                        <td>' . $a['name_u'] . '</td>
                        ';
            $salida .= "
                <td>
                        <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-cog'></i>
                        </a>
                    <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                        <a class='dropdown-item' id='" . $a['id_v'] . "' onclick='imprimir_formato(this.id, \"\")'><i class='far fa-eye'></i> Visualizar venta</a>
                        <a class='dropdown-item' id='" . $a['id_cb'] . "' onclick='abonar_cuenta(this.id, " . $idc . ", " .  $a['saldo_cb'] . ")'><i class='fal fa-wallet'></i> Abonar a esta cuenta</a>
                    </div> 
                </td>
            ";
        
            $salida .= '</tr>';
            $saldopendiente += $a['saldo_cb'];
            $num++;
        }

        $salida .= '</tbody></table>';

        $salida .= '
                <br><br><br>
                <h1 class="display-4">
                    Saldo total: $' . number_format($saldopendiente, 2) . '
                </h1>
        ';

        echo $salida;

    }
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