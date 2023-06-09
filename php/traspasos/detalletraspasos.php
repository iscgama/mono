<?php

    require_once '../conexion.php';

    $numero = $_POST['traspaso'];

    $sql = "SELECT t.idc_tr, t.cant_tr, a.desc_a, t.costo_tr	
            FROM traspasos2 t
                INNER JOIN articulos a ON t.id_a = a.id_a
            WHERE t.id_tr = " . $numero;


    $res = $con->query($sql);
    $res->execute();

    $salida = '<center>
                    <h3>
                        <i class="fal fa-clipboard-list"></i> Detalle de Traspaso
                    </h3>
                </center>
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
                        <button onclick="cambiarcant(this.id, ' . $a['cant_tr'] . ')" class="btn btn-outline-danger btn-block cantidades"
                            id="' . $a['idc_tr'] . '">' . $a['cant_tr'] . '
                         </button>
                    </td>
					<td>' . $a['desc_a'] . '</td>
                    <td>
                    <button onclick="cambiarprecio(this.id, ' . $a['costo_tr'] . ')" class="btn btn-outline-danger btn-block precios" 
                        id="' . $a['idc_tr'] . '">' . number_format($a['costo_tr'], 2) . '
                    </button>
                    </td>
					<td>$' . number_format($a['cant_tr'] * $a['costo_tr'], 2) . '</td>
					';
                    
        $salida .= "
                        <td>
                                <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    <i class='fas fa-cog'></i>
                                </a>
                            <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                <a class='dropdown-item' id='" . $a['idc_tr'] . "' onclick='eliminar_reng_t(this.id)'><i class='fas fa-eraser'></i> Borrar</a>
                            </div> 
                        </td>
                    ";
        
        $salida .= '</tr>';
        $num += 1;
	}
    
    $sql = "SELECT SUM(cant_tr * costo_tr) As Total
                 FROM traspasos2 
                 WHERE id_tr = " . $numero;
    //echo $sql;

    $res = $con->query($sql);
    $res->execute();

    $total = 0;

    foreach ($res as $a) {
        $total += $a['Total'];
    }



    $sql = "UPDATE traspasos SET 
                    monto_tr = " . $total . " WHERE traspason_tr = " . $numero;

    $res = $con->query($sql);
    $res->execute();


    $salida .= '</tbody></table>
    
            <br>
            
            <h4 class="title">
                Total de Traspaso: $' . number_format($total, 2) . '
            </h4>
            ';

    echo $salida;

?>

<script>
	$(document).ready(function() {
		$('.tablas').DataTable();
	});
</script>