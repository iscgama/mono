<?php

    require_once 'conexion.php';

    $criterio = $_POST['codigo'];
    $sucursal = $_POST['sucursal'];



    $sql = "SELECT a.id_a, a.cod_a, a.desc_a, a.egral_a, a.precio_a, m.desc_m
            FROM articulos a
            INNER JOIN marcas m ON a.id_m = m.id_m 
            WHERE (a.cod_a LIKE '%" . $criterio . "%'
                OR a.desc_a LIKE '%" . $criterio . "%')";
            


    $res = $con->query($sql);
    $res->execute();
    $salida = '';

    $salida = '<table id="example" class="table table-hover table-responsive table-bordered" style="width:100%">
        		 <thead>
		            <tr>
		                <th>Descripción</th>
		                <th>Exist</th>
		                <th>Precio</th>
		                <th>Seleccionar</th>
		            </tr>
		        </thead>
		        <tbody>
               ';
    $num = 1;
    foreach ($res as $a) {
        $salida .= '<tr>';
		$salida .= '
					<td>' . $a['desc_a'] . ' '. $a['desc_m'] . '</td>
					<td>' . $a['egral_a'] . '</td>
					<td>$' . number_format($a['precio_a'], 2) . '</td>
                    ';
                    
        $salida .= "
                        <td>
                            <button class='btn btn-danger btn-block' onclick='producto_listar(this.id);' id='" . $a['cod_a'] . "'>
                                <i class='far fa-check-circle'></i>
                            </button>
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
        $('.tablas').DataTable();
	});
</script>