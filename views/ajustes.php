<?php

    require_once '../php/conexion.php';


    $salida = '
        <br>
        <div class="container-fluid">
            <h1 class="display-4">
                Ajuste de inventario
            </h1>
            <hr>
            <div class="form-group">
                <label for="articulo">Codigo de barras</label>
                <input 
                    type="text" 
                    id="articulo" 
                    class="form-control"
                    onkeypress=" validar_tecla_compra ( event )"
                    onkeyup=" validar_tecla_compra ( event )"
                >
            </div>
            <div class="form-group">
                <label for="descrip">Descripcion del producto</label>
                <input type="text" id="descrip" class="form-control" disabled>
            </div>
            <div class="form-group">
                <label for="exist">Existencia del producto</label>
                <input type="text" id="exist" class="form-control" disabled>
            </div>
            <div class="form-group">
                <label for="ajuste">Ajuste (+/-)</label>
                <input type="text" id="ajuste" class="form-control">
            </div>
            <br>
            <div class="alert alert-danger" role="alert" id="error" style="display: none;">
                    
            </div>
            <button 
                class="btn btn-outline-danger btn-block my-3"
                onclick="save_adjustment( );"
            >
                <i class="fas fa-plus-circle"></i> Guardar ajuste
            </button>
        </div>
    
    ';


    echo $salida;


?>


<script>
    $(document).ready( ( ) => {
        localStorage.setItem('pantalla', 'compras');
        $('#articulo').focus( );
    });
</script>