<?php

    require_once 'conexion.php';

    $numero = $_POST['num'];

    $sql = "SELECT s.idc_sa, s.cant_sa, a.desc_a, s.costo_sa
            FROM salidas2 s
                INNER JOIN articulos a ON s.id_a = a.id_a
            WHERE s.id_sa = " . $numero;

    $res = $con->query($sql);
    $res->execute();

    $salida = '
                <h3>
                    <i class="fal fa-clipboard-list"></i> Detalle de salida
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
                        <button onclick="cambiarcant_sal(this.id, ' . $a['cant_sa'] . ')" class="btn btn-danger btn-block cantidades"
                            id="' . $a['idc_sa'] . '">' . $a['cant_sa'] . '
                         </button>
                    </td>
					<td>' . $a['desc_a'] . '</td>
                    <td>
                    <button onclick="cambiarprecio_sal(this.id, ' . $a['costo_sa'] . ')" class="btn btn-danger btn-block precios" 
                        id="' . $a['idc_sa'] . '">' . number_format($a['costo_sa'], 2) . '
                    </button>
                    </td>
					<td>$' . number_format($a['cant_sa'] * $a['costo_sa'], 2) . '</td>
					';
                    
        $salida .= "
                        <td>
                                <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    <i class='fas fa-cog'></i>
                                </a>
                            <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                <a class='dropdown-item' id='" . $a['idc_sa'] . "' onclick='eliminar_reng_sal(this.id)'><i class='fas fa-eraser'></i> Borrar</a>
                            </div> 
                        </td>
                    ";
        
        $salida .= '</tr>';
        $num += 1;
	}
    
    $sql = "SELECT SUM(cant_sa * costo_sa) As Total
                 FROM salidas2 
                 WHERE id_sa = " . $numero;
    //echo $sql;

    $res = $con->query($sql);
    $res->execute();

    $total = 0;

    foreach ($res as $a) {
        $total += $a['Total'];
    }



    $sql = "UPDATE salidas SET 
                    monto_sa = " . $total . " WHERE salidan_sa = " . $numero;

    $res = $con->query($sql);
    $res->execute();


    $salida .= '</tbody></table>
    
            <br>
            
            <h3>
                Total de Salida: $' . number_format($total, 2) . '
            </h3>
            ';

    echo $salida;

?>

<script>
	$(document).ready(function() {
		$('.tablas').DataTable();
	});
</script>