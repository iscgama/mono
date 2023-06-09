<?php

    require_once 'conexion.php';

    $numero = $_POST['num'];

    $sql = "SELECT p.idc_ped, p.cant_ped, a.desc_a, p.costo_ped
            FROM pedidos2 p
                INNER JOIN articulos a ON p.id_a = p.id_a
            WHERE p.id_ped = " . $numero;

    $res = $con->query($sql);
    $res->execute();

    $salida = '
                <h3>
                    <i class="fal fa-clipboard-list"></i> Detalle de pedido
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
                        <button onclick="cambiarcant(this.id, ' . $a['cant_ped'] . ')" class="btn btn-danger btn-block cantidades"
                            id="' . $a['idc_ped'] . '">' . $a['cant_ped'] . '
                         </button>
                    </td>
					<td>' . $a['desc_a'] . '</td>
                    <td>
                    <button onclick="cambiarprecio(this.id, ' . $a['costo_ped'] . ')" class="btn btn-danger btn-block precios" 
                        id="' . $a['idc_ped'] . '">' . number_format($a['costo_ped'], 2) . '
                    </button>
                    </td>
					<td>$' . number_format($a['cant_ped'] * $a['costo_ped'], 2) . '</td>
					';
                    
        $salida .= "
                        <td>
                                <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    <i class='fas fa-cog'></i>
                                </a>
                            <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                <a class='dropdown-item' id='" . $a['idc_ped'] . "' onclick='eliminar_reng_ped(this.id)'><i class='fas fa-eraser'></i> Borrar</a>
                            </div> 
                        </td>
                    ";
        
        $salida .= '</tr>';
        $num += 1;
	}
    
    $sql = "SELECT SUM(cant_ped * costo_ped) As Total
                 FROM pedidos2 
                 WHERE id_ped = " . $numero;
    //echo $sql;

    $res = $con->query($sql);
    $res->execute();

    $total = 0;

    foreach ($res as $a) {
        $total += $a['Total'];
    }



    $sql = "UPDATE pedidos SET 
                    monto_ped = " . $total . " WHERE pedidon_ped = " . $numero;

    $res = $con->query($sql);
    $res->execute();


    $salida .= '</tbody></table>
    
            <br>
            
            <h3>
                Total de Pedido: $' . number_format($total, 2) . '
            </h3>
            ';

    echo $salida;

?>

<script>
	$(document).ready(function() {
		$('.tablas').DataTable();
	});
</script>