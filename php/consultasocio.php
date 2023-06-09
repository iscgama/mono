<?php


    require_once 'conexion.php';

    $id = $_POST['id'];

    $sql = 'SELECT name_c, dir_c, tel_c, col_c, cp_c, ciudad_c, rfc_c, correo_c, 
                    razon_c, estado_c, fecha_c, nuevo_c FROM socios WHERE id_c = ' . $id;

    $resultado = $con->query($sql);
    $resultado->execute();
    
    foreach ($resultado as $fila) {
        $nombre = $fila['name_c'];
        $dir = $fila['dir_c'];
        $tel = $fila['tel_c'];
        $col = $fila['col_c'];
        $cp = $fila['cp_c'];
        $ciudad = $fila['ciudad_c'];
        $razon = $fila['razon_c'];
        $estado = $fila['estado_c'];
        $fecha = $fila['fecha_c'];
        $rfc = $fila['rfc_c'];
        $correo = $fila['correo_c'];
        $nuevo = $fila['nuevo_c'];
    }


    $salida = '
    <h1 class="display-4">
    Actualizar Socios
            </h1>
            <hr class="display-4">
            <div class="form-group">
                <label for="nombre">Nombre completo</label>
                <input type="text" class="form-control" id="nombre" value="' . $nombre . '">
            </div>
            <div class="form-group">
                <label for="dir">Dirección del socio</label>
                <input type="text" class="form-control" value="' . $dir . '" id="dir" placeholder="Escribe la dirección completa del socio">
            </div>
            <div class="form-group">
                <label for="telefono">Telefono del socio</label>
                <input type="tel" class="form-control" id="telefono" value="' . $tel . '" placeholder="Escribe el telefono del socio">
            </div>
            <div class="form-group">
                <label for="colonia">Colonia del socio</label>
                <input type="text" class="form-control" value="' . $col . '" id="colonia" placeholder="Escribe la colonia del socio">
            </div>
            <div class="form-group">
                <label for="cp">Código postal del socio</label>
                <input type="number" class="form-control" value="' . $cp . '" id="cp" placeholder="Escribe el codigo postal del socio">
            </div>
            <div class="form-group">
                <label for="ciudad">Ciudad del socio</label>
                <input type="text" class="form-control" value="' . $ciudad . '" id="ciudad" placeholder="Escribe la ciudad del socio">
            </div>
            <div class="form-group">
                <label for="razon">Razón Social</label>
                <input type="text" class="form-control" id="razon" value="' . $razon . '" placeholder="Escribe la razon social del socio">
            </div>
            <div class="form-group">
                <label for="estado">Estado</label>
                <input list="estados" type="text" value="' . $estado . '" class="form-control" id="estado" placeholder="Escribe la estado del socio">
                <datalist id="estados">
                    <option value="Aguascalientes">Aguascalientes</option>
                <option value="Baja California">Baja California</option>
                <option value="Baja California Sur">Baja California Sur</option>
                <option value="Campeche">Campeche</option>
                <option value="Chiapas">Chiapas</option>
                <option value="Chihuahua">Chihuahua</option>
                <option value="CDMX">Ciudad de México</option>
                <option value="Coahuila">Coahuila</option>
                <option value="Colima">Colima</option>
                <option value="Durango">Durango</option>
                <option value="Estado de México">Estado de México</option>
                <option value="Guanajuato">Guanajuato</option>
                <option value="Guerrero">Guerrero</option>
                <option value="Hidalgo">Hidalgo</option>
                <option value="Jalisco">Jalisco</option>
                <option value="Michoacán">Michoacán</option>
                <option value="Morelos">Morelos</option>
                <option value="Nayarit">Nayarit</option>
                <option value="Nuevo León">Nuevo León</option>
                <option value="Oaxaca">Oaxaca</option>
                <option value="Puebla">Puebla</option>
                <option value="Querétaro">Querétaro</option>
                <option value="Quintana Roo">Quintana Roo</option>
                <option value="San Luis Potosí">San Luis Potosí</option>
                <option value="Sinaloa">Sinaloa</option>
                <option value="Sonora">Sonora</option>
                <option value="Tabasco">Tabasco</option>
                <option value="Tamaulipas">Tamaulipas</option>
                <option value="Tlaxcala">Tlaxcala</option>
                <option value="Veracruz">Veracruz</option>
                <option value="Yucatán">Yucatán</option>
                <option value="Zacatecas">Zacatecas</option>
                </datalist>
            </div>
            <div class="form-group">
                <label for="fecha">Fecha de afiliación</label>
                <input type="date" class="form-control" value="' . $fecha . '" id="fecha" placeholder="Escribe la fecha de afiliación del socio">
            </div>
            <div class="form-group">
                <label for="rfc">Rfc del socio</label>
                <input type="text" class="form-control" id="rfc" value="' . $rfc . '" placeholder="Escribe la rfc del socio">
            </div>
            <div class="form-group">
                <label for="correo">Correo del socio</label>
                <input type="email" class="form-control" value="' . $correo . '" id="correo" placeholder="Escribe la correo del socio">
            </div>
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="nuevos">
                <label class="custom-control-label" for="nuevos">¿Nuevo socio?</label>
            </div>
            <br>
            <button class="btn btn-outline-primary btn-block" onclick="actualizar_socios(' . $id . ');">
                <i class="fas fa-save"></i> Actualizar datos
            </button>
            <div id="error" class="alert alert-danger" style="display: none;" role="alert">
            
            </div>
        ';


        echo $salida;



?>

<script src="actions/modsocio.js"></script>