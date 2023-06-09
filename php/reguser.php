<?php

    require_once 'conexion.php';
    
    
    $nombre = $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $pass = $_POST['pass'];
    $roles = $_POST['roles'];
    $sucursales = $_POST['sucursales'];
    $operacion = $_POST['operacion'];
   
    
    
    //Consultar ID de rol
    $sql = "SELECT id_r FROM roles WHERE desc_r = '" . $roles . "'";
    $res = $con->query($sql);
    $res->execute();

    foreach ($res as $a) {
        $roles = $a['id_r'];
    }

    //Consultar ID de sucursal
    $sql = "SELECT id_s FROM sucursales WHERE nom_s = '" . $sucursales . "'";
    $res = $con->query($sql);
    $res->execute();

    foreach ($res as $a) {
        $sucursales = $a['id_s'];
    }      





    if ($operacion == 0) {

        $sql = "SELECT id_u FROM usuarios WHERE user_u = '" . $usuario . "'";
        $res = $con->query($sql);
        $res->execute();

        $id = 0;

        foreach ($res as $a) {
            $id = $a['id_u'];
        }

        if ($id != 0) {
            echo 'Error al intentar registrar un usuario este ya existe intente con otro';
        }else {
            $sql = "INSERT INTO `usuarios`(`id_u`, `name_u`, `user_u`, `pass_u`, `id_r`, `id_s`)  
                    VALUES (null, :nombre, :usuario, :pass, :roles, :sucursales);";
    
            
            $statement = $con->prepare($sql);
            $statement->bindParam(':nombre', $nombre);
            $statement->bindParam(':usuario', $usuario);
            $statement->bindParam(':pass', $pass);
            $statement->bindParam(':roles', $roles);
            $statement->bindParam(':sucursales', $sucursales);
    
    
            $statement->execute();
            /*
                Inserción de permisos
            */

            $sql = "SELECT id_u FROM usuarios WHERE user_u = '" . $usuario . "'";
            $res = $con->query($sql);
            $res->execute();


            $sql = "INSERT INTO `permisos`(`id_p`, `dev_p`, `cprecio_p`, `cargos_p`, `abonos_p`,
                                         `quitara_p`, `corte_p`, `cajon_p`, `ccant_p`, `vender_p`,
                                          `cambiop_p`, `id_u`)  
                    VALUES (null, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, " . $id . ");";
            $res = $con->query($sql);
            $res->execute();  
        }


        
    }else {


        // $sql = "SELECT id_a FROM articulos WHERE cod_a = '" . encriptar($codigo) . "' AND id_a <> '" . $ida . "'";
        // $res = $con->query($sql);
        // $res->execute();


        // $repetido = 0;

        // foreach ($res as $a) {
        //     $repetido++;
        // }

        // if ($repetido > 0) {
        //     echo 'El producto que intentas actualizar ya existe';
        // }else {
        //     $sql = "UPDATE `articulos` SET `cod_a`= :codigo,`desc_a`= :descrip,
        //             `costo_a`= :costo,`precio_a`= :precio,`egral_a`= :existencia,`may1_a`= :may1,
        //             `cant1_a`= :cant1,`may2_a`= :may2,`cant2_a`= :cant2,`may3_a`= :may3,
        //             `cant3_a`= :cant3,`granel_a`= :granel,`inv_a`= :inventario,`id_c`= :idc,
        //             `id_m`= :idm, `id_u`= :idu,`stock_min_a`= :stockmin,`stock_max_a`=:stockmax
        //         WHERE `id_a` = :ida";

        //     $codigo = encriptar($codigo);
        //     $desc = encriptar($desc);

        //     $statement = $con->prepare($sql);
        //     $statement->bindParam(':codigo', $codigo);
        //     $statement->bindParam(':descrip', $desc);
        //     $statement->bindParam(':costo', $costo);
        //     $statement->bindParam(':precio', $precio);
        //     $statement->bindParam(':existencia', $existencia);
        //     $statement->bindParam(':may1', $may1);
        //     $statement->bindParam(':cant1', $cant1);
        //     $statement->bindParam(':may2', $may2);
        //     $statement->bindParam(':cant2', $cant2);
        //     $statement->bindParam(':may3', $may3);
        //     $statement->bindParam(':cant3', $cant3);
        //     $statement->bindParam(':granel', $granel);
        //     $statement->bindParam(':inventario', $inventario);
        //     $statement->bindParam(':idc', $idc);
        //     $statement->bindParam(':idm', $idm);
        //     $statement->bindParam(':idu', $idu);
        //     $statement->bindParam(':stockmin', $smin);
        //     $statement->bindParam(':stockmax', $smax);
        //     $statement->bindParam(':stockmax', $smax);
        //     $statement->bindParam(':ida', $ida);


        //     $statement->execute();
        // }
    }


    echo 1;
    //echo '$ida= ' .  $ida . ' idc=' . $idc;


?>