<?php

    require_once '../php/conexion.php';

    $sql = "SELECT desc_r FROM roles";

    $res = $con->query($sql);
    $res->execute();

    $salida = '
            <h1 class="display-4">
            <i class="fas fa-feather-alt"></i> Registro
            </h1>
            <hr class="display-4">
            <div class="form-group">
                <label for="nombre">Nombre completo</label>
                <input type="text" id="nombre" class="form-control" placeholder="Escribe el nombre completo del usuario">
            </div>   
            <div class="form-group">
                <label for="usuario">Usuario del sistema</label>
                <input type="text" id="usuario" class="form-control" placeholder="Escribe el usuario para iniciar sesión">
            </div>   
            <div class="form-group">
                <label for="pass">Contraseña</label>
                <input type="password" id="pass" class="form-control" placeholder="Escribe la contraseña para ingresar">
            </div>   
            <div class="form-group">
                <label for="roles">Roles de usuario</label>
                <select class="form-control" id="roles">';
                    foreach ($res as $a) {
                        $salida .= '<option>' . $a['desc_r'] . '</option>';
                    }
    $salida .= '</select>
            </div>
            <div class="form-group">
                <label for="sucursales">Sucursal donde trabaja</label>
                <select class="form-control" id="sucursales">';
                $sql = "SELECT nom_s FROM sucursales";

                $res = $con->query($sql);
                $res->execute();
        
                foreach ($res as $a) {
                    $salida .= '<option>' . $a['nom_s'] . '</option>';
                }

    $salida .= '
    </select>
            </div>
            <br>
            <div class="alert alert-danger" role="alert" id="error" style="display: none;">
  
            </div>
            <br>
            <button 
                class="btn btn-outline-danger btn-block" 
                id="gusuario"
                onclick="save_user( );"
            >
                <i class="fas fa-hdd"></i> Guardar datos
            </button>
            
         ';
    echo $salida;

?>

<script>
    $(document).ready( ( ) => {
        $('#ventana').on('shown.bs.modal',  ( ) => {
            $('#nombre').focus();
        });
    });
</script>