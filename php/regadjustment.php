<?php


    require_once 'conexion.php';

    if ( isset( $_POST['cod'] ) && isset( $_POST['ajuste'] ) && isset( $_POST['idu'] ) ) {
        $cod = $_POST['cod'];
        $ajuste = $_POST['ajuste'];
        $idu = $_POST['idu'];

        $sql = "SELECT id_a, desc_a FROM articulos WHERE cod_a = '" . $cod . "'";
        $res = $con->query( $sql );
        $res->execute( );

        if ( $res->rowCount( ) > 0 ) {
            
            foreach ($res as $a) {
                $descrip = $a['desc_a'];
            }

            $descmov = "Ajuste de inventario del producto: " . $descrip . " a la cantidad: " . $ajuste;

            $sql = "INSERT INTO `movimientos`(`fecha_mov`,`desc_mov`, `id_u`) 
                                    VALUES ( NOW(),  :descmov, :idu)";

            $stm = $con->prepare($sql);
            $stm->bindParam(':descmov', $descmov);
            $stm->bindParam(':idu', $idu);
    
            $stm->execute();

            $sql = "UPDATE articulos SET egral_a = :ajuste WHERE cod_a = :cod";

            $stm = $con->prepare($sql);
            $stm->bindParam(':ajuste', $ajuste);
            $stm->bindParam(':cod', $cod);
    
            $stm->execute();

            echo 1;
        }else {
            echo 'ERROR: código de barras incorrecto';
        }
    }else {
        echo 'Consulta con tu administrador antes de continuar';
    }

?>