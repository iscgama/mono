<?php

    require_once '../php/conexion.php';

    $sql = "SELECT nom_s FROM sucursales";
    $res = $con->query($sql);
    $res->execute();

    $salida = '     <br>
                    <div class="container-fluid">
                        <h1 class="display-4">
                            <i class="fal fa-people-carry"></i> Nuevo traspaso
                        </h1>
                        <hr class="display-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fecha">Fecha</label>
                                    <input type="date" id="fecha" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="sucursal">Sucursal</label>
                                <input type="text" id="sucursal" list="sucursales" class="form-control">
                                <datalist id="sucursales">';

                            foreach ($res as $a) {
                                $salida .= '<option value="' . $a['nom_s'] . '"></option>';
                            }


        $salida .=        '</datalist>
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
                                        <span class="input-group-text my-3 mb-2" id="descripv">Producto</span>
                                        <button class="btn btn-danger my-3 mb-2" id="barticulo" type="button"><i class="fal fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text my-3 mb-2" id="cant">Cantidad</span>
                                    </div>
                                    <input type="number" class="form-control my-3" placeholder="0.00" value="1" id="cantidades">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-outline-dark btn-block my-3" id="gtras">
                                    <i class="fal fa-plus-square"></i> Agregar
                                </button>
                            </div>
                        </div>
                        <div class="alert alert-danger" role="alert" id="error" style="display: none;">
  
                        </div>
                        <br>
                        <div id="traspasoslist">
                        
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <button class="btn btn-outline-dark btn-block my-2">
                                    <i class="fal fa-window-close"></i> Cancelar traspaso
                                </button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-outline-dark btn-block my-2" onclick="guardar_traspaso();">
                                    <i class="fal fa-save"></i> Guardar traspaso
                                </button>
                            </div>
                        </div>
                    </div>
                    <br><br><br><br><br>
              ';


    echo $salida;

?>

<script>
    $(document).ready( ( ) => {
        localStorage.setItem('pantalla','compras');

        $('#fecha').val(fecha_actual());
        $('#sucursal').focus();
        detalle_traspaso(); 

        $('#gtras').on('click', function() {
            a_traspasos_reng();
        });
    });
</script>