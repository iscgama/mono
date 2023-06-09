<?php

    require_once '../php/conexion.php';

    $usuario = $_POST['usuario'];
    $tipo = $_POST['tipo'];
    $sucursal = $_POST['sucursal'];


    //En caso de que el numero de sucursal sea 0 este indica que el usuario
    //Es de la matriz del sistema y tiene el acceso master del sistema
    if ($tipo != 0 && $sucursal != 0) {
        //Sino se busca el acceso de cada elemento y la sucursal que corresponda
        $sql = "SELECT desc_r, marcas_r, clasif_r, sucurs_r, clientes_r, cobranza_r,
                        entradas_r, salidas_r, compras_r, pedidos_r,
                        traspasos_r, ventas_r, usuarios_r, roles_r, prods_r, 
                        permisos_r, cajeros_r, cajas_r, datos_r, provedor_r
                    FROM roles
                    WHERE id_r = " . $tipo;

        $res = $con->query($sql);
        $res->execute();


        $desc_r = 0;
        $marcas_r = 0;
        $clasif_r = 0;
        $sucurs_r = 0;
        $clientes_r = 0;
        $cobranza_r = 0;
        $entradas_r = 0;
        $salidas_r = 0;
        $compras_r = 0;
        $pedidos_r = 0;
        $traspasos_r = 0;
        $ventas_r = 0;
        $usuarios_r = 0;
        $roles_r = 0;
        $prods_r = 0;
        $permisos_r = 0;
        $cajeros_r = 0;
        $datos_r = 0;
        $cajas_r = 0;
        $provedor_r = 0;


            foreach ($res as $a) {
                $desc_r = $a['desc_r'];
                $marcas_r = $a['marcas_r'];
                $clasif_r = $a['clasif_r'];
                $sucurs_r = $a['sucurs_r'];
                $clientes_r = $a['clientes_r'];
                $cobranza_r = $a['cobranza_r'];
                $entradas_r = $a['entradas_r'];
                $salidas_r = $a['salidas_r'];
                $compras_r = $a['compras_r'];
                $pedidos_r = $a['pedidos_r'];
                $traspasos_r = $a['traspasos_r'];
                $ventas_r = $a['ventas_r'];
                $usuarios_r = $a['usuarios_r'];
                $roles_r = $a['roles_r'];
                $prods_r = $a['prods_r'];
                $permisos_r = $a['permisos_r'];
                $cajeros_r = $a['cajeros_r'];
                $datos_r = $a['datos_r'];
                $cajas_r = $a['cajas_r'];
                $provedor_r = $a['provedor_r'];
                $datos_r = $a['datos_r'];
            }


        }else {
            $desc_r = 'Creador';
            $marcas_r = 1;
            $clasif_r = 1;
            $codigos_r = 1;
            $ofertas_r = 1;
            $sucurs_r = 1;
            $clientes_r = 1;
            $cobranza_r = 1;
            $entradas_r = 1;
            $salidas_r = 1;
            $compras_r = 1;
            $pedidos_r = 1;
            $traspasos_r = 1;
            $ventas_r = 1;
            $config_r = 1;
            $usuarios_r = 1;
            $roles_r = 1;
            $prods_r = 1;
            $permisos_r = 1;
            $cajeros_r = 1;
            $datos_r = 1;
            $cajas_r = 1;
            $provedor_r = 1;
            $datos_r = 1;
            $sucursal = 'Matriz';
        }


        $salida = '
                <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #091446;">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand">
                        <img src="img/icono.png" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
                        <span style="color:white;">SoftPoint 0.1</span>
                    </a>
                    
                
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">';

//Falta validar estas opciones
    $salida .= '
                
                <li class="nav-item" id="mvender">
                    <a class="nav-link" ><i class="fa-regular fa-cash-register"></i> Vender</a>
                </li>
               
                
                
                ';


    if ($ventas_r) {
        $salida .= ' <li class="nav-item" id="mventas">
                        <a class="nav-link "><i class="fa-solid fa-coins"></i> Ventas</a>
                    </li>';
    }


    if ($prods_r) {
        $salida .= ' <li class="nav-item" id="mstore">
                        <a class="nav-link" ><i class="fa-solid fa-box-open-full"></i> Mis Prods</a>
                    </li>';
    }

               

    if ($usuario != '') {        
        $salida.=  '<li class="nav-item dropdown" >
                        <a class="nav-link dropdown-toggle"  id="mcatalogos" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa-duotone fa-window-restore"></i> Bodega
                        </a>
                        <div class="dropdown-menu" aria-labelledby="mcatalogos">';
                        $salida .= ($prods_r) ? '<a class="dropdown-item" id="mprods"><i class="fa-solid fa-crate-apple"></i> Productos</a>': '';
                        $salida .= ($prods_r) ? '<a 
                                                    class="dropdown-item" 
                                                    id="nprods"
                                                    onclick="nuevo_producto();"
                                                >
                                                    <i class="fas fa-plus-circle"></i> Nuevo producto
                                                </a>': '';
                        $salida .= ($clasif_r) ? '<a class="dropdown-item" id="mclasifica"><i class="fa-duotone fa-layer-group"></i> Clasificaciones</a>': '';
                        $salida .= ($marcas_r) ? '<a class="dropdown-item" id="mmarca"><i class="fa-solid fa-registered"></i> Marcas</a>' : '';
                        $salida .= '<div class="dropdown-divider"></div>';
                        $salida .= ($clientes_r) ? '<a class="dropdown-item" id="mcte"><i class="fa-duotone fa-user-group"></i> Clientes</a>' : '';
                        $salida .= ($clientes_r) ? '<a class="dropdown-item" id="mcobranza"><i class="fa-duotone fa-money-bills-simple"></i> Cobranza</a>' : '';
                        $salida .= ($provedor_r) ? '<a class="dropdown-item" id="mpr"><i class="fa-regular fa-users"></i> Proveedores</a>' : '';
                        $salida .= '<div class="dropdown-divider"></div>';
                        $salida .= ($sucurs_r) ? '<a class="dropdown-item" id="msucursales"><i class="fa-duotone fa-store"></i> Sucursales</a>' : '';
                    $salida .= '</div>
                </li>
                
            ';

            $salida .= '<li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="minventario" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa-duotone fa-truck-ramp-box"></i> Inventario
                        </a>
                        <div class="dropdown-menu" aria-labelledby="minventario">
            
                        ';
        
                $salida .= ($entradas_r) ? '<a class="dropdown-item" id="mentradas"><i class="fa-duotone fa-cart-flatbed"></i> Entradas al inventario</a>' : '';
                $salida .= ($salidas_r) ? '<a class="dropdown-item" id="msalidas"><i class="fa-regular fa-cart-minus"></i> Salidas al inventario</a>' : '';
                $salida .= '<div class="dropdown-divider"></div>';
                $salida .= ($compras_r) ? '<a class="dropdown-item" id="mcompras"><i class="fa-duotone fa-bags-shopping"></i> Compras de mercancía</a>' : '';
                $salida .= ($pedidos_r) ? '<a class="dropdown-item" id="mpedidos"><i class="fa-solid fa-paper-plane"></i> Pedidos de compras</a>' : '';
                $salida .= '<div class="dropdown-divider"></div>';
                $salida .= ($traspasos_r) ? '<a class="dropdown-item" id="mtraspasos"><i class="fa-duotone fa-people-carry-box"></i> Traspasos a sucursal</a>' : '';
                $salida .= ($traspasos_r) ? '<a class="dropdown-item" id="mtrassuc"><i class="fa-duotone fa-people-carry-box"></i> Traspasos entre sucursales</a>' : '';
        
            $salida .= ' </div>';
    }else {
        $salida .= '
                        <li class="nav-item" id="mcomprasuc">
                            <a class="nav-link" ><i class="fa-duotone fa-bags-shopping"></i> Compras</a>
                        </li>
                    ';
    }



$salida .= '
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="madmon" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa-duotone fa-chart-column"></i> Reportes
                </a>
                <div class="dropdown-menu" aria-labelledby="madmon">';

                $salida .= ($cajas_r) ? '<a class="dropdown-item" id="mrptvta"><i class="fa-duotone fa-coins"></i>  Ventas</a>' : '';
                $salida .= ($cajas_r) ? '<a class="dropdown-item" id="mrptinv"><i class="fa-solid fa-chart-pie"></i>  Inventario</a>' : '';
                $salida .= ($cajas_r) ? '<a class="dropdown-item" id="mrptcte"><i class="fa-duotone fa-users"></i>  Clientes</a>' : '';
                $salida .= ($cajas_r) ? '<a class="dropdown-item" id="mrptcomp"><i class="fa-solid fa-bags-shopping"></i>   Compras</a>' : '';
                $salida .= ($cajas_r) ? '<a class="dropdown-item" id="mrptsal"><i class="fa-duotone fa-cart-shopping"></i>   Salidas</a>' : '';
                $salida .= ($cajas_r) ? '<a class="dropdown-item" id="mrpttras"><i class="fa-solid fa-box-check"></i>   Traspasos</a>' : '';
                $salida .= ($cajas_r) ? '<a class="dropdown-item" id="mrptped"><i class="fa-solid fa-paper-plane"></i> Pedidos</a>' : '';
                

    $salida .= '            </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="mseguridad" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa-duotone fa-gears"></i> Sistema
                </a>
                <div class="dropdown-menu" aria-labelledby="mseguridad">';

                    $salida .= ($usuarios_r) ? '<a class="dropdown-item" id="musers"><i class="fa-duotone fa-user-lock"></i> Usuarios</a>' : '';
                    $salida .= ($roles_r) ? '<a class="dropdown-item" id="mroles"><i class="fa-duotone fa-chess"></i> Roles</a>' : '';
                    $salida .= '<div class="dropdown-divider"></div>';
                    $salida .= ($datos_r) ? '<a class="dropdown-item" id="mempresa"><i class="fa-duotone fa-dungeon"></i> Datos Generales</a>' : '';
                    $salida .= '<div class="dropdown-divider"></div>';
                    $salida .= ($datos_r) ? '<a class="dropdown-item" id="mcentrada"><i class="fas fa-address-book"></i> Conceptos de entrada</a>' : '';
                    $salida .= ($datos_r) ? '<a class="dropdown-item" id="mcsalida"><i class="fal fa-address-book"></i> Conceptos de salida</a>' : '';
    $salida .= '</div>
            </li>
            ';
    
     

            //----------------------------------------------------------------------------------------------

            $salida .= '            
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="mcontab" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa-duotone fa-scale-unbalanced"></i> Contable
                </a>
                <div class="dropdown-menu" aria-labelledby="mcontab">';

                    $salida .= ($datos_r) ? '<a class="dropdown-item" id="mrecibos"><i class="fa-solid fa-money-check-dollar"></i> Emisión de Recibos</a>' : '';
                    $salida .= ($datos_r) ? '<a class="dropdown-item" id="mcontable"><i class="fa-duotone fa-messages-dollar"></i> Movimientos contables</a>' : '';
    $salida .= '</div>
            </li>
            ';

            //----------------------------------------------------------------------------------------------




            
          

    $salida .= '       
                      </ul>
                        <div class="form-inline my-2 my-lg-0">
                            <button class="btn btn-outline-danger btn-block" id="cerrar_sesion">
                                <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                            </button>
                        </div>
                    </div>
                </nav>
             ';

        echo $salida;


?>

<script src="actions/opciones.js"></script>