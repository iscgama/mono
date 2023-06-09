
    <?php


    require_once '../php/conexion.php';

    $sql = "SELECT `id_emp`, `nom_emp`, `dir_emp`, 
                    `tel_emp`, `cp_emp`, `ciudad_emp`, 
                    `estado_emp` FROM `datos_emp`
            WHERE id_emp = 1";


    $res = $con->query($sql);
    $res->execute();

    $nom_emp = '';
    $dir_emp = '';
    $tel_emp = '';
    $cp_emp = '';
    $ciudad_emp = '';
    $estado_emp = '';



    foreach ($res as $a) {
        $nom_emp = $a['nom_emp'];
        $dir_emp = $a['dir_emp'];
        $tel_emp = $a['tel_emp'];
        $cp_emp = $a['cp_emp'];
        $ciudad_emp = $a['ciudad_emp'];
        $estado_emp = $a['estado_emp'];
    }

    $salida = '<br>
    <br>
    <br>
                <div class="container-fluid">
                    <h1 class="display-4">
                        <i class="fa-duotone fa-dungeon"></i> Datos de la empresa
                    </h1>
                    <hr class="display-4">
                    <div class="form-group">
                        <label for="nombre">Nombre de la empresa</label>
                        <input type="text" class="form-control" id="nombre" value="' . $nom_emp . '">
                    </div>
                    <div class="form-group">
                        <label for="dir">Direccion de la empresa</label>
                        <input type="text" class="form-control" id="dir" value="' . $dir_emp . '">
                    </div>
                    <div class="form-group">
                        <label for="tel">Telefono de la empresa</label>
                        <input type="text" class="form-control" id="tel" value="' . $tel_emp . '">
                    </div>
                    <div class="form-group">
                        <label for="codigo">Código postal de la empresa</label>
                        <input type="text" class="form-control" id="codigo" value="' . $cp_emp . '">
                    </div>
                    <div class="form-group">
                        <label for="ciudadr">Ciudad de la empresa</label>
                        <input type="text" class="form-control" id="ciudadr" value="' . $ciudad_emp . '">
                    </div>
                    <div class="form-group">
                        <label for="estador">Estado de la empresa</label>
                        <input type="text" class="form-control" id="estador" value="' . $estado_emp . '">
                    </div>
                </div>
                <br><br>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                        <button 
                            class="btn btn-danger btn-block" 
                            id="gempresa"
                            onclick="guardar_empresa( );"
                        >
                            <i class="fal fa-save"></i> Guardar datos
                        </button>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </div>
                <br>
                <br>
                <br>
                <br>
                
            ';


    echo $salida;

?>

<script src="actions/empresa.js"></script>