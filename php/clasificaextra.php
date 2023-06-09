<?php

	require_once 'conexion.php';

	header('Content-Type:application/json');


    $encontrado = 0;

    $clasifica = $_POST['clasifica'];
    $idu = $_POST['idu'];
    


    $sql = "SELECT id_c FROM clasificacion WHERE desc_c = '" . $clasifica . "'";
    //echo $sql;

    $res = $con->query($sql);
    $res->execute();


    $idc = 0;

    foreach ($res as $a) {
        $idc = $a['id_c'];
    }


    if ($idc == 0 && $idc != 1) {
        
        $sql = "INSERT INTO `clasificacion`(`id_c`, `desc_c`, `id_u`) 
                VALUES (null, :descrip, :idu);";
    
        $statement = $con->prepare($sql);
        $statement->bindParam(':descrip', $clasifica);
        $statement->bindParam(':idu', $idu);
    
    
        $statement->execute();
       
        
        $estado = 1;
    }else {
        $estado = 'La clasificacion que intentas registrar ya existe intente de nuevo con otra descripción';
    }

    
    $estado = ($idc == 0) ? 'ok' : 'Ya existe la clasificacion';



    $salida = '<label for="clasifica">Clasificacion del artículo</label>
                    <select class="form-control" id="clasifica">';

    $sql = "SELECT desc_c FROM clasificacion ORDER BY desc_c ASC";

    $res = $con->query($sql);
    $res->execute();

    foreach ($res as $a) {
        $salida .= '<option>' . $a['desc_c'] . '</option> ';
    }

    $salida .= '
        </select>
                ';

	
	$datos = array (
        'estado' => $estado,
        'tabla' => $salida
	);

	echo json_encode($datos, JSON_FORCE_OBJECT);

?>