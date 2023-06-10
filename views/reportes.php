<?php

    require_once '../php/conexion.php';

    $sql = "SELECT user_u FROM usuarios";

    $res = $con->query( $sql );
    $res->execute( );

    if ( $res->rowCount( ) > 0 ) {
        $salida = '
                <br>
                <div class="container-fluid">
                    <h1 class="display-4">
                        <i class="fad fa-chart-pie-alt"></i> Reporte de ventas
                    </h1>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fechai">Fecha inicial</label>
                                <input type="date" id="fechai" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fechaf">Fecha final</label>
                                <input type="date" id="fechaf" class="form-control">
                            </div>
                        </div>
                        
                    </div>
                    <button 
                        class="btn btn-outline-primary btn-block"
                        onclick="ventasXFecha( );"
                    >
                        <i class="fad fa-chart-pie-alt"></i> Generar reporte
                    </button>
                    <br><br>
                    <div id="reporte">
                    
                    </div>
                </div>
        ';
    }else {
        $salida = '
            Antes de continuar debe existir un usuario para realizar el reporte
        ';
    }

    

    echo $salida;

?>

<script>
    $(document).ready( ( ) => {
        $('#fechai').val( fecha_actual ( ) );
        $('#fechaf').val( fecha_actual ( ) );
    });
</script>