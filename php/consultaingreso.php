<?php


    require_once 'conexion.php';
    $salida = '';
    $id = $_POST['id'];

    $sql = 'SELECT fecha_f, hora_f, concepto_f, monto_f, id_c FROM flujos WHERE id_f = ' . $id;

    $resultado = $con->query($sql);
    $resultado->execute();
    
    foreach ($resultado as $fila) {
        $fecha = $fila['fecha_f'];
        $hora = $fila['hora_f'];
        $concepto = $fila['concepto_f'];
        $monto = $fila['monto_f'];
        $idc = $fila['id_c'];
    }


    
    $num = 0;

    $sql = "SELECT name_c FROM socios 
			";

	$resultado = $con->query($sql);
	$resultado->execute();

    $salida =  '
    <h1 class="display-4">
        Actualizar ingreso
    </h1>
    <hr class="display-4">
    <div class="form-group">
        <label for="fecha">Fecha de ingreso</label>
        <input type="date" class="form-control" id="fecha" value="' . $fecha . '">
    </div>
    <div class="form-group">
    <label for="fecha">Seleccione el nombre del socio</label>
        <input list="nombres" id="socio" class="form-control">
        <datalist id="nombres">
			  
			  
			
        ';


    foreach ($resultado as $fila) {
        $salida .= '<option value="'. $fila['name_c'] .'">';
        $num += 1;
    }

    $salida .= '  
            </datalist>
    </div>
    <div class="form-group">
        <label for="monto">Monto de Ingreso</label>
        <input type="number" class="form-control" id="monto" value="' . $monto . '" placeholder="Escribe la cantidad">
    </div>
    <br>
    <button class="btn btn-outline-primary btn-block" onclick="actualizar_datos('. $id .');">
        <i class="fas fa-save"></i> Guardar datos
    </button>
    <div id="error" class="alert alert-danger" style="display: none;" role="alert">
      
    </div>
    
        ';

    if ($num > 0) {
        echo $salida;
    }else {
        echo '<h1>No existen socios registrados, registre uno antes de continuar</h1>';
    }



?>

<script src="actions/moding.js"></script>