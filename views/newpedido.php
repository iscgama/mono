<?php

    require_once '../php/conexion.php';


    $sql = "SELECT nom_pr FROM proveedor";
    $res = $con->query($sql);
    $res->execute();

    $salida = '';


    $salida .= '    <br>
                    <div class="container-fluid text-center">
                        <h1 class="display-4">
                            <i class="fal fa-clipboard-list-check"></i> Nuevo Pedido
                        </h1>
                        <hr class="display-4">
                    </div>
                    ';



                        

    $salida .= '  
                    <div class="container-fluid">
                        <div class="form-group">
                            <label for="pr">Proveedor</label>
                            <select class="form-control formula" id="proveedores">';
                            foreach ($res as $a) {
                                $salida .= '<option>' . $a['nom_pr'] . '</option>';
                            }
                        
    $salida .= '            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pedido" class="mr-3">No. Pedido</label>
                                        <input type="text" id="pedido" class="form-control formula" disabled="true">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fecha" class="mr-3">Fecha</label>
                                        <input type="date" id="fecha" class="form-control formula">
                                    </div>
                                </div>
                            ';

    $salida .= '     
                        </div>
                    </div>

                    <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <input 
                                type="text" 
                                class="form-control my-3" 
                                placeholder="Escanea el codigo de barras" 
                                id="articulo"
                                onkeypress=" validar_tecla_compra ( event )"
                                onkeyup=" validar_tecla_compra ( event )"
                            >
                            <div class="input-group-append">
                                <span class="input-group-text my-3" id="descrip">Descripción</span>
                                <button class="btn btn-danger my-3" id="barticulo" type="button"><i class="fal fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text my-3"><i class="fas fa-calculator-alt"></i></span>
                            </div>
                            <input type="text" id="count" class="form-control my-3" placeholder="Escribe la cantidad a comprar">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text my-3"><i class="far fa-dollar-sign"></i></span>
                            
                            </div>
                            <input type="text" class="form-control my-3" id="price">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-danger btn-block my-3" id="agregar">
                            <i class="fal fa-check-square"></i>
                        </button>
                    </div>
                </div>
                    <div id="detallepedido" class="text-center">
                            
                    </div>
                    <br><br>
                    <div class="container-fluid">
                        <div class="row">
                        <div class="col-md-2"></div>
                            <div class="col-md-4">
                            <button class="btn btn-danger btn-block my-2" id="cpedido">
                                <i class="fal fa-trash"></i> Cancelar pedido
                            </button>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-danger btn-block my-2" id="ttpedido">
                                    <i class="fal fa-save"></i> Guardar pedido
                                </button>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                </div>
                
                ';

    echo $salida;
    
?>

<script>
    $(document).ready(function () {
        localStorage.setItem('pantalla','compras');
        $('#fecha').val(fecha_actual());
        obtener_consec_pedido();
        $('#ttentrada').attr("disabled", true);

        $('#agregar').on('click', function() {
            agregar_renglon_pedido();
            $('#ttpedido').removeAttr("disabled");
        });

        $('#ttpedido').on('click', function() {
            let numpedido = localStorage.getItem('numpedido');
            finalizar_pedido(numpedido);
        });

        $('#cpedido').on('click', function() {
            let numpedido = localStorage.getItem('numpedido');
            $.ajax({
                type: 'POST',
                url: 'php/cancelar_pedido.php',
                data: 'compra=' + numpedido,
                success:function(res) {
                    $('#contenido').load('views/pedidos.html');
                }
            })
        });
    });
</script>