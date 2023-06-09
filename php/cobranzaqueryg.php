<?php

    require_once 'conexion.php';

    $cliente = $_POST['cliente'];

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
        $sql = "SELECT v.fecha_cb, v.hora_cb, u.name_u, v.id_v
                FROM cobranza v
                INNER JOIN usuarios u ON v.id_u = u.id_u
                WHERE v.id_ct = " . $idc;

        

        $res = $con->query($sql);
        $res->execute();

        
        $salida = '<br>
                    <table id="example" class="table dt-responsive table-striped table-bordered tablas" style="width:100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Venta</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Usuario</th>
                        <th>Cantidad</th>
                        <th>Descripción</th>
                    </tr>
                </thead>
                <tbody>
                ';

        $num = 1;
        foreach ($res as $a) {

            $sql2 = "SELECT vp.cant_v, a.desc_a 
                        FROM ventas2 vp
                        INNER JOIN articulos a ON vp.id_a = a.id_a
                    WHERE vp.id_v = " . $a['id_v'];
            
            $res2 = $con->query($sql2);
            $res2->execute();

            foreach ($res2 as $a2) {
                # code...
                $salida .= '<tr>';
                $salida .= '
                            <td>' . $num .  '</td>
                            <td>' . $a['id_v'] . '</td>
                            <td>' . $a['fecha_cb'] . '</td>
                            <td>' . $a['hora_cb'] . '</td>
                            <td>' . $a['name_u'] . '</td>
                            <td>' . $a2['cant_v'] . '</td>
                            <td>' . $a2['desc_a'] . '</td>
                            ';
                
            
                $salida .= '</tr>';
                $num++;
            }

        }

        $salida .= '</tbody></table>';

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