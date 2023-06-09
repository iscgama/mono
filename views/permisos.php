<?php

    require_once '../php/conexion.php';

    $usuario = $_POST['usuario'];
    

    $sql = "SELECT name_u FROM usuarios WHERE id_u = " . $usuario;
    $res = $con->query($sql);
    $res->execute();

    foreach ($res as $a) {
        # code...
    }

    $salida = '
                    <h1 class="display-4">
                        Permisos de venta: ' . $usuario . '
                    </h1>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="productos">
                                    <label class="form-check-label" for="productos"><i class="far fa-boxes"></i> Productos</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="clasif">
                                    <label class="form-check-label" for="clasif"><i class="fas fa-layer-group"></i> Familias</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="marcas">
                                    <label class="form-check-label" for="marcas"><i class="far fa-registered"></i> Marcas</label>
                                </div>
                            </div>
                        </div>
                    </div>
              ';

    echo $salida;
?>