<?php

    require_once '../php/conexion.php';

    $sucursal = $_POST['sucursal'];
    $fecha = $_POST['fecha'];

    $sql = "SELECT COUNT(id_u) As Numero FROM usuarios";
    $res = $con->query($sql);
    $res->execute();

    $numusu = 0;

    foreach ($res as $a) {
        $numusu = $a['Numero'];
    }


    $sql = "SELECT COUNT(id_a) As Numero FROM articulos";
    $res = $con->query($sql);
    $res->execute();

    $numprod = 0;

    foreach ($res as $a) {
        $numprod = $a['Numero'];
    }

    $sql = "SELECT COUNT(id_c) As Numero FROM clasificacion";
    $res = $con->query($sql);
    $res->execute();

    $numcla = 0;

    foreach ($res as $a) {
        $numcla = $a['Numero'];
    }

    $sql = "SELECT COUNT(id_m) As Numero FROM marcas";
    $res = $con->query($sql);
    $res->execute();

    $nummarc = 0;

    foreach ($res as $a) {
        $nummarc = $a['Numero'];
    }

    $sql = "SELECT COUNT(id_pr) As Numero FROM proveedor";
    $res = $con->query($sql);
    $res->execute();

    $numprov = 0;

    foreach ($res as $a) {
        $numprov = $a['Numero'];
    }

    $sql = "SELECT SUM(monto_v) As Total FROM ventas 
                WHERE id_s = " . $sucursal . " AND fecha_v = '" . $fecha . "'
                AND corte_v = 0 AND status_v = 1";
    $res = $con->query($sql);
    $res->execute();

    $totalvtas = 0;

    foreach ($res as $a) {
        $totalvtas = $a['Total'];
    }



    $salida = '
                    <br><br><br>
                    <div class="container-fluid">
                        <h1 class="display-4">
                            <i class="fal fa-globe-stand"></i> Resumen global
                        </h1>
                        <hr class="display-4">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="tarjeta">
                                    <div class="elementos">
                                        <div class="logo">
                                            <i class="fal fa-user-friends fa-3x"></i>
                                        </div>
                                        <div class="titulo">
                                            Usuarios
                                        </div>
                                        <div class="contador">
                                            ' . ($numusu - 1) . ' 
                                        </div>
                                    </div>
                                </div>
                                <div class="tarjeta">
                                    <div class="elementos">
                                        <div class="logo">
                                            <i class="fas fa-apple-crate fa-3x"></i>
                                        </div>
                                        <div class="titulo">
                                            Productos registrados
                                        </div>
                                        <div class="contador">
                                            ' . $numprod . ' 
                                        </div>
                                    </div>
                                </div>
                                <div class="tarjeta">
                                    <div class="elementos">
                                        <div class="logo">
                                            <i class="fas fa-layer-group fa-3x"></i>
                                        </div>
                                        <div class="titulo">
                                            Familias registradas
                                        </div>
                                        <div class="contador">
                                            ' . $numcla . ' 
                                        </div>
                                    </div>
                                </div>
                                <div class="tarjeta">
                                    <div class="elementos">
                                        <div class="logo">
                                            <i class="far fa-registered fa-3x"></i>
                                        </div>
                                        <div class="titulo">
                                            Marcas registradas
                                        </div>
                                        <div class="contador">
                                            ' . $nummarc . ' 
                                        </div>
                                    </div>
                                </div>
                                <div class="tarjeta">
                                    <div class="elementos">
                                        <div class="logo">
                                        <i class="fas fa-user-tie fa-3x"></i>
                                        </div>
                                        <div class="titulo">
                                            Proveedor registrados
                                        </div>
                                        <div class="contador">
                                            ' . $numprov . ' 
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-6">
                                    <h1 class="display-4 my-3">
                                        <i class="fas fa-coins"></i> Resumen de ventas
                                    </h1>
                                    <hr class="display-4">
                                    <div class="tarjeta">
                                        <div class="elementos">
                                            
                                            <div class="titulo2">
                                                Venta:<br> $' . number_format($totalvtas, 2) . '
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <br><br><br><br><br><br>
              ';



    echo $salida;

?>

<script>
    $(document).ready( ( ) => {
        $.ajax({
            type: 'POST',
            url: 'php/resumen.php',
            success:( res ) => {
                $('#listaresumen').html(res);
            }
        })
    });
</script>