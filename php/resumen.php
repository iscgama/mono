<?php

    require_once 'conexion.php';


    $sql = "SELECT SUM(monto_f) As Ingresos FROM flujos 
			WHERE tipo_f = 'I'
            ";
            

	$resultado = $con->query($sql);
    $resultado->execute();
    
    $ingresos = 0;

    foreach ($resultado as $fila) { 
        $ingresos = $fila['Ingresos'];
    }

    $sql = "SELECT SUM(monto_f) As egresos FROM flujos 
    WHERE tipo_f = 'E'
    ";
    

    $resultado = $con->query($sql);
    $resultado->execute();

    $egresos = 0;

    foreach ($resultado as $fila) { 
    $egresos = $fila['egresos'];
    }

    echo '
          <div class="container-fluid">
          <canvas id="grafica"">
          </canvas>
          <br><br>

            <ul class="list-group list-group-horizontal-md" style="text-align:center;">
                <li class="list-group-item" style="color:green;">Ingresos: $' . number_format($ingresos, 2) . '</li>
                <li class="list-group-item"  style="color:red;">Egresos: $' . number_format($egresos, 2) . '</li>
                <li class="list-group-item"  style="color:blue;">Total en caja: $' . number_format($ingresos - $egresos, 2) . '</li>
            </ul>
            <span style="color:white;" id="cingreso">
                ' . $ingresos . '
            </span>
            <span style="color:white;" id="cegreso">
                ' . $egresos . '
            </span>
            <span style="color:white;" id="ctotal">
                ' . number_format($ingresos - $egresos, 2) . '
            </span>
          </div>  
    ';

?>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script>
    $(document).ready( function() {
        //alert($('#ctotal').html());

        let numero = 0;

        numero = parseFloat($('#cingreso').html()) -  parseFloat($('#cegreso').html());
        
        var oilCanvas = document.getElementById("grafica");

        Chart.defaults.global.defaultFontFamily = "Lato";
        Chart.defaults.global.defaultFontSize = 16;

        var oilData = {
            labels: [
                "Ingresos",
                "Egresos",
                "Total en caja"
            ],
            datasets: [
                {
                    data: [
                        $('#cingreso').html(), $('#cegreso').html(), numero
                    ],
                    backgroundColor: [
                        "#28BC60",
                        "#D10000",
                        "#001C7A"
                    ]
                }]
        };

        var pieChart = new Chart(oilCanvas, {
        type: 'pie',
        data: oilData
        });

        
    });
</script>

