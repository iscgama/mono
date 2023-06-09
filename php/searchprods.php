<?php

    require_once 'conexion.php';

    $criterio = $_POST['criterio'];

    


    $sql = "SELECT id_a, cod_a, desc_a, egral_a
            FROM articulos 
            WHERE cod_a LIKE '%" . $criterio . "%'
                OR desc_a LIKE '%" . $criterio . "%'
            ";

    

    $res = $con->query($sql);
    $res->execute();
    $salida = '';

    $salida = '<table id="example" class="table table-hover table-responsive table-bordered" style="width:100%">
        		 <thead>
		            <tr>
		            	<th>#</th>
		                <th>Descripción</th>
		                <th>Exist</th>
		                <th>Seleccionar</th>
		            </tr>
		        </thead>
		        <tbody>
               ';
    $num = 1;
    foreach ($res as $a) {
        $salida .= '<tr>';
		$salida .= '
					<td>' . $num .  '</td>
					<td>' . $a['desc_a'] . '</td>
					<td>' . $a['egral_a'] . '</td>
                    ';
                    
        $salida .= "
                        <td>
                            <button 
                                class='btn btn-danger btn-block' 
                                onclick='seleccionar_cod( this.id, \"codigov\" );' 
                                id='" . $a['cod_a'] . "'
                            >
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