<?php

    require_once 'conexion.php';

    $sql = "SELECT u.id_u, u.name_u, u.user_u, 
				r.desc_r, s.nom_s FROM usuarios u
					INNER JOIN roles r ON u.id_r = r.id_r
					INNER JOIN sucursales s ON u.id_s = s.id_s
				WHERE u.id_u <> 1
            ";

    $res = $con->query($sql);
    $res->execute();

    $salida = '<table id="example" class="table dt-responsive table-striped table-bordered tablas" style="width:100%">
        		 <thead>
		            <tr>
		            	<th>#</th>
		                <th>Nombre completo</th>
		                <th>Usuario</th>
                        <th>Sucursal</th>
                        <th>Rol</th>
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
					<td>' . $a['name_u'] . '</td>
					<td>' . $a['user_u'] . '</td>
					<td>' . $a['nom_s'] . '</td>
					<td>' . $a['desc_r'] . '</td>
					';
                    
        $salida .= "
                        <td>
                                <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    <i class='fas fa-cog'></i>
                                </a>
                            <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
								<a class='dropdown-item' id='" . $a['id_u'] . "' onclick='permisos_user(this.id)'><i class='fal fa-key'></i> Permisos</a>
                                <a class='dropdown-item' id='" . $a['id_u'] . "' onclick='eliminar_user(this.id)'><i class='fas fa-eraser'></i> Borrar</a>
                                <a class='dropdown-item' id='" . $a['id_u'] . "' onclick='editar_user(this.id)'><i class='fas fa-sync-alt'></i> Editar</a>
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