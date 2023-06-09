<?php


    require_once 'conexion.php';

    $sql = "SELECT id_re, DATE_FORMAT(fecha_re, '%d-%m-%Y') As fecha_re, concepto_re, 
                    monto_re, nombre_re FROM recibos";
    $res = $con->query($sql);
    $res->execute();


     $salida = '
                <br>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <h1 class="display-4">
                                <i class="fa-solid fa-money-check-dollar"></i> Emisión de Recibos
                            </h1>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-outline-danger btn-block" id="nrecibos">
                                <i class="fas fa-plus-circle"></i> Nuevo recibo
                            </button>
                        </div>
                    </div>
                    <hr class="display-4">
                    <div class="container-fluid" id="listrecibos">
                        <table id="example" class="table dt-responsive table-striped table-bordered tablas" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <th>Cliente</th>
                                    <th>Concepto</th>
                                    <th>Monto</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                    ';

                    $num = 1;

                    foreach ($res as $a) {
                        $salida .= '<tr>';
                        $salida .= '
                                    <td>' . $a['id_re'] .  '</td>
                                    <td>' . $a['fecha_re'] . '</td>
                                    <td>' . $a['nombre_re'] . '</td>
                                    <td>' . $a['concepto_re'] . '</td>
                                    <td> $' . number_format($a['monto_re'], 2) . '</td>
                                    ';
                                    
                        $salida .= "
                                        <td>
                                                <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                    <i class='fas fa-cog'></i>
                                                </a>
                                            <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                                <a class='dropdown-item' id='" . $a['id_re'] . "' onclick='imprimir_formato(this.id, \"recibo\")'><i class='fas fa-print'></i> Imprimir</a>
                                                <a class='dropdown-item' id='" . $a['id_re'] . "' onclick='eliminar_recibo(this.id)'><i class='fas fa-eraser'></i> Borrar</a>
                                                <a class='dropdown-item' id='" . $a['id_re'] . "' onclick='editar_recibo(this.id)'><i class='fas fa-sync-alt'></i> Editar</a>
                                            </div> 
                                        </td>
                                    ";
                        
                        $salida .= '</tr>';
                        $num += 1;
                    }

    $salida .= '     
                    </div>
                </div>
                <br>
                <br>
                <br>
                <br>
          ';


    
	$salida .= '</tbody></table>';

    echo $salida;
?>

<script>
    $(document).ready( ( ) => {

        $('#ventana').on('shown.bs.modal',  () => {
            $('#nombre').focus();
        });

        $('#nrecibos').on('click', () => {
            $('#mensaje').load('views/nuevorec.html');
            $('#ventana').modal('toggle');
        });

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