<?php

	require_once 'conexion.php';

    $socio = $_POST['socio'];
    $fecha1 = $_POST['fecha1'];
    $fecha2 = $_POST['fecha2'];

    $salida = '<br><br>
                <h1 class="display-4">
                    Reporte de: <b>' . $socio . '</b>
                    <hr class="display-4">
                </h1> 
                
                <button class="btn btn-block btn-danger" onclick="regresar();" 
                        style="max-width: 500px; margin-left:auto; margin-right:auto;" id="regresar">
                <i class="fas fa-arrow-square-left"></i> Regresar
                </button>
                ';
                
    $salida .= '
                <table id="example" class="table dt-responsive table-striped table-bordered tablas" style="width:100%">
        		 <thead>
		            <tr>
		            	<th>Socio</th>
		                <th>Ingresos</th>
		                <th>Egresos</th>
		                <th>Saldo</th>
		            </tr>
		        </thead>
		        <tbody>
        	   ';

    if ($socio != '') {
        $sql = "SELECT id_c FROM socios WHERE name_c = '" . $socio . "'";
        $resultado = $con->query($sql);
        $resultado->execute();
        
        foreach ($resultado as $fila) {
            $numsocio = $fila['id_c'];
        }

        $sql = "SELECT SUM(monto_f) As Ingresos
                FROM flujos WHERE tipo_f = 'I' AND id_c =  " . $numsocio;

        $resultado = $con->query($sql);
        $resultado->execute();

        foreach ($resultado as $fila) {
            $ingresos = $fila['Ingresos'];
        }

        $sql = "SELECT SUM(monto_f) As Egresos
                FROM flujos WHERE tipo_f = 'E' AND id_c =  " . $numsocio;

        $resultado = $con->query($sql);
        $resultado->execute();

        foreach ($resultado as $fila) {
            $egresos = $fila['Egresos'];
        }

        $salida .= '<tr>';
		$salida .= '
					<td>' . $socio .  '</td>
					<td>' . number_format($ingresos, 2) .  '</td>
					<td>' . number_format($egresos, 2) .  '</td>
                    <td>' . number_format($ingresos - $egresos, 2)  .  '</td>
                </tr>';


    }else {
        $sql = "SELECT id_c, name_c FROM socios";
        $resultado = $con->query($sql);
        $resultado->execute();

        foreach ($resultado as $fila) {
            $salida .= '<tr>';
		    $salida .= '
                    <td>' . $fila['name_c'] .  '</td>';
           
                    $sql = "SELECT SUM(monto_f) As Ingresos
                    FROM flujos WHERE tipo_f = 'I' AND id_c =  " . $fila['id_c'];
    
            $resultado2 = $con->query($sql);
            $resultado2->execute();
    
            foreach ($resultado2 as $fila2) {
                $ingresos = $fila2['Ingresos'];
            }
    
            $sql = "SELECT SUM(monto_f) As Egresos
                    FROM flujos WHERE tipo_f = 'E' AND id_c =  " . $fila['id_c'];
    
            $resultado2 = $con->query($sql);
            $resultado2->execute();
    
            foreach ($resultado2 as $fila2) {
                $egresos = $fila2['Egresos'];
            }

            $salida .= '
                        <td>' . number_format($ingresos, 2) .  '</td>
                        <td>' . number_format($egresos, 2) .  '</td>
                        <td>' . number_format($ingresos - $egresos, 2)  .  '</td>
                    </tr>';
            
        }

    }


	

	$salida .= '
						</tbody>
					</table>
				';


	$con = null;

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
	                messageTop: 'La información contenida es propiedad de CyberSoft'
	            },
	            {
	                extend: 'pdf',
	                messageBottom: null
	            }
	        ]
		});
	});
</script>