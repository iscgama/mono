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
        Registrar egreso
    </h1>
    <hr class="display-4">
    <div class="form-group">
        <label for="fecha">Fecha de egreso</label>
        <input type="date" class="form-control" id="fecha">
    </div>
    <div class="form-group">
        <label for="concepto">Concepto de ingreso</label>
        <input type="text" class="form-control" id="concepto">
    </div>
    
    <div class="form-group">
        <label for="monto">Monto de Egreso</label>
        <input type="number" class="form-control" id="monto" placeholder="Escribe la cantidad">
    </div>
    <br>
    <button class="btn btn-outline-primary btn-block" onclick="guardar_egresos();">
        <i class="fas fa-save"></i> Guardar datos
    </button>
    <div id="error" class="alert alert-danger" style="display: none;" role="alert">
      
    </div>
    
        ';

    //if ($num > 0) {
        echo $salida;
    //}else {
    //    echo '<h1>No existen socios registrados, registre uno antes de continuar</h1>';
    //}


?>


<script src="actions/newegreso.js"></script>