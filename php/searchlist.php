<?php

    require_once 'conexion.php';

    $criterio = $_POST['criterio'];
    $sucursal = $_POST['sucursal'];

    $sql = "SELECT a.cod_a, a.desc_a, m.desc_m, a.precio_a, e.exist_e 
                FROM existsuc e
            INNER JOIN articulos a ON e.id_a = a.id_a 
            INNER JOIN marcas m ON a.id_m = m.id_m
            WHERE e.id_s = " . $sucursal . " AND (a.cod_a LIKE '%" . $criterio . "%' OR a.desc_a LIKE '%" . $criterio . "%' 
            OR m.desc_m LIKE '%" . $criterio . "%' OR a.cva_a LIKE '%" . $criterio . "%')";
    


    $res = $con->query($sql);
    $res->execute();

    $salida = '
                    <datalist id="sarticulos">
              ';

    foreach ($res as $a) {
        $salida .= '
                    <option 
                     value="' . $a['cod_a'] . '" >' . $a['desc_a'] . ' Marca: ' . $a['desc_m'] 
                            . ' | Precio: $' . number_format($a['precio_a'], 2) 
                            . ' | Existencia: ' . $a['exist_e'] . ' | ' . '</option>
                    ';
    }

    $salida .= '</datalist>';

    echo $salida;

?>

