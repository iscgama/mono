<?php


    require_once '../php/conexion.php';

    $salida = '';
    $num = 0;

    $sql = "SELECT name_c FROM socios 
			";

	$resultado = $con->query($sql);
	$resultado->execute();

    $salida =  '
    <h1 class="display-4">
        Registrar ingreso
    </h1>
    <hr class="display-4">
    <div class="form-group">
        <label for="fecha">Fecha de ingreso</label>
        <input type="date" class="form-control" id="fecha">
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
        <input type="number" class="form-control" id="monto" placeholder="Escribe la cantidad">
    </div>
    <br>
    <button class="btn btn-outline-primary btn-block" onclick="guardar_datos();">
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


<script src="actions/newingreso.js"></script>