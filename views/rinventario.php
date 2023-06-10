<?php

    require_once '../php/conexion.php';

    $sql = "SELECT a.id_a, a.cod_a, a.desc_a, a.costo_a, a.precio_a, 
					a.egral_a, a.granel_a, a.inv_a, c.desc_c, m.desc_m  
					 FROM articulos a
					 INNER JOIN clasificacion c ON a.id_c = c.id_c
					 INNER JOIN marcas m ON a.id_m = m.id_m
            ";

    $res = $con->query($sql);
    $res->execute();

    $salida = '
    
            <br><br>
            <div class="container-fluid">
            <h1 class="display-4">
                Lista de productos
            </h1>
            <hr>
            <br>

            
            <table id="example" class="table dt-responsive table-striped table-bordered tablas" style="width:100%">
        		 <thead>
		            <tr>
		            	<th>#</th>
		                <th>Código</th>
		                <th>Descripción</th>
		                <th>Existencia</th>
                        <th>Costo</th>
                        <th>Subtotal</th>
                        <th>Precio</th>
						<th>Clasif.</th>
						<th>Marca</th>
		            </tr>
		        </thead>
		        <tbody>
               ';
    $num = 1;
    $piezas = 0;
    $costo = 0;

    foreach ($res as $a) {

        $piezas += $a['egral_a'];
        $costo += $a['egral_a'] * $a['costo_a'];

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
					<td>$' . number_format(( $a['costo_a']  * $a['egral_a']), 2) . '</td>
					<td>$' . number_format($a['precio_a'], 2) . '</td>
					<td>' . $a['desc_c'] . '</td>
					<td>' . $a['desc_m'] . '</td>';
        
        $salida .= '</tr>';
        $num += 1;
	}
	
	$salida .= '</tbody></table>
                <br><br>
                <div class="row">
                    <div class="col-md-6">
                        <h2>
                            Total de productos: ' . $piezas . 
                        '</h2>    
                    </div>
                    <div class="col-md-6">
                        <h2>Costo total de inventario: $' . number_format( $costo , 2 ) . '</h2>
                    </div>
                </div>
                </div>
                
                
                ';

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