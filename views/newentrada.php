<?php

    require_once '../php/conexion.php';


    $sql = "SELECT desc_ce FROM conceptos_ent";
    $res = $con->query($sql);
    $res->execute();

    $salida = '';


    $salida .= '    <br>
                    <div class="container-fluid text-center">
                        <h1 class="display-4">
                            <i class="fas fa-truck-moving"></i> Nueva Entrada
                        </h1>
                        <hr class="display-4">
                        </div>
                    <div class="container-fluid">
                    <div class="input-group">
                        <input list="conceptos" class="form-control my-3" placeholder="Selecciona el concepto de entrada" id="conceptoe">
                        <datalist id="conceptos">
                    ';
                        foreach ($res as $a) {
                            $salida .= '<option value="' . $a['desc_ce'] . '"></option>';
                        }      


                        

    $salida .= '        </datalist>
                    </div>
                    ';
                        
    $salida .= '     
                        <div class="row">
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="entrada" class="mr-3">No. Entrada</label>
                                    <input type="text" id="entrada" class="form-control formula" disabled="true">
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
                            <input 
                                type="text" 
                                id="count" 
                                class="form-control my-3" 
                                placeholder="Escribe la cantidad a comprar"

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
                        <button 
                            class="btn btn-danger btn-block my-3"
                            id="agregar"
                            onclick="agregar_renglon_entrada( );"
                        >
                            <i class="fal fa-check-square"></i>
                        </button>
                    </div>
                </div>
                    <div id="detalleentrada" class="text-center">
                            
                    </div>
                    <br><br>
                    <div class="container-fluid">
                        <div class="row">
                        <div class="col-md-2"></div>
                            <div class="col-md-4">
                            <button class="btn btn-danger btn-block my-2" id="centrada">
                                <i class="fal fa-trash"></i> Cancelar entrada
                            </button>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-danger btn-block my-2" id="ttentrada">
                                    <i class="fal fa-save"></i> Guardar entrada
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
        obtener_consec_entrada( );
        $('#ttentrada').attr("disabled", true);

        $('#ttentrada').on('click', function() {
            let numentrada = localStorage.getItem('numentrada');
            finalizar_entrada(numentrada);
        });

        $('#centrada').on('click', function() {
            let numentrada = localStorage.getItem('numentrada');
            $.ajax({
                type: 'POST',
                url: 'php/cancelar_entrada.php',
                data: 'compra=' + numentrada,
                success:function(res) {
                    $('#contenido').load('views/entradas.html');
                }
            })
        });

        $('#barticulo').on('click', function() {
            let articulo = $('#articulo').val();
            $.ajax({
                type: 'POST',
                url: 'php/searchprods.php',
                data: 'criterio=' + articulo,
                success: function(res) {
                    $('#mensaje').html(res);
                    $('#ventana').modal('toggle');
                }
            });
        });
    });
</script>