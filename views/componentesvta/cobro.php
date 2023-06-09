<?php

    require_once '../../php/conexion.php';

    $venta = $_POST['venta'];

    $sql = "SELECT monto_v FROM ventas WHERE ventan_v = " . $venta;
    $res = $con->query($sql);
    $res->execute();

    $monto_v = 0;

    foreach ($res as $a) {
        $monto_v = $a['monto_v'];
    }

    
    if ($monto_v > 0) {
        $salida = '
                    
                    <div class="container-fluid">
                    </div>
                    <div class="form-group"> 
                        <label for="forma" class="">Forma de pago</label>
                        <select 
                            id="forma" 
                            class="form-control text-info"
                            onchange="forma_credito( );"
                        >
                            <option value="Efectivo">Efectivo</option>
                            <option value="Tarjeta">Tarjeta</option>
                            <option value="Credito">Credito</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="montov">Monto a pagar</label>
                        <input type="text" id="montov" class="form-control text-info ventat text-right"
                                 value="' . $monto_v . '" disabled="true">
                    </div>
                    <div class="form-group">
                        <label for="pagov">Pago</label>
                        <input type="number" id="pagov" onkeyup="calcular_pago_vta();"
                                    onkeypress="return cobrar_enter(event);"
                                    class="form-control text-info ventat text-right"
                                 value="' . $monto_v . '">
                    </div>
                    <div class="form-group">
                        <label for="cambiov">Cambio</label>
                        <input type="text" id="cambiov" class="form-control text-info ventat text-right"
                                 value="0.00" disabled="true">
                    </div>
                    
                    <div class="alert alert-danger" role="alert" id="error" style="display: none;">
        
                    </div>
                    <br>
                    <button class="btn btn-outline-danger btn-block" id="btnfin" onclick="finalizar_venta();">
                        <i class="fas fa-hdd"></i> Finalizar la venta
                    </button>
    
                ';
    }else {
        $salida = '<span class="text-info" style="font-size:2.0em;">
                        <center>
                            <i class="fas fa-exclamation-triangle"></i><br> 
                            No hay partidas en la venta actual, agrega un producto antes de continuar
                        </center>
                   </span>';
    }


    echo $salida;
?>

<script>
    $(document).ready( ( ) => {
        $('#ventana').on('shown.bs.modal', function () {
            $('#pagov').focus();
            $('#pagov').select();
        });
    });
</script>