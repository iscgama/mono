<?php

    require_once 'conexion.php';

    
    // $operacion = $_POST['operacion'];
    $productos = $_POST['productos'];
    $clasif = $_POST['clasif'];
    $marcas = $_POST['marcas'];
    $clientes = $_POST['clientes'];
    $pr = $_POST['pr'];
    $cajas = $_POST['cajas'];
    $entradas = $_POST['entradas'];
    $salidas = $_POST['salidas'];
    $compras = $_POST['compras'];
    $ajustes = $_POST['ajustes'];
    $usuarios = $_POST['usuarios'];
    $roles = $_POST['roles'];
    $permisos = $_POST['permisos'];
    $datos = $_POST['datos'];
    $cobranza = $_POST['cobranza'];
    $descrip = $_POST['desc'];
    $ventas = $_POST['vender'];

    
    

    

        $sql = "SELECT id_r FROM roles WHERE desc_r = '" . $descrip . "'";
        $res = $con->query($sql);
        $res->execute();

        $num = 0;

        if ($res->rowCount() > 0) {
            foreach ($res as $a) {
                $num = $a['id_r'];
            }
        }


        if ($num != 0) {
            echo 'El rol que deseas registrar ya existe intenta con otro nombre';
        }else {
            $sql = "INSERT INTO `roles`(`id_r`, `desc_r`, `marcas_r`, `clasif_r`, `clientes_r`, 
                                        `cobranza_r`, `entradas_r`, `salidas_r`, `compras_r`, 
                                        `ajustes_r`, `ventas_r`, `usuarios_r`, `roles_r`, `prods_r`, 
                                        `permisos_r`, `cajas_r`, `datos_r`, `provedor_r`)   
                    VALUES (null, :descrip, :marcas, :clasif, :clientes, :cobranza,
                                 :entradas, :salidas, :compras, :ajustes, :ventas,
                            :usuarios, :roles, :productos, :permisos, :cajas,
                            :datos, :pr);";
    
            
            $statement = $con->prepare($sql);
            $statement->bindParam(':descrip', $descrip);
            $statement->bindParam(':marcas', $marcas);
            $statement->bindParam(':clasif', $clasif);
            $statement->bindParam(':clientes', $clientes);
            $statement->bindParam(':cobranza', $cobranza);
            $statement->bindParam(':entradas', $entradas);
            $statement->bindParam(':salidas', $salidas);
            $statement->bindParam(':compras', $compras);
            $statement->bindParam(':ajustes', $ajustes);
            $statement->bindParam(':ventas', $ventas);
            $statement->bindParam(':usuarios', $usuarios);
            $statement->bindParam(':roles', $roles);
            $statement->bindParam(':productos', $productos);
            $statement->bindParam(':permisos', $permisos);
            $statement->bindParam(':cajas', $cajas);
            $statement->bindParam(':datos', $datos);
            $statement->bindParam(':pr', $pr);
    
    
            $statement->execute();

            echo 1;
        

    }    
   


    
    //echo '$ida= ' .  $ida . ' idc=' . $idc;


?>