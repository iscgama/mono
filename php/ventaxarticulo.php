<?php




function ventas_articulo ( $sucursal ) {
    
    require_once 'conexion.php';


        $sucursal = 4;
        $resumen = array('ida'=>'', 'cant'=>0, 'desc'=> '');

        $salida = 'VENTAS POR ARTICULO <br>';


        //Obtener la lista de ventas que no se han cerrado con el corte y de la sucursal
        $sql = "SELECT ventan_v FROM ventas WHERE corte_v = 0  AND id_s = " . $sucursal;
        $res = $con->query($sql);
        $res->execute();


        foreach ($res as $a) {
            //Buscamos cada renglon de cada venta que no tiene corte
            $sql2 = "SELECT v.cant_v, a.desc_a, v.id_a
                        FROM ventas2 v INNER JOIN articulos a ON v.id_a = a.id_a
                    WHERE v.id_v = " . $a['ventan_v'];
            $res2 = $con->query($sql2);
            $res2->execute();

            foreach ($res2 as $a2) {
              
            }
        }



        echo json_encode($resumen);
    }

    ventas_articulo( 1 );

   

?>