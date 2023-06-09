<?php

	require_once 'conexion.php';

	header('Content-Type:application/json');


    $encontrado = 0;

    $marca = $_POST['marca'];
    $idu = $_POST['idu'];
    


    $sql = "SELECT id_m FROM marcas WHERE desc_m = '" . $marca . "'";
    //echo $sql;

    $res = $con->query($sql);
    $res->execute();


    $idc = 0;

    foreach ($res as $a) {
        $idc = $a['id_m'];
    }


    if ($idc == 0 && $idc != 1) {
        
        $sql = "INSERT INTO `marcas`(`id_m`, `desc_m`, `id_u`) 
                VALUES (null, :descrip, :idu);";
    
        $statement = $con->prepare($sql);
        $statement->bindParam(':descrip', $marca);
        $statement->bindParam(':idu', $idu);
    
    
        $statement->execute();
       
        
        $estado = 1;
    }else {
        $estado = 'La marca que intentas registrar ya existe intente de nuevo con otra descripción';
    }

    
    $estado = ($idc == 0) ? 'ok' : 'Ya existe la marca';



    $salida = '<label for="marca">Marca del artículo</label>
                    <select class="form-control" id="marca">';

    $sql = "SELECT desc_m FROM marcas ORDER BY desc_m ASC";

    $res = $con->query($sql);
    $res->execute();

    foreach ($res as $a) {
        $salida .= '<option>' . $a['desc_m'] . '</option> ';
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