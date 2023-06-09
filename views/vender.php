<?php


    require_once '../php/conexion.php';

    $usuario = $_POST['usuario'];

    $sql = "SELECT id_s FROM usuarios WHERE user_u = '" . $usuario . "'";
    
    $res = $con->query($sql);
    $res->execute();

    $sucursal = 0;

    foreach ($res as $a) {
        $sucursal = $a['id_s'];
    }
    

    if ($sucursal == 0) {
        $salida = '
            <div class="container-fluid">
                <br>
                <h1>
                    <i class="fa-duotone fa-circle-exclamation"></i> Aviso Importante
                </h1>
                <hr>
                <br>
                <p>
                El usuario administrador (admin) no pertenece a ninguna sucursal,
                si desea realizar <b>VENTAS</b> debes seguir estos pasos:</p>
                </ol>
                    <li>
                        Registrar una <b>SUCURSAL</b> a través del 
                        menú <i class="fa-duotone fa-window-restore"></i> <b>Bodega</b> -> 
                        <i class="fa-duotone fa-store"></i> <b>Sucursales</b> y posteriormente
                    </li>
                    
                    <li>
                    Así como el <b>ROL</b> que desee
                   para ese colaborador (Cajero, Encargado, Supervisor, etc..) que puede
                   definir con el menú <i class="fa-duotone fa-gears"></i> <b>Sistema</b> ->
                   <i class="fa-duotone fa-chess"></i> <b>Roles</b>
                    
                    </li>
                    <li>
                        Registrar cada <b>USUARIO</b> que desee para ventas a través del menú
                    <i class="fa-duotone fa-gears"></i> <b>Sistema</b> -> 
                    <i class="fa-duotone fa-user-lock"></i> <b>Usuarios</b>
                    </li>
                <ol>
                <br>
                <p>Con estos pasos realizados debemos cerrar sesión, e ingresar con el usuario
                    nuevo para las <b>VENTAS</b>
                </p>
                
                
            </div>
        ';

        echo $salida;
    }else {
        $salida = '';
    
        $sql = "SELECT nom_ct FROM clientes";
    
        $res = $con->query($sql);
        $res->execute();
    
        $salida .= '
                        <div id="principal" class="container-fluid">
                            <div class="row">
                                <div id="bloquea" class="col-md-10 container-fluid">
                                    <div class="input-group">
                                        <input 
                                            list="clientes" class="form-control my-3" 
                                            placeholder="Selecciona el cliente" 
                                            id="clientev"
                                            onfocus="valida_cliente( );"
                                            onblur="verifica_cliente( );"
                                        >
                                        <datalist id="clientes">';
                                        foreach ($res as $a) {
                                            $salida .= '<option value="' . $a['nom_ct'] . '"></option>';
                                        }                                  
        $salida .= '                    </datalist>
                                        <div class="input-group-append">
                                            <span class="input-group-text my-3" id="descrip">Cliente de Mostrador</span>
                                            <button class="btn btn-danger my-3" id="bcliente" type="button"><i class="fal fa-search"></i></button>
                                        </div>
                                    </div>
                                    <div id="prodlist">
    
                                    </div>
                                    <div class="row">
                                        <div id="escritos" class="col-md-6 text-info">
    
                                        </div>
                                        <div id="unidadesd" class="col-md-6">
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <span class="input-group-text btn-danger my-2 mb-2" id="descrip">Unidades</span>
                                                </div>
                                                <input type="text" class="form-control my-2 mb-2" value="0.00" id="unidades" disabled="true">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <input 
                                                    type="text" 
                                                    class="form-control my-3" 
                                                    placeholder="Escanea el codigo de barras" 
                                                    id="codigov"
                                                    onkeypress="introducir_codigo( event );"
                                                    onkeydown="introducir_codigo( event );"
                                                >
                                                <div class="input-group-append">
                                                    <span class="input-group-text my-3 mb-2" id="descripv">Producto</span>
                                                    <button 
                                                        class="btn btn-danger my-3" 
                                                        id="bcodigo" 
                                                        type="button"
                                                        onclick="muestra_lista_prods();"
                                                    >
                                                            <i class="fal fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <span class="input-group-text btn-danger my-4" id="descrip">Total $</span>
                                                </div>
                                                <input type="text" class="form-control my-4" value="0.00" id="totalv" disabled="true">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="bloqueb" class="col-md-2 container-fluid">
                                    <center>
                                        
                                        <h2 class="title my-2">
                                            Prods <i class="far fa-stars"></i>
                                        </h2>
                                        <div id="favoritos" style="padding: 5px;">
                                        ';
    
                                        $sql = "SELECT cod_a, desc_a FROM articulos WHERE favorito_a = 1";

                                        $res = $con->query($sql);
                                        $res->execute();
                                    
                                    
                                        foreach ($res as $a) {
                                            $salida .= '
                                                            <button class="btn btn-outline-dark btn-block my-2" 
                                                                    onclick="producto_listar(' . $a['cod_a'] . ');">
                                                                    <i class="far fa-star"></i> ' . $a['desc_a'] . '
                                                            </button>
                                                        ';
                                        }


    $salida .=                          '
    
                                        </div>
                                        <br>
                                        <button 
                                            class="btn btn-danger btn-block botonvta my-2" 
                                            id="cobrar"
                                            onclick="cobrar_boton( );"
                                        >
                                            <i class="fal fa-wallet"></i> Cobrar (F2)
                                        </button>
                                        <button 
                                            class="btn btn-info btn-block botonvta my-2" 
                                            id="opciones"
                                            onclick="opciones_boton( );"
                                        >
                                            <i class="fas fa-screwdriver"></i> Opc (F4)
                                        </button>
                                    </center>
                                </div>
                            </div>
                        </div>
                    ';
    
    
        echo $salida;

    }



?>

<script>
    $(document).ready( ( ) => {
        localStorage.setItem('pantalla', 'ventas');
        inicializar_vta( );
    });
</script>