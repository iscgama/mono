<?php

    require_once 'conexion.php';

    $socio = $_POST['socio'];
    $salida = '';


    $ingresos = 0;
    $egresos = 0;

    $socio = filter_var($socio, FILTER_SANITIZE_STRING);

    $sql = "SELECT id_c FROM socios WHERE name_c = '" . $socio . "'";

    $res = $con->query($sql);
    $res->execute();

    foreach ($res as $fila) {
        $id = $fila['id_c'];
    }

    $sql = "SELECT DATE_FORMAT(fecha_f, '%d-%m-%Y') As fecha_f, hora_f, concepto_f,
                    monto_f FROM flujos 
                WHERE tipo_f = 'I' AND id_c = " . $id;
    
    $res = $con->query($sql);
    $res->execute();

    $salida .= '    <div class="container-fluid">
                        <br><br>
                        <h1 class="display-4">
                            <i class="far fa-wallet"></i> Lista de ingresos generados
                        </h1>
                        <hr class="display-4">
                        <table id="example" class="table dt-responsive table-striped table-bordered tablas" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Concepto</th>
                                <th>Monto</th>
                            </tr>
                        </thead>
                        <tbody>
                        <br>
                        <br>
                        <br>
                ';

    $cons = 1;

    foreach ($res as $fila) {

        $salida .= '<tr>';
		$salida .= '
					<td>' . $cons .  '</td>
					<td>' . $fila['fecha_f'] . '</td>
					<td>' . $fila['hora_f'] . '</td>
					<td>' . $fila['concepto_f'] . '</td>
					<td>$' . number_format($fila['monto_f'],2) . '</td>';
        $ingresos += $fila['monto_f'];
    }

    $salida .= '
						</tbody>
					</table>
                ';
                

    //Egresos
    $sql = "SELECT DATE_FORMAT(fecha_f, '%d-%m-%Y') As fecha_f, hora_f, concepto_f,
                        monto_f FROM flujos 
                        WHERE tipo_f = 'E' AND id_c = " . $id;
    
    $res = $con->query($sql);
    $res->execute();

    $salida .= '    <div class="container-fluid">
                    
                        <h1 class="display-4">
                            <i class="far fa-wallet"></i> Lista de egresos generados
                        </h1>
                        <hr class="display-4">
                        <table id="example" class="table dt-responsive table-striped table-bordered tablas" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Concepto</th>
                                <th>Monto</th>
                            </tr>
                        </thead>
                        <tbody>
                ';

    $cons = 1;

    foreach ($res as $fila) {

        $salida .= '<tr>';
		$salida .= '
					<td>' . $cons .  '</td>
					<td>' . $fila['fecha_f'] . '</td>
					<td>' . $fila['hora_f'] . '</td>
					<td>' . $fila['concepto_f'] . '</td>
					<td>$' . number_format($fila['monto_f'],2) . '</td>';
        $egresos += $fila['monto_f'];
    }

    $salida .= '
						</tbody>
                    </table>
                    <br>
                    <br>
                    <br>
                    <h1 class="text-center">
                        Saldo actual: $' . number_format($ingresos - $egresos, 2) . '
                    </h1>
                    <br>
                    <button class="btn btn-info btn-block" onclick="exportar_reporte();">
                        <i class="fas fa-file-chart-line"></i> Exportar Reporte
                    </button>
                    <br>
                    <br>
                ';
                
    echo $salida;

?>

<script>
    $(document).ready(function() {
		$('.tablas').DataTable();
	});
</script>