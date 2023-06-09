<?php

    require_once '../php/conexion.php';

    $sql = "SELECT nom_ct FROM clientes WHERE id_ct <> 1
            ORDER BY nom_ct ASC";
    $res = $con->query($sql);
    $res->execute();


    $salida = ' <br>
                <div class="container-fluid">
                <h1 class="display-4">
                    <i class="fa-duotone fa-money-bills-simple"></i> Manejo de Cobranza
                </h1>
                <hr class="display-4">
                <div class="form-group">
                    <label for="clientes">Seleccione el cliente</label>
                    <input list="clientescob" class="form-control" id="cobcte">
                    <datalist id="clientescob">';
                    foreach ($res as $a) {
                        $salida .= '<option value="' . $a['nom_ct'] . '"></option> ';
                    }
    $salida .= '
                    </datalist>
                </div>
                <br>
                <div class="alert alert-danger" role="alert" id="error" style="display: none;">
    
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-outline-dark btn-block"
                                onclick="realizar_consulta();">
                                <i class="far fa-eye"></i> Visualizar
                        </button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-outline-dark btn-block"
                                onclick="realizar_consulta_global();">
                            <i class="fas fa-globe-americas"></i> Global
                        </button>
                    </div>
                </div>
                <br>
                <div id="listacobranza">
                
                </div>
                </div>
                <br><br><br><br>
                ';
    echo $salida;

?>