<?php

$salida = '

    ';

    require_once '../php/conexion.php';

    $sql = "SELECT id_a, desc_a FROM articulos";
    $productos = array( );
    $numbers = array( );

    $res = $con->query( $sql );
    $res->execute( );

    // In this place must be list the product list complete
    foreach ($res as $a) {
        // By once product check sales numbers
        $productos[] = $a['desc_a'];

        $sql2 = "SELECT SUM(cant_v) As Suma 
                    FROM ventas2
                    WHERE id_a = " . $a['id_a'];

        $res2 = $con->query( $sql2 );
        $res2->execute( );


        if ($res2->rowCount( ) > 0) {
            foreach ($res2 as $a2) {
                $numbers[] = $a2['Suma']; 
            }
        }
    }

    $salida .= '
        <br>
        <div class="container-fluid">
            <h1 class="display-4">
                Gráfica de productos vendidos
            </h1>
            <br>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <td>#</td>
                    <td>Descripcion</td>
                    <td>Cantidad</td>
                </tr>
            </thead>
            <tbody>';
            for ($i=0; $i < count( $productos ); $i++) { 
                $salida .= '
                    <tr>
                        <td>' . $i + 1 . '</td>
                        <td>' . $productos[$i] . '</td>
                        <td>' . $numbers[$i] . '</td>
                    </tr>
                ';
            }
            
    $salida .='</tbody>
        </table>
        <br>
        <div>
            <canvas id="myChart"></canvas>
        </div>
        </div>
        <br><br><br><br><br>
    ';

    echo $salida;

?>

<script>
    $(document).ready( ( ) => {
        const ctx = document.getElementById('myChart');
        const prods = <?php echo json_encode( $productos )?>;
        const numbers = <?php echo json_encode( $numbers )?>;


        new Chart(ctx, {
            type: 'polarArea',
            data: {
            labels: prods,
            datasets: [{
                label: '# of Votes',
                data: numbers,
                backgroundColor: [
                    'rgb(100, 150, 200)',
                    'rgb(150, 100, 100)',
                    'rgb(200, 50, 100)',
                    'rgb(90, 70, 200)'
                ],
                borderWidth: 0
            }]
            },
            options: {
            scales: {
                y: {
                beginAtZero: true
                }
            }
            }
        });
    });
</script>