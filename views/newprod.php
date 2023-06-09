<?php

    require_once '../php/conexion.php';


    $sql = "SELECT desc_c FROM clasificacion ORDER BY desc_c ASC";

    $res = $con->query($sql);
    $res->execute();

   $salida = ' 
                <br>
                <div class="container-fluid">
                    <h1 class="display-4">
                        Registro de productos
                    </h2>
                    <br>
                    <div class="container-fluid">
                    <div class="alert alert-danger" role="alert" id="error" style="display: none;">
                    
                    </div>
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fas fa-home"></i> Principal</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fas fa-dollar-sign"></i> Mayoreo</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false"><i class="fas fa-layer-group"></i> Inventario</a>
                    </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="form-group">
                            <label for="codigo"><i class="fas fa-barcode-alt"></i> Código de barras</label>
                            <input 
                                type="text" 
                                id="codigo" 
                                class="form-control siguiente" 
                                tabindex="1"
                                onkeypress="busqueda_prods( event )"
                            >
                        </div>
                        
                        <div class="form-group">
                            <label for="desc"><i class="far fa-tag"></i> Descripción del artículo</label>
                            <input 
                                type="text" 
                                id="desc" 
                                class="form-control siguiente" 
                                tabindex="3"
                                onkeypress="focus_Next( event, \'costo\' )"
                            >
                        </div>
                        <div class="form-group">
                            <label for="costo"><i class="fal fa-dollar-sign"></i> Costo del artículo</label>
                            <input 
                                type="number" 
                                id="costo" 
                                class="form-control siguiente" 
                                tabindex="4"
                                onkeypress="focus_Next( event, \'precio\' )"
                                value="0"
                            >
                        </div>
                        <div class="form-group">
                            <label for="precio"><i class="fal fa-dollar-sign"></i> Precio del artículo</label>
                            <input 
                                type="number" 
                                id="precio" 
                                class="form-control siguiente" 
                                tabindex="5"
                                onkeypress="focus_Next( event, \'existencia\' )"
                                value="0"
                            >
                        </div>
                        <div class="form-group">
                            <label for="existencia"><i class="fal fa-dollar-sign"></i> Existencia General</label>
                            <input 
                                type="number" 
                                id="existencia" 
                                class="form-control siguiente" 
                                tabindex="6"
                                onkeypress="focus_Next( event, \'clasif\' )"
                                value="0"
                            >
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-8" id="clasificaciones">
                                    <label for="clasif">Clasificación del artículo</label>
                                    <select 
                                        class="form-control siguiente" 
                                        id="clasif" 
                                        tabidex="7"
                                        onkeypress="focus_Next( event, \'newclasif\' )"
                                    >';

                                    foreach ($res as $a) {
                                        $salida .= '<option>' . $a['desc_c'] . '</option> ';
                                    }

            $salida .= '            </select>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="newclasif">Agregar</label>
                                        <input 
                                            type="text" 
                                            class="form-control siguiente" 
                                            id="newclasif" 
                                            tabindex="8"
                                            onkeypress="focus_Next( event, \'marca\' )"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-8" id="marcas">
                                    <label for="marca">Marca del artículo</label>
                                    <select 
                                        class="form-control siguiente" 
                                        id="marca" 
                                        tabindex="9"
                                        onkeypress="focus_Next( event, \'newmarca\' )"
                                    >';
                                    $sql = "SELECT desc_m FROM marcas ORDER BY desc_m ASC";

                                    $res = $con->query($sql);
                                    $res->execute();

                                    foreach ($res as $a) {
                                        $salida .= '<option>' . $a['desc_m'] . '</option> ';
                                    }
            $salida .= '            </select>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="newmarca">Agregar</label>
                                        <input 
                                            type="text" 
                                            class="form-control siguiente" 
                                            id="newmarca" 
                                            tabindex="10"
                                            onkeypress="focus_Next( event, \'favorito\' )"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="favorito" value="option1">
                            <label class="form-check-label" for="favorito">Producto favorito</label>
                        </div>        
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="may1"><i class="fal fa-dollar-sign"></i> Precio Mayoreo 1</label>
                                    <input type="number" id="may1" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cant1"><i class="fas fa-calculator"></i> A partir de</label>
                                    <input type="number" id="cant1" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="may2"><i class="fal fa-dollar-sign"></i> Precio Mayoreo 2</label>
                                    <input type="number" id="may2" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cant2"><i class="fas fa-calculator"></i> A partir de</label>
                                    <input type="number" id="cant2" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="may3"><i class="fal fa-dollar-sign"></i> Precio Mayoreo 3</label>
                                    <input type="number" id="may3" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cant3"><i class="fas fa-calculator"></i> A partir de</label>
                                    <input type="number" id="cant3" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <div class="form-group">
                            <label for="smin"><i class="fas fa-arrow-down"></i> Stock mínimo</label>
                            <input type="number" id="smin" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="smax"><i class="fas fa-arrow-up"></i> Stock máximo</label>
                            <input type="number" id="smax" class="form-control">
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="granel">
                            <label class="form-check-label" for="granel"><i class="fas fa-fill-drip"></i> Vender a granel</label>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="inventario" checked="true">
                            <label class="form-check-label" for="inventario"><i class="fas fa-list-ol"></i> Maneja inventario</label>
                        </div>
                    </div>
                    </div>
                    <br>
                    <button 
                        class="btn btn-outline-danger btn-block" 
                        id="gprod"
                        onclick="registrar_producto();"
                    >
                        <i class="fas fa-hdd"></i> Guardar datos
                    </button>
                    </div>
                </div>
                <br><br><br><br>
              ';

    echo $salida;

?>

<script>
    $(document).ready( ( ) => {
        let codigo = localStorage.getItem('codprod');
        $('#codigo').focus();
        if (codigo != '') {
            localStorage.setItem('codprod', '');
            $('#codigo').val(codigo);
            buscar_producto_registro();
        }
    });
</script>