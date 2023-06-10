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
                <label for="codigo">Codigo de barras</label>
                <input type="text" id="codigo" class="form-control">
            </div>
            <div class="form-group">
                <label for="desc">Descripcion del producto</label>
                <input type="text" id="desc" class="form-control" disabled>
            </div>
            <div class="form-group">
                <label for="exist">Existencia del producto</label>
                <input type="text" id="exist" class="form-control" disabled>
            </div>
            <div class="form-group">
                <label for="ajuste">Ajuste (+/-)</label>
                <input type="text" id="ajuste" class="form-control">
            </div>
            <button class="btn btn-outline-danger btn-block my-3">
                <i class="fas fa-plus-circle"></i> Guardar ajuste
            </button>
        </div>
    
    ';


    echo $salida;


?>