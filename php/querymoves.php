<?php

    if ( isset($_POST['id']) ) {
        
        require_once 'conexion.php';
        
        $id = $_POST['id'];

        $sql = "SELECT DATE_FORMAT(a.fecha_ab, '%d-%m-%Y') As fecha_ab, a.hora_ab, a.forma_ab,
                         a.monto_cb, u.name_u
                FROM abonos a
                        INNER JOIN usuarios u ON a.id_u = u.id_u
                WHERE a.id_cb = " . $id;


        $res = $con->query( $sql );
        $res->execute();


        $salida = '
            <div class="container">
                <h1 class="display-4">
                    Abonos realizados
                </h1>
                <hr>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <td>Fecha</td>
                            <td>Hora</td>
                            <td>Pago en</td>
                            <td>Monto</td>
                            <td>Usuario</td>
                        </tr>
                    </thead>
                    <tbody>';

                    foreach ($res as $a) {
                        $salida .= '
                                <tr>
                                    <td>' . $a['fecha_ab'] . '</td>
                                    <td>' . $a['hora_ab'] . '</td>
                                    <td>' . $a['forma_ab'] . '</td>
                                    <td>$' . number_format( $a['monto_cb'], 2 ) . '</td>
                                    <td>' . $a['name_u'] . '</td>
                                </tr>
                        ';
                    }
                    
        $salida .= '</tbody>
                </table>
            </div>
        ';

        echo $salida;


    }else {
        echo 'Consulta con tu administrador antes de continuar';
    }

?>