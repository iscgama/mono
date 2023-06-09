<?php


    require_once 'conexion.php';

    $salida = '';

    $sql = "SELECT name_c FROM socios 
			";

	$resultado = $con->query($sql);
    $resultado->execute();
    
    $salida = '     <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="socio"><i class="fas fa-user-check"></i> Selecciona de la lista al socio</label>
                                <input list="personas" id="socio" type="text" class="form-control" placeholder="Escribe el nombre del socio a generar">
                                <datalist id="personas">
                                ';
                                foreach ($resultado as $fila) {
                                    $salida .= '<option value="' . $fila['name_c'] . '"></option> ';
                                }
                                                        
                                 $salida .= '
                                                    </datalist>
                                                </div>
                                          ';
                                
    $salida.= '
                        </div>
                        <div class="col-md-6">
                            <br>
                            <button class="btn btn-outline-primary btn-block" id="generar" onclick="reporte_ind();">
                                <i class="fas fa-file-chart-line"></i> Generar reporte
                            </button>
                        </div>
                    </div>
                   
                            ';
                    
    

    echo $salida;


?>