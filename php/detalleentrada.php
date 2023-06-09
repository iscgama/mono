<?php

    require_once 'conexion.php';

    $numero = $_POST['num'];

    $sql = "SELECT e.idc_e, e.cant_e, a.desc_a, e.costo_e
            FROM entradas2 e
                INNER JOIN articulos a ON e.id_a = a.id_a
            WHERE e.id_e = " . $numero;

    $res = $con->query($sql);
    $res->execute();

    $salida = '
                <h3>
                    <i class="fal fa-clipboard-list"></i> Detalle de entrada
                </h3>
                <hr class="display-4">
                <table id="example" class="table dt-responsive table-striped table-bordered tablas" style="width:100%">
        		 <thead>
		            <tr>
		            	<th>#</th>
		                <th>Cant</th>
		                <th>Producto</th>
                        <th>Costo</th>
                        <th>Subtotal</th>
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
                    <td>
                        <button onclick="cambiarcant_ent(this.id, ' . $a['cant_e'] . ')" class="btn btn-danger btn-block cantidades"
                            id="' . $a['idc_e'] . '">' . $a['cant_e'] . '
                         </button>
                    </td>
					<td>' . $a['desc_a'] . '</td>
                    <td>
                    <button onclick="cambiarprecio_ent(this.id, ' . $a['costo_e'] . ')" class="btn btn-danger btn-block precios" 
                        id="' . $a['idc_e'] . '">' . number_format($a['costo_e'], 2) . '
                    </button>
                    </td>
					<td>$' . number_format($a['cant_e'] * $a['costo_e'], 2) . '</td>
					';
                    
        $salida .= "
                        <td>
                                <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    <i class='fas fa-cog'></i>
                                </a>
                            <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                <a class='dropdown-item' id='" . $a['idc_e'] . "' onclick='eliminar_reng_ent(this.id)'><i class='fas fa-eraser'></i> Borrar</a>
                            </div> 
                        </td>
                    ";
        
        $salida .= '</tr>';
        $num += 1;
	}
    
    $sql = "SELECT SUM(cant_e * costo_e) As Total
                 FROM entradas2 
                 WHERE id_e = " . $numero;
    //echo $sql;

    $res = $con->query($sql);
    $res->execute();

    $total = 0;

    foreach ($res as $a) {
        $total += $a['Total'];
    }



    $sql = "UPDATE entradas SET 
                    monto_e = " . $total . " WHERE entradan_e = " . $numero;

    $res = $con->query($sql);
    $res->execute();


    $salida .= '</tbody></table>
    
            <br>
            
            <h3>
                Total de Entrada: $' . number_format($total, 2) . '
            </h3>
            ';

    echo $salida;

?>

<script>
	$(document).ready(function() {
		$('.tablas').DataTable();
	});
</script>