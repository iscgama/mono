<?php

    require_once 'conexion.php';


    
    $operacion = $_POST['operacion'];
    $productos = $_POST['productos'];
    $clasif = $_POST['clasif'];
    $marcas = $_POST['marcas'];
    $clientes = $_POST['clientes'];
    $pr = $_POST['pr'];
    $sucursales = $_POST['sucursales'];
    $cajas = $_POST['cajas'];
    $entradas = $_POST['entradas'];
    $salidas = $_POST['salidas'];
    $compras = $_POST['compras'];
    $pedidos = $_POST['pedidos'];
    $traspasos = $_POST['traspasos'];
    $usuarios = $_POST['usuarios'];
    $roles = $_POST['roles'];
    $cajeros = $_POST['cajeros'];
    $permisos = $_POST['permisos'];
    $datos = $_POST['datos'];
    $cobranza = $_POST['cobranza'];
    $descrip = $_POST['desc'];
    $ventas = $_POST['vender'];

    
    

    if ($operacion == 0) {

        $sql = "SELECT id_r FROM roles WHERE desc_r = '" . $descrip . "'";
        $res = $con->query($sql);
        $res->execute();

        $num = 0;

        foreach ($res as $a) {
            $num = $a['id_r'];
        }


        if ($num != 0) {
            echo 'El rol que deseas registrar ya existe intenta con otro nombre';
        }else {
            $sql = "INSERT INTO `roles`(`id_r`, `desc_r`, `marcas_r`, `clasif_r`, `sucurs_r`, 
                                        `clientes_r`, `cobranza_r`, `entradas_r`, `salidas_r`, 
                                        `compras_r`, `pedidos_r`, `traspasos_r`, `ventas_r`, 
                                        `usuarios_r`, `roles_r`, `prods_r`, `cajeros_r`,
                                         `permisos_r`, `cajas_r`, `datos_r`, `provedor_r`)   
                    VALUES (null, :descrip, :marcas, :clasif, :sucursales, :clientes, :cobranza,
                                 :entradas, :salidas, :compras, :pedidos, :traspasos, :ventas,
                            :usuarios, :roles, :productos, :cajeros, :permisos, :cajas,
                            :datos, :pr);";
    
            
            $statement = $con->prepare($sql);
            $statement->bindParam(':descrip', $descrip);
            $statement->bindParam(':marcas', $marcas);
            $statement->bindParam(':clasif', $clasif);
            $statement->bindParam(':sucursales', $sucursales);
            $statement->bindParam(':clientes', $clientes);
            $statement->bindParam(':cobranza', $cobranza);
            $statement->bindParam(':entradas', $entradas);
            $statement->bindParam(':salidas', $salidas);
            $statement->bindParam(':compras', $compras);
            $statement->bindParam(':pedidos', $pedidos);
            $statement->bindParam(':traspasos', $traspasos);
            $statement->bindParam(':ventas', $ventas);
            $statement->bindParam(':usuarios', $usuarios);
            $statement->bindParam(':roles', $roles);
            $statement->bindParam(':productos', $productos);
            $statement->bindParam(':cajeros', $cajeros);
            $statement->bindParam(':permisos', $permisos);
            $statement->bindParam(':cajas', $cajas);
            $statement->bindParam(':datos', $datos);
            $statement->bindParam(':pr', $pr);
    
    
            $statement->execute();

            echo 1;
        
        }

    }    
   


    
    //echo '$ida= ' .  $ida . ' idc=' . $idc;


?>