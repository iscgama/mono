<?php

    require_once 'conexion.php';

    $cliente = $_POST['cliente'];
    $saldo = $_POST['saldo'];


    $salida = '
                <h1 class="display-4">
                    <i class="fal fa-wallet"></i> Abono
                </h1>
                <hr class="display-4">
                <div class="form-group">
                    <label for="formapago">Forma de pago</label>
                    <select id="formapago" class="form-control">
                        <option>Efectivo</option>
                        <option>Tarjeta</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="monto">Monto a pagar</label>
                    <input type="number" class="form-control" id="monto" value="' . $saldo . '">
                </div>
                <br>
                <div class="alert alert-danger" role="alert" id="error" style="display: none;">

                </div>
                <br>
                <button class="btn btn-outline-danger btn-block" onclick="aplicar_abono();">
                        <i class="fas fa-hdd"></i> Realizar abono
                </button>
            ';

    echo $salida;

?>

<script>
    $(document).ready( ( ) => {
        localStorage.setItem('montoabono', $('#monto').val());

        $('#ventana').on('shown.bs.modal', function () {
            $('#monto').select();
            $('#monto').focus();
        });
    });
</script>