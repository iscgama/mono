<?php

    require_once '../php/conexion.php';


    $sql = "SELECT nom_pr FROM proveedor";
    $res = $con->query($sql);
    $res->execute();

    $salida = '';


    $salida .= '    <br>
                    <div class="container-fluid text-center">
                        <h1 class="display-4">
                            <i class="fas fa-shopping-cart"></i> Nueva Compra
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
                                        <label for="compra" class="mr-3">No. Compra</label>
                                        <input type="text" id="compra" class="form-control formula" disabled="true">
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
                    

                    <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <input 
                                type="text" class="form-control my-3" 
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
                                <input 
                                    type="text" 
                                    id="count" 
                                    class="form-control my-3" 
                                    placeholder="Escribe la cantidad a comprar"
                                    onkeypress="pasar_cantidad( event );"
                                >
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
                    <div id="detallecompra" class="text-center">
                            
                    </div>
                    </div>
                    <br><br>
                    <div class="container-fluid">
                        <div class="row">
                        <div class="col-md-2"></div>
                            <div class="col-md-4">
                            <button class="btn btn-danger btn-block my-2" id="ccompra">
                                <i class="fal fa-trash"></i> Cancelar compra
                            </button>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-danger btn-block my-2" id="ttcompra">
                                    <i class="fal fa-save"></i> Guardar Compra
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
    $(document).ready( ( ) => {
        localStorage.setItem('pantalla', 'compras');
        $('#fecha').val(fecha_actual());
        obtener_consec_compra( );
        $('#ttcompra').attr("disabled", true);

        $('#barticulo').on('click', ( ) => {
            busq_prod();
        });


        $('#agregar').on('click', function() {
            agregar_renglon_compra();
            $('#ttcompra').removeAttr("disabled");
        });

        $('#ttcompra').on('click', function() {
            let numcompra = localStorage.getItem('numcompra');
            finalizar_compra( numcompra );
        });

        $('#ccompra').on('click', function() {
            let numcompra = localStorage.getItem('numcompra');
            $.ajax({
                type: 'POST',
                url: 'php/cancelar_compra.php',
                data: 'compra=' + numcompra,
                success:function(res) {
                    $('#contenido').load('views/compras.html');
                }
            })
        });
    });
</script>