<?php

	require_once 'conexion.php';

	header('Content-Type:application/json');


    $encontrado = 0;

    $codigo = $_POST['codigo'];
    
    $sql = "SELECT id_a FROM articulos WHERE cod_a = '" . $codigo . "'";
    $res = $con->query($sql);
    $res->execute();
    
    $numero = 0;
    $ida = 0;

    foreach ($res as $a) {
        $numero++;
    }



    if ($numero > 0) {
        
        $sql = "SELECT a.id_a, a.desc_a, a.cod_a, a.costo_a, a.precio_a, a.egral_a,
                       c.desc_c, m.desc_m, a.may1_a, a.cant1_a,
                       a.may2_a, a.cant2_a, a.may3_a, a.cant3_a,
                       a.stock_min_a, a.stock_max_a, a.granel_a, a.inv_a, a.favorito_a 
                         FROM articulos a
                INNER JOIN clasificacion c ON a.id_c = c.id_c
                INNER JOIN marcas m ON a.id_m = m.id_m
                WHERE a.cod_a = '" . $codigo . "'";
                
                
        $resultado = $con->query($sql);
        $resultado->execute();
    
    
        $desc_a = '';
        $costo_a = ''; 
        $precio_a = '';
        $egral_a = '';
        $desc_c = '';
        $desc_m = '';
        $may1_a = '';
        $cant1_a = '';
        $may2_a = '';
        $cant2_a = '';
        $may3_a = '';
        $cant3_a = '';
        $stock_min_a = '';
        $stock_max_a = '';
        $granel_a = '';
        $inv_a = '';
        $favorito_a = '';
    
        
    
        foreach ($resultado as $a) {
            $id_a = $a['id_a'];
            $cod_a = $a['cod_a'];
            $desc_a = $a['desc_a'];
            $costo_a = $a['costo_a']; 
            $precio_a = $a['precio_a'];
            $egral_a = $a['egral_a'];
            $desc_c = $a['desc_c'];
            $desc_m = $a['desc_m'];
            $may1_a = $a['may1_a'];
            $cant1_a = $a['cant1_a'];
            $may2_a = $a['may2_a'];
            $cant2_a = $a['cant2_a'];
            $may3_a = $a['may3_a'];
            $cant3_a = $a['cant3_a'];
            $stock_min_a = $a['stock_min_a'];
            $stock_max_a = $a['stock_max_a'];
            $granel_a = $a['granel_a'];
            $favorito_a = $a['favorito_a'];
            $inv_a = $a['inv_a'];
            $encontrado++;
        }
    }else {
        $sql = "SELECT coda_b FROM codigos WHERE cod_b = '" . $codigo . "'";

        $res = $con->query($sql);
        $res->execute();

        $ida = 0;

        foreach ($res as $a) {
            $ida = $a['coda_b'];
        }



        $sql = "SELECT a.id_a, a.cod_a, a.cod_a, a.desc_a, a.costo_a, a.precio_a, a.egral_a,
                       c.desc_c, m.desc_m, a.may1_a, a.cant1_a,
                       a.may2_a, a.cant2_a, a.may3_a, a.cant3_a,
                       a.stock_min_a, a.stock_max_a, a.granel_a, a.inv_a 
                         FROM articulos a
                INNER JOIN clasificacion c ON a.id_c = c.id_c
                INNER JOIN marcas m ON a.id_m = m.id_m
                WHERE a.cod_a = '" . $ida . "'";
    

        $resultado = $con->query($sql);
        $resultado->execute();
    
        $cod_a = '';
        $desc_a = '';
        $costo_a = ''; 
        $precio_a = '';
        $egral_a = '';
        $desc_c = '';
        $desc_m = '';
        $may1_a = '';
        $cant1_a = '';
        $may2_a = '';
        $cant2_a = '';
        $may3_a = '';
        $cant3_a = '';
        $stock_min_a = '';
        $stock_max_a = '';
        $granel_a = '';
        $favorito_a = '';
        $inv_a = '';
    
        
    
        foreach ($resultado as $a) {
            $id_a = $a['id_a'];
            $cod_a = $a['cod_a'];
            $desc_a = $a['desc_a'];
            $costo_a = $a['costo_a']; 
            $precio_a = $a['precio_a'];
            $egral_a = $a['egral_a'];
            $desc_c = $a['desc_c'];
            $desc_m = $a['desc_m'];
            $may1_a = $a['may1_a'];
            $cant1_a = $a['cant1_a'];
            $may2_a = $a['may2_a'];
            $cant2_a = $a['cant2_a'];
            $may3_a = $a['may3_a'];
            $cant3_a = $a['cant3_a'];
            $stock_min_a = $a['stock_min_a'];
            $stock_max_a = $a['stock_max_a'];
            $granel_a = $a['granel_a'];
            $favorito_a = $a['favorito_a'];
            $inv_a = $a['inv_a'];
            $encontrado++;
        }
    }

    $con = null;
    
    $estado = ($encontrado > 0) ? 'ok' : 'error';

	
	$datos = array (
        'estado' => $estado,
        'ida' => $id_a,
		'cod' => $cod_a,
		'desc' => $desc_a,
        'costo' => $costo_a, 
        'precio' => $precio_a,
        'existencia' => $egral_a,
        'clasif' => $desc_c,
        'marca' => $desc_m,
        'may1' => $may1_a,
        'cant1' => $cant1_a,
        'may2' => $may2_a,
        'cant2' => $cant2_a,
        'may3' => $may3_a,
        'cant3' => $cant3_a,
        'smin' => $stock_min_a,
        'smax' => $stock_max_a,
        'granel' => $granel_a,
        'inventario' => $inv_a,
        'favorito' => $favorito_a
	);

	echo json_encode($datos, JSON_FORCE_OBJECT);

?>