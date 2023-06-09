<?php

    require_once 'conexion.php';

    $sql = "SELECT a.id_a, a.cod_a, a.desc_a, a.costo_a, a.precio_a, 
					a.egral_a, a.granel_a, a.inv_a, c.desc_c, m.desc_m  
					 FROM articulos a
					 INNER JOIN clasificacion c ON a.id_c = c.id_c
					 INNER JOIN marcas m ON a.id_m = m.id_m
            ";

    $res = $con->query($sql);
    $res->execute();

    $salida = '<table id="example" class="table dt-responsive table-striped table-bordered tablas" style="width:100%">
        		 <thead>
		            <tr>
		            	<th>#</th>
		                <th>Código</th>
		                <th>Descripción</th>
		                <th>Existencia</th>
                        <th>Costo</th>
                        <th>Precio</th>
						<th>Clasif.</th>
						<th>Marca</th>
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
					<td>' . $a['cod_a'] . '</td>
					<td>' . $a['desc_a'] . '</td>';
		if ($a['egral_a'] < 3) {
			$salida .= '<td class="numerose">' . $a['egral_a'] . '</td>';
		}else {
			$salida .= '<td>' . $a['egral_a'] . '</td>';
		}
		
		$salida .='
					<td>$' . number_format($a['costo_a'], 2) . '</td>
					<td>$' . number_format($a['precio_a'], 2) . '</td>
					<td>' . $a['desc_c'] . '</td>
					<td>' . $a['desc_m'] . '</td>';
                    
        $salida .= "
                        <td>
                                <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    <i class='fas fa-cog'></i>
                                </a>
                            <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                <a class='dropdown-item' id='" . $a['cod_a'] . "' onclick='editar_prod(this.id)'><i class='fas fa-feather-alt'></i> Editar</a>
                                <a class='dropdown-item' id='" . $a['id_a'] . "' onclick='eliminar_prod(this.id)'><i class='fas fa-eraser'></i> Borrar</a>
                                <a class='dropdown-item' id='" . $a['id_a'] . "' onclick='agregar_codigo(this.id)'><i class='fal fa-barcode-alt'></i> Cambiar código</a>
                            </div> 
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
	                messageTop: 'GamaSoft'
	            },
	            {
	                extend: 'pdf',
	                messageBottom: null
	            }
	        ]
		});
	});
</script>