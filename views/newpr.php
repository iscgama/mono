<?php

    require_once '../php/conexion.php';

    $id_pr = '';
    $nom_pr = '';
    $repr_pr = '';
    $dir_pr = '';
    $tel_pr = '';
    $pob_pr = '';
    $est_pr = '';
    $col_pr = '';
    $saldo_pr = '';


    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        $sql = "SELECT id_pr, nom_pr, repr_pr, dir_pr, 
                    tel_pr, pob_pr, est_pr, col_pr, saldo_pr 
                FROM proveedor WHERE id_pr = " . $id;
        $res = $con->query($sql);
        $res->execute();

        foreach ($res as $a) {
            $id_pr = $a['id_pr'];
            $nom_pr = $a['nom_pr'];
            $repr_pr = $a['repr_pr'];
            $dir_pr = $a['dir_pr'];
            $tel_pr = $a['tel_pr'];
            $pob_pr = $a['pob_pr'];
            $est_pr = $a['est_pr'];
            $col_pr = $a['col_pr'];
            $saldo_pr = $a['saldo_pr'];
        }
    }



    $salida = '
                <h1 class="display-4">
                <i class="fas fa-feather-alt"></i> ' . (isset($_POST['id']) ? 'Actualizar' : 'Registro') . '
                </h1>
                <hr class="display-4">
                <div class="alert alert-danger" role="alert" id="error" style="display: none;">

                </div>
                <div class="form-group">
                    <label for="razon">Razón social</label>
                    <input type="text" id="razon" class="form-control" value="' . $nom_pr . '" placeholder="Escribe la razón social del proveedor">
                </div>   
                <div class="form-group">
                    <label for="nombre">Nombre Completo</label>
                    <input type="text" id="nombre" class="form-control" value="' . $repr_pr . '" placeholder="Escribe el nombre completo del proveedor">
                </div>   
                <div class="form-group">
                    <label for="direccion">Dirección del proveedor</label>
                    <input type="text" id="direccion" class="form-control" value="' . $dir_pr . '" placeholder="Escribe la direccion del proveedor">
                </div>   
                <div class="form-group">
                    <label for="colonia">Colonia del proveedor</label>
                    <input type="text" id="colonia" class="form-control" value="' . $col_pr . '" placeholder="Escribe la colonia del proveedor">
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono del proveedor</label>
                    <input type="tel" id="telefono" class="form-control" value="' . $tel_pr . '" placeholder="Escribe la telefono del proveedor">
                </div>   
                <div class="form-group">
                    <label for="poblacion">Población del proveedor</label>
                    <input type="text" id="poblacion" class="form-control" value="' . $pob_pr . '" placeholder="Escribe la poblacion del proveedor">
                </div>   
                <div class="form-group">
                    <label for="estado">Estado del proveedor</label>
                    <input type="text" id="estado" class="form-control" value="' . $est_pr . '" placeholder="Escribe la estado del proveedor">
                </div>
                <div class="form-group">
                    <label for="saldo">Saldo de pago del proveedor</label>
                    <input type="number" id="saldo" class="form-control" value="' . $saldo_pr . '" placeholder="0.00">
                </div>
                <br>
                
                <br>
              ';

    if (isset($_POST['id'])) {
        $salida .= '
                    <button class="btn btn-outline-danger btn-block" onclick="editar_prov(' . $id . ')">
                        <i class="fas fa-hdd"></i> Actualizar datos
                    </button>
                   ';
    }else {
        $salida .= '<button 
                        class="btn btn-outline-danger btn-block" 
                        id="gcte"
                        onclick="guardar_datos_pr( );"
                    >
                        <i class="fas fa-hdd"></i> Guardar datos
                    </button>';
    }

    echo $salida;


?>

<script>
    $(document).ready( ( ) => {
        $('#ventana').on('shown.bs.modal',  ( ) => {
            $('#razon').focus();
        });
    });
</script>