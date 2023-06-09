<?php

    require_once 'conexion.php';

    $sql = "SELECT id_pr, nom_pr, repr_pr, dir_pr, tel_pr, pob_pr, est_pr, col_pr, saldo_pr
            FROM proveedor 
            WHERE id_pr <> 1
            ";

    $res = $con->query($sql);
    $res->execute();

    $salida = '<table id="example" class="table dt-responsive table-striped table-bordered tablas" style="width:100%">
        		 <thead>
		            <tr>
		            	<th>#</th>
		                <th>Nombre</th>
		                <th>Contacto</th>
		                <th>Dirección</th>
                        <th>Telefono</th>
                        <th>Poblacion</th>
		                <th>Estado</th>
		                <th>Colonia</th>
						<th>Saldo</th>
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
					<td>' . $a['nom_pr'] . '</td>
					<td>' . $a['repr_pr'] . '</td>
					<td>' . $a['dir_pr'] . '</td>
					<td>' . $a['tel_pr'] . '</td>
					<td>' . $a['pob_pr'] . '</td>
					<td>' . $a['est_pr'] . '</td>
					<td>' . $a['col_pr'] . '</td>
					<td>$' . number_format($a['saldo_pr'], 2) . '</td>
					';
                    
        $salida .= "
                        <td>
                                <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    <i class='fas fa-cog'></i>
                                </a>
								<div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                <a class='dropdown-item' id='" . $a['id_pr'] . "' onclick='editar_pr(this.id)'><i class='fas fa-feather-alt'></i> Editar</a>
                                <a class='dropdown-item' id='" . $a['id_pr'] . "' onclick='eliminar_pr(this.id)'><i class='fas fa-eraser'></i> Borrar</a>
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