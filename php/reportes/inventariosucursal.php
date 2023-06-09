<?php

    require_once '../conexion.php';

    $sucursal = $_POST['sucursal'];

    //Obtenemos el ID de la sucursal seleccionada
    $sql = "SELECT id_s FROM sucursales WHERE nom_s = '" . $sucursal . "'";

    $res = $con->query($sql);
    $res->execute();

    $ids = 0;

    foreach ($res as $a) {
        $ids = $a['id_s'];
    }

    $salida = '
                    <table id="example" class="table dt-responsive table-striped table-bordered tablas" style="width:100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th>Existencia</th>
                        <th>Clasificación</th>
                        <th>Marca</th>
                    </tr>
                </thead>
                <tbody>
              ';
    $sql = "SELECT a.cod_a, a.desc_a, e.exist_e, c.desc_c, m.desc_m 
                FROM existsuc e
                INNER JOIN articulos a ON e.id_a = a.id_a
                INNER JOIN clasificacion c ON a.id_c = c.id_c
                INNER JOIN marcas m ON a.id_m = m.id_m
            WHERE id_s = " . $ids;
    $res = $con->query($sql);
    $res->execute();
    $num = 1;
    foreach ($res as $a) {
        $salida .= '<tr>';
		$salida .= '
                        <td>' . $num .  '</td>
                        <td>' . $a['cod_a'] . '</td>
                        <td>' . $a['desc_a'] . '</td>
                        <td>' . $a['exist_e'] . '</td>
                        <td>' . $a['desc_c'] . '</td>
                        <td>' . $a['desc_m'] . '</td>
					</tr>
					';
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