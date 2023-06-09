<?php

    require_once 'conexion.php';

    $id = $_POST['id'];

    $sql = "SELECT v.idc_v, v.id_a, a.desc_a, v.cant_v, v.precio_v 
                FROM ventas2 v 
                INNER JOIN articulos a ON v.id_a = a.id_a
                WHERE v.id_v = " . $id;

    $res = $con->query($sql);
    $res->execute();

    $salida = '
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-stripe">
                        <thead class="thead-dark">
                            <tr>
                                <td>#</td>
                                <td>Descripción</td>
                                <td>Vendidas</td>
                                <td>Devolver</td>
                                <td>Acciones</td>
                            </tr>
                        </thead>
                        <tbody>
                            
              ';
    
              $numreng = 0;
    
    foreach ($res as $a) {
        $salida .= '
                        <tr>
                            <td id="a' . $numreng . '">' . $a['id_a'] . '</td>
                            <td>' . $a['desc_a'] . '</td>
                            <td id="v' . $numreng .'">' . $a['cant_v'] . '</td>
                            <td>
                                <input type="number" name="' . $a['idc_v'] . '" id="c' . $numreng . '"
                                            onkeyup="cambiar_cantidad(this.id);" 
                                            class="form-control cantv">
                            </td>
                            <td>
                                <button class="btn btn-outline-danger btn-block gdev"
                                        onclick="aplicar_devolucion(this.id);" id="' . $numreng . '">
                                    <i class="fas fa-undo-alt"></i> Devolver
                                </button>
                            </td>
                        </tr>
                    ';
        $numreng++;
    }

    $salida .= '
                        </tbody>
                    </table>
                    </div>
                    <span id="countvta" style="display:none;">' . $numreng .  '</span>
                    <br><br>
                    <button class="btn btn-outline-danger btn-block" id="gdevolvervta">
                        <i class="fal fa-puzzle-piece"></i> Terminar devolución
                    </button>
                    ';
    echo $salida;

?>

<script src="actions/devop.js"></script>