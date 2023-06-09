<?php

    require_once '../php/conexion.php';

    
    $id_ct = '';
    $nom_ct = '';
    $dir_ct = '';
    $tel_ct = '';
    $pob_ct = '';
    $est_ct = '';
    $saldo_ct = '';
    $lprecio_ct = '';
    $id_ctc = '';
    $limite_ct = '';

    if (isset($_POST['id'])) {

        $id = $_POST['id'];

        $sql = "SELECT `id_ct`, `nom_ct`, `dir_ct`, `tel_ct`, 
                        `pob_ct`, `est_ct`, `saldo_ct`,
                         `lprecio_ct`, `id_ctc`, `limite_ct`
                FROM clientes
                WHERE id_ct = " . $id;


        $res = $con->query($sql);
        $res->execute();

        

        foreach ($res as $a) {
            $id_ct = $a['id_ct'];
            $nom_ct = $a['nom_ct'];
            $dir_ct = $a['dir_ct'];
            $tel_ct = $a['tel_ct'];
            $pob_ct = $a['pob_ct'];
            $est_ct = $a['est_ct'];
            $saldo_ct = $a['saldo_ct'];
            $lprecio_ct = $a['lprecio_ct'];
            $id_ctc = $a['id_ctc'];
            $limite_ct = $a['limite_ct'];
        }

    }

    $sql = "SELECT desc_ctc FROM clasifcte";

    $res = $con->query($sql);
    $res->execute();

    $salida = '
            <h1 class="display-4">
            <i class="fas fa-feather-alt"></i> ' . (isset($_POST['id']) ? 'Actualizar' : 'Registro') . '
            </h1>
            <hr class="display-4">
            <div class="form-group">
                <label for="nombre">Nombre Completo</label>
                <input type="text" id="nombre" class="form-control" value="' . $nom_ct . '" placeholder="Escribe el nombre completo del cliente">
            </div>   
            <div class="form-group">
                <label for="direccion">Dirección del cliente</label>
                <input type="text" id="direccion" class="form-control" value="' . $dir_ct . '" placeholder="Escribe la direccion del cliente">
            </div>   
            <div class="form-group">
                <label for="telefono">Teléfono del cliente</label>
                <input type="tel" id="telefono" class="form-control" value="' . $tel_ct . '" placeholder="Escribe el telefono del cliente">
            </div>   
            <div class="form-group">
                <label for="poblacion">Ciudad</label>
                <input type="text" id="poblacion" class="form-control" value="' . $pob_ct . '" placeholder="Escribe el nombre de la ciudad">
            </div>   
            <div class="form-group">
                <label for="estado">Estado</label>
                <input type="text" id="estado" class="form-control" value="' . $est_ct . '" placeholder="Escribe el nombre del estado">
            </div>
            <div class="form-group">
                <label for="limite">Limite de credito del cliente</label>
                <input type="number" value="' . $limite_ct . '" id="limite" class="form-control" placeholder="0.00">
            </div>
            <div class="form-group">
                <label for="lista">Lista de precios</label>
                <select class="form-control" id="lista">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>
            </div>
            <div class="form-group">
                <label for="clasifica">Clasificación del cliente</label>
                <select class="form-control" id="clasifica">';
                    foreach ($res as $a) {
                        $salida .= '<option>' . $a['desc_ctc'] . '</option>';
                    }
    $salida .= '</select>
            </div>
            <br>
            <div class="alert alert-danger" role="alert" id="error" style="display: none;">
  
            </div>
            <br>
           
            
         ';

    if (isset($_POST['id'])) { 
        $salida .= '
                    <button class="btn btn-outline-danger btn-block" id="' . $id . '" onclick="actualizar_cte(this.id)">
                        <i class="fas fa-hdd"></i> Actualizar datos
                    </button>
                   ';
    }else {
        $salida .= '
                    <button class="btn btn-outline-danger btn-block" id="gcte">
                        <i class="fas fa-hdd"></i> Guardar datos
                    </button>
                    ';
    }
    echo $salida;

?>

<script>
    $(document).ready( () => {
        $('#ventana').on('shown.bs.modal',  () => {
            $('#nombre').focus();
        });

        $('#gcte').on('click', () => {
            guardar_datos(0, 0);
        });
    });
</script>