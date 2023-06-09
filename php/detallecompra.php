<?php

    require_once 'conexion.php';

    $numero = $_POST['num'];

    $sql = "SELECT c.cant_com, c.id_a, a.desc_a, c.costo_com, c.idc_com
            FROM compras2 c
                INNER JOIN articulos a ON c.id_a = a.id_a
            WHERE id_com = " . $numero;

    $res = $con->query($sql);
    $res->execute();

    $salida = '
                <h3>
                    <i class="fal fa-clipboard-list"></i> Detalle de Compra
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
                        <button onclick="cambiarcant(this.id, ' . $a['cant_com'] . ')" class="btn btn-danger btn-block cantidades"
                            id="' . $a['idc_com'] . '">' . $a['cant_com'] . '
                         </button>
                    </td>
					<td>' . $a['desc_a'] . '</td>
                    <td>
                    <button onclick="cambiarprecio(this.id, ' . $a['costo_com'] . ')" class="btn btn-danger btn-block precios" 
                        id="' . $a['idc_com'] . '">' . number_format($a['costo_com'], 2) . '
                    </button>
                    </td>
					<td>$' . number_format($a['cant_com'] * $a['costo_com'], 2) . '</td>
					';
                    
        $salida .= "
                        <td>
                                <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    <i class='fas fa-cog'></i>
                                </a>
                            <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                <a class='dropdown-item' id='" . $a['idc_com'] . "' onclick='eliminar_reng_com(this.id)'><i class='fas fa-eraser'></i> Borrar</a>
                            </div> 
                        </td>
                    ";
        
        $salida .= '</tr>';
        $num += 1;
	}
    
    $sql = "SELECT SUM(cant_com * costo_com) As Total
                 FROM compras2 
                 WHERE id_com = " . $numero;
    //echo $sql;

    $res = $con->query($sql);
    $res->execute();

    $total = 0;

    foreach ($res as $a) {
        $total += $a['Total'];
    }



    $sql = "UPDATE compras SET 
                    monto_com = " . $total . " WHERE compran_com = " . $numero;

    $res = $con->query($sql);
    $res->execute();


    $salida .= '</tbody></table>
    
            <br>
            
            <h3>
                Total de Compra: $' . number_format($total, 2) . '
            </h3>
            ';

    echo $salida;

?>

<script>
	$(document).ready(function() {
		$('.tablas').DataTable();
	});
</script>