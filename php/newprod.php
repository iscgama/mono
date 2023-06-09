<?php

    require_once 'conexion.php';


    function ID_clasificacion($clasif, $con) {

        $sql = "SELECT id_c FROM clasificacion WHERE desc_c = '" . $clasif . "'";
        $res = $con->query($sql);
        $res->execute();
    
        $idc = '';
    
        foreach ($res as $a) {
            $idc = $a['id_c'];
        }

        if ($idc != '') {
            return $idc;
        }else {
            $sql = "INSERT INTO `clasificacion`(`id_c`, `desc_c`, `id_u`)
                         VALUES(null, :clasif, 1)";
            $statement = $con->prepare($sql);
            $statement->bindParam(':clasif', $clasif);
            $statement->execute();

            $sql = "SELECT id_c FROM clasificacion WHERE desc_c = '" . $clasif . "'";
            $res = $con->query($sql);
            $res->execute();
        
            $idc = '';
        
            foreach ($res as $a) {
                $idc = $a['id_c'];
            }

            return $idc;

        }



    }

    function ID_marca($marca, $con) {
        $sql = "SELECT id_m FROM marcas WHERE desc_m = '" . $marca . "'";
        $res = $con->query($sql);
        $res->execute();
    
        $idm = '';
    
        foreach ($res as $a) {
            $idm = $a['id_m'];
        }

        if ($idm != '') {
            return $idm;
        }else {
            $sql = "INSERT INTO `marcas`(`id_m`, `desc_m`, `id_u`)
                         VALUES(null, :marca, 1)";
            $statement = $con->prepare($sql);
            $statement->bindParam(':marca', $marca);
            $statement->execute();

            $sql = "SELECT id_m FROM marcas WHERE desc_m = '" . $marca . "'";
            $res = $con->query($sql);
            $res->execute();
        
            $idm = '';
        
            foreach ($res as $a) {
                $idm = $a['id_m'];
            }

            return $idm;

        }
    }

function Reg_Sucursal ( $codigo, $desc, $con ) {
    $sql = "SELECT id_a FROM articulos WHERE cod_a = '" . $codigo . "' AND desc_a = '" . $desc . "'";
    $res = $con->query( $sql );
    $res->execute();


    if ($res->rowCount() > 0) {

        $idp = '';

        foreach ($res as $a) {
            $idp = $a['id_a'];
        }
    }

    $sql = "SELECT id_s FROM sucursales";
    $res = $con->query( $sql );
    $res->execute();

    foreach ($res as $a) {
        $sucursal = $a['id_s'];
        $sql2 = "SELECT id_a FROM existsuc WHERE id_a = " . $idp . " AND id_s = " . $sucursal;
        $res2 = $con->query( $sql2 );
        $res2->execute();

        if ($res2->rowCount() == 0) {
            $sql = "INSERT INTO `existsuc`(`id_s`, `id_a`, `exist_e`, `id_u`) 
            VALUES (:sucursal, :idp, 0, 1);";

            $statement = $con->prepare($sql);
            $statement->bindParam(':sucursal', $sucursal);
            $statement->bindParam(':idp', $idp);
            
            $statement->execute();
        }
    }
}


    $operacion = $_POST['operacion'];
    $ida = $_POST['ida'];
    $idu = $_POST['idu'];
    $codigo = $_POST['codigo'];
    $desc = $_POST['desc'];
    $costo = $_POST['costo'];
    $precio = $_POST['precio'];
    $existencia = $_POST['existencia'];
    $clasif = $_POST['clasif'];
    $marca = $_POST['marca'];
    $may1 = $_POST['may1'];
    $cant1 = $_POST['cant1'];
    $may2 = $_POST['may2'];
    $cant2 = $_POST['cant2'];
    $may3 = $_POST['may3'];
    $cant3 = $_POST['cant3'];
    $smin = $_POST['smin'];
    $smax = $_POST['smax'];
    $granel = $_POST['granel'];
    $inventario = $_POST['inventario'];
    $favorito = $_POST['favorito'];

    $nclasif = $_POST['nclasif'];
    $nmarca = $_POST['nmarca'];

    if ($nclasif != '') {
        $idc = ID_clasificacion($nclasif, $con);
    }else {
        $idc = ID_clasificacion($clasif, $con);
    }

    if ($nmarca != '') {
        $idm = ID_marca($nmarca, $con);
    }else {
        $idm = ID_marca($marca, $con);
    }



    $may1 = ($may1 == null ? 0: $may1);
    $cant1 = ($cant1 == null ? 0: $cant1);
    $may2 = ($may2 == null ? 0: $may2);
    $cant2 = ($cant2 == null ? 0: $cant2);
    $may3 = ($may3 == null ? 0: $may3);
    $cant3 = ($cant3 == null ? 0: $cant3);
    $smin = ($smin == null ? 0 : $smin);
    $smax = ($smax == null ? 0 : $smax);


    
    
    

    if ($operacion == 0) {

        $sql = "SELECT id_a FROM articulos WHERE cod_a = '" . $codigo . "'";
        $res = $con->query($sql);
        $res->execute();

        $repetido = 0;

        foreach ($res as $a) {
            $repetido++;
        }

        if ($repetido == 0) {
            $sql = "INSERT INTO `articulos`(`id_a`, `cod_a`, `desc_a`, `costo_a`, `precio_a`, 
                                            `egral_a`, `may1_a`, `cant1_a`, `may2_a`, `cant2_a`,
                                            `may3_a`, `cant3_a`, `granel_a`, `inv_a`, `id_c`, 
                                            `id_m`, `id_u`, `stock_min_a`, `stock_max_a`, `favorito_a`) 
                    VALUES (null, :codigo, :descrip, :costo, :precio, :existencia,
                            :may1, :cant1, :may2, :cant2, :may3, :cant3, :granel,
                            :inventario, :idc, :idm, :idu, :stockmin, :stockmax, :favorito);";

            

            $statement = $con->prepare($sql);
            $statement->bindParam(':codigo', $codigo);
            $statement->bindParam(':descrip', $desc);
            $statement->bindParam(':costo', $costo);
            $statement->bindParam(':precio', $precio);
            $statement->bindParam(':existencia', $existencia);
            $statement->bindParam(':may1', $may1);
            $statement->bindParam(':cant1', $cant1);
            $statement->bindParam(':may2', $may2);
            $statement->bindParam(':cant2', $cant2);
            $statement->bindParam(':may3', $may3);
            $statement->bindParam(':cant3', $cant3);
            $statement->bindParam(':granel', $granel);
            $statement->bindParam(':inventario', $inventario);
            $statement->bindParam(':idc', $idc);
            $statement->bindParam(':idm', $idm);
            $statement->bindParam(':idu', $idu);
            $statement->bindParam(':stockmin', $smin);
            $statement->bindParam(':stockmax', $smax);
            $statement->bindParam(':favorito', $favorito);
            $statement->bindParam(':stockmax', $smax);


            $statement->execute();

            Reg_Sucursal( $codigo, $desc, $con );
        }else {
            echo 'Ese producto ya existe con el codigo o descripción que deseas registrar';
        }
    }else {


        $sql = "SELECT id_a FROM articulos WHERE cod_a = '" . $codigo . "' AND id_a <> '" . $ida . "'";
        $res = $con->query($sql);
        $res->execute();


        $repetido = 0;

        foreach ($res as $a) {
            $repetido++;
        }

        if ($repetido > 0) {
            echo 'El producto que intentas actualizar ya existe';
        }else {
            $sql = "UPDATE `articulos` SET `cod_a`= :codigo, `desc_a`= :descrip,
                    `costo_a`= :costo,`precio_a`= :precio,`egral_a`= :existencia,`may1_a`= :may1,
                    `cant1_a`= :cant1,`may2_a`= :may2,`cant2_a`= :cant2,`may3_a`= :may3,
                    `cant3_a`= :cant3,`granel_a`= :granel,`inv_a`= :inventario,`id_c`= :idc,
                    `id_m`= :idm, `id_u`= :idu,`stock_min_a`= :stockmin,`stock_max_a`=:stockmax,`favorito_a`=:favorito
                WHERE `id_a` = :ida";

            
            $statement = $con->prepare($sql);
            $statement->bindParam(':codigo', $codigo);
            $statement->bindParam(':descrip', $desc);
            $statement->bindParam(':costo', $costo);
            $statement->bindParam(':precio', $precio);
            $statement->bindParam(':existencia', $existencia);
            $statement->bindParam(':may1', $may1);
            $statement->bindParam(':cant1', $cant1);
            $statement->bindParam(':may2', $may2);
            $statement->bindParam(':cant2', $cant2);
            $statement->bindParam(':may3', $may3);
            $statement->bindParam(':cant3', $cant3);
            $statement->bindParam(':granel', $granel);
            $statement->bindParam(':inventario', $inventario);
            $statement->bindParam(':idc', $idc);
            $statement->bindParam(':idm', $idm);
            $statement->bindParam(':idu', $idu);
            $statement->bindParam(':stockmin', $smin);
            $statement->bindParam(':stockmax', $smax);
            $statement->bindParam(':favorito', $favorito);
            $statement->bindParam(':ida', $ida);


            $statement->execute();

            Reg_Sucursal( $codigo, $desc, $con );
        }
    }


    echo 1;
    //echo '$ida= ' .  $ida . ' idc=' . $idc;


?>