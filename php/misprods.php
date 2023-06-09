<?php

    require_once 'conexion.php';

    $sucursal = $_POST['sucursal'];

    if ($sucursal == '0') {
        echo '
                <div class="container-fluid">
                    <br>
                    <h1>
                        <i class="fa-duotone fa-circle-exclamation"></i> Aviso Importante
                    </h1>
                    <hr>
                    <br>
                    <p>
                    El usuario administradror (admin) no pertenece a ninguna sucursal,
                    si desea observar el inventario, puede ingresar 
                    a <i class="fa-duotone fa-chart-column"></i> <b>Reportes</b> --> 
                    <i class="fa-solid fa-chart-pie"></i> <b>Inventario</b>
                    para visualizar por sucursal sus existencias
                    </p>
                </div>
              ';
    }else {
        //Obtenemos el ID de la sucursal seleccionada
    $sql = "SELECT id_s, nom_s FROM sucursales WHERE id_s = '" . $sucursal . "'";

    $res = $con->query($sql);
    $res->execute();

    $ids = 0;
    $nom_s = 0;

    foreach ($res as $a) {
        $ids = $a['id_s'];
        $nom_s = $a['nom_s'];
    }

    $salida = '     <div class="container-fluid">
                    <br>
                    <h1 class="title">
                        <i class="fa-solid fa-box-open-full"></i> Productos de ' . $nom_s . '
                    </h1>
                    <hr>
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
        $numero = ($a['exist_e'] < 3) ? '<span class="numerose">' . $a['exist_e'] . '</span>' : $a['exist_e'];
        $salida .= '<tr>';
		$salida .= '
                        <td>' . $num .  '</td>
                        <td>' . $a['cod_a'] . '</td>
                        <td >' . $a['desc_a'] . '</td>';
    
        $salida .= '    <td>' . $numero . '</td>
                        <td>' . $a['desc_c'] . '</td>
                        <td>' . $a['desc_m'] . '</td>
					</tr>
					';
        $num += 1;
    }
    $salida .= '</tbody></table></div><br><br><br><br><br><br><br>';

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