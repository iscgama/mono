<?php

    require_once 'conexion.php';

	header('Content-Type:application/json');


    $venta = $_POST['venta'];

    $sql = "SELECT v.idc_v, v.cant_v, a.desc_a, m.desc_m, v.precio_v 
                FROM ventas2 v
                INNER JOIN articulos a ON v.id_a = a.id_a
                INNER JOIN marcas m ON a.id_m = m.id_m
            WHERE v.id_v = " . $venta . "
            ORDER BY v.idc_v DESC";
    
    $res = $con->query($sql);
    $res->execute();

    $salida = '<table id="example" class="table dt-responsive table-striped table-bordered " style="width:100%">
        		 <thead>
		            <tr>
		            	<th>Cantidad</th>
		                <th>Descripción</th>
		                <th style="text-align:right;">Precio</th>
                        <th style="text-align:right;">Subtotal</th>
                        <th style="text-align:center;">Acciones</th>
                        
		            </tr>
		        </thead>
		        <tbody>
               ';

    foreach ($res as $a) {
        $salida .= '<tr>';
		$salida .= '
                    <td style="text-align:center;">
                        <div class="input-group">
                            <div class="input-group-append">
                                <button class="btn btn-outline-danger" id="' . $a['idc_v'] . '" 
                                            onclick="cambiar_cantidad(this.id, 0)">
                                    <i class="far fa-minus-square"></i>
                                </button>
                            </div>
                            
                            <button class="btn btn-outline-danger mx-2" id="' . $a['idc_v'] . '"
                                            onclick="cantidades_venta_granel(this.id);">
                                ' . number_format($a['cant_v'], 2) . '
                            </button>
                            
                            <div class="input-group-append">
                                <button class="btn btn-outline-danger" id="' . $a['idc_v'] . '" 
                                            onclick="cambiar_cantidad(this.id, 1)">
                                    <i class="fal fa-plus-square"></i>
                                </button>
                            </div>
                        </div>
                    </td>
                    <td>' . $a['desc_a'] . ' ' . $a['desc_m']  . '</td>
                    <td style="text-align:right;">$' . number_format($a['precio_v'], 2) . '</td>
                    <td style="text-align:right;">$' . number_format($a['cant_v'] * $a['precio_v'], 2) . '</td>
                    <td>
                        <button class="btn btn-danger btn-block" id="' . $a['idc_v'] . '"
                                onclick="eliminar_ren_v(this.id)">
                            <i class="fal fa-trash"></i>
                        </button>
                    </td>
                   ';
        
        $salida .= '</tr>';
    }

    $salida .= '</tbody></table>';
    
    
    $estado = 1;
    $unidades = 0;
    $total = 0;

    $sql = "SELECT SUM(cant_v) As Unidades
                FROM ventas2 WHERE id_v = " . $venta;
    

    $res = $con->query($sql);
    $res->execute();


    foreach ($res as $a) {
        $unidades = $a['Unidades'];
    }

    $unidades = ($unidades == null ? 0 : $unidades);

    $sql = "SELECT monto_v
                FROM ventas WHERE ventan_v = " . $venta;
    

    $res = $con->query($sql);
    $res->execute();


    foreach ($res as $a) {
        $total = $a['monto_v'];
    }
    

	$datos = array (
        'detalle' => $salida,
        'unidades' => number_format($unidades, 2),
        'total' => '$' . number_format($total, 2)
	);

	echo json_encode($datos, JSON_FORCE_OBJECT);

?>