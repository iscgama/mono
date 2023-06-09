<?php

    require_once 'conexion.php';

    $sql = "SELECT c.id_ct, c.nom_ct, c.dir_ct, c.tel_ct, c.pob_ct, c.est_ct, 
                    c.saldo_ct, c.lprecio_ct, cl.desc_ctc, c.limite_ct
            FROM clientes c
                 INNER JOIN clasifcte cl ON c.id_ctc = cl.id_ctc
			WHERE c.id_ct <> 1
            ";

    $res = $con->query($sql);
    $res->execute();

    $salida = '<table id="example" class="table dt-responsive table-striped table-bordered tablas" style="width:100%">
        		 <thead>
		            <tr>
		            	<th>#</th>
		                <th>Nombre</th>
		                <th>Direccion</th>
                        <th>Telefono</th>
                        <th>Poblacion</th>
		                <th>Estado</th>
		                <th>Saldo</th>
		                <th>Limite</th>
						<th>Precio</th>
						<th>Clasificacion</th>
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
					<td>' . $a['nom_ct'] . '</td>
					<td>' . $a['dir_ct'] . '</td>
					<td>' . $a['tel_ct'] . '</td>
					<td>' . $a['pob_ct'] . '</td>
					<td>' . $a['est_ct'] . '</td>
					<td>$' . number_format($a['saldo_ct'], 2) . '</td>
					<td>$' . number_format($a['limite_ct'], 2) . '</td>
					<td>#' . $a['lprecio_ct'] . '</td>
                    <td>' . $a['desc_ctc'] . '</td>
					';
                    
        $salida .= "
                        <td>
                                <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    <i class='fas fa-cog'></i>
                                </a>
                            <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                <a class='dropdown-item' id='" . $a['id_ct'] . "' onclick='editar_cte(this.id)'><i class='fas fa-feather-alt'></i> Editar</a>
                                <a class='dropdown-item' id='" . $a['id_ct'] . "' onclick='eliminar_cte(this.id)'><i class='fas fa-eraser'></i> Borrar</a>
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