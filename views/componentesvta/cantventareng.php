<?php


    require_once '../../php/conexion.php';

    $id = $_POST['id'];

    $sql = "SELECT v.cant_v, a.granel_a, v.precio_v FROM ventas2 v 
            INNER JOIN articulos a ON v.id_a = a.id_a
            WHERE idc_v = " . $id;

    //echo $sql;
    $res = $con->query($sql);
    $res->execute();

    $cant = 0;

    foreach ($res as $a) {
        $cant = $a['cant_v'];
        $granel = $a['granel_a'];
        $precio = $a['precio_v'];
    }

    $salida = '
               <div class="row">
                   <div class="col-md-6">
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" value="' . $cant . '"  
                            onkeypress="return tecla(event, ' . $id . ', ' . $granel . ', this.value)"
                            aria-describedby="basic-addon2" id="canvta">
                            <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">Cantidad</span>
                            </div>
                        </div>
                   </div>
                   <div class="col-md-6">
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" value="' . $precio . '"  
                            id="precio" disabled="true">
                            <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">Precio</span>
                            </div>
                        </div>
                   </div>
               </div>
              ';
    if ($granel == 1) {
        $salida .= '
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" placeholder="" 
                                aria-describedby="basic-addon2" id="pricevta">
                            <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">$</span>
                            </div>
                        </div>
                    ';
    }

    $salida .= '
                <br>
                <div class="alert alert-danger" role="alert" id="error" style="display: none;">

                </div>
                <br>
                <button class="btn btn-outline-dark btn-block"
                        onclick="send_data(' . $id . ', ' . $granel . ');">
                    <i class="fas fa-paper-plane"></i> Enviar
                </button> 
                ';


    echo $salida;
?>

<script src="actions/cantventareg.js"></script>