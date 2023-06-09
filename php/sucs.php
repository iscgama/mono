<?php

    require_once 'conexion.php';

    $sql = "SELECT id_s, nom_s, dir_s, tel_s, cp_s, ciudad_s, estado_s FROM sucursales
            ";

    $res = $con->query($sql);
    $res->execute();

    $salida = '<table id="example" class="table dt-responsive table-striped table-bordered tablas" style="width:100%">
        		 <thead>
		            <tr>
		            	<th>#</th>
		                <th>Sucursal</th>
		                <th>Dirección</th>
                        <th>Telefono</th>
                        <th>CP</th>
                        <th>Ciudad</th>
		                <th>Estado</th>
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
					<td>' . $a['nom_s'] . '</td>
					<td>' . $a['dir_s'] . '</td>
					<td>' . $a['tel_s'] . '</td>
					<td>' . $a['cp_s'] . '</td>
					<td>' . $a['ciudad_s'] . '</td>
					<td>' . $a['estado_s'] . '</td>
					';
                    
        $salida .= "
                        <td>
                                <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    <i class='fas fa-cog'></i>
                                </a>
                            <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                <a class='dropdown-item' id='" . $a['id_s'] . "' onclick='editar_suc(this.id)'><i class='fas fa-feather-alt'></i> Editar</a>
                                <a class='dropdown-item' id='" . $a['id_s'] . "' onclick='eliminar_suc(this.id)'><i class='fas fa-eraser'></i> Borrar</a>
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