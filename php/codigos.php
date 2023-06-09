<?php


    require_once 'conexion.php';

    $id = $_POST['id'];

    $sql = "SELECT cod_a, desc_a FROM articulos
                WHERE id_a = " . $id;

    $res = $con->query($sql);
    $res->execute();

    $cod_a = '';
    $desc_a = '';

    foreach ($res as $a) {
        $cod_a = $a['cod_a'];
        $desc_a = $a['desc_a'];
    }

    $salida = '
                <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                    <h1 class="display-4"><i class="fal fa-barcode"></i> Lista de códigos</h1>
                    <p class="lead">Codigo de barras actual: <span id="ida">' . $cod_a . '</span> Producto: ' . $desc_a . '</p>
                    </div>
                </div>
              ';


    $sql = "SELECT id_b, cod_b FROM codigos
            WHERE coda_b = '" . $cod_a .  "'";


  $res = $con->query($sql);
  $res->execute();


     $salida .= '<div class="container-fluid">
                <table id="example" class="table dt-responsive table-striped table-bordered tablas" style="width:100%">
        		 <thead>
		            <tr>
		            	<th>#</th>
		                <th>Código</th>
		                <th>Acciones</th>
		            </tr>
		        </thead>
		        <tbody>
               ';
        $num = 1;
    foreach ($res as $a) {
        $salida .= '<tr>';
        $salida .= '
                    <td>' . $num .  '</td>
                    <td>' . $a['cod_b'] . '</td>';
                    
        $salida .= "
                        <td>
                                <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    <i class='fas fa-cog'></i>
                                </a>
                            <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                <a class='dropdown-item' id='" . $a['id_b'] . "' onclick='eliminar_codigo(this.id)'><i class='fal fa-trash-alt'></i> Eliminar código</a>
                            </div> 
                        </td>
                    ";
        
        $salida .= '</tr>';
        $num += 1;
    }


    $salida .= '</tbody></table>
                <br>
                <div class="form-group">
                    <label for="codigo">Código de barras nuevo</label>
                    <input type="text" placeholder="Escanee el código de barras" id="codigon" class="form-control">
                </div>
                <br>
                <div class="alert alert-danger" role="alert" id="error" style="display: none;">
  
                </div>
                <button 
                    class="btn btn-danger btn-block" 
                    id="ncodigo"
                    onclick="save_code();"
                >
                    <i class="fal fa-puzzle-piece"></i> Agregar codigo
                </button>
                <br>
                <br>
                <br>
                ';
    echo $salida;

?>
<script>

    $(document).ready( ( ) => {
        $('.tablas').DataTable();
        $('#codigon').focus();
    });
</script>