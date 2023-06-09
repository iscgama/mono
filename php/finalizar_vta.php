<?php


    require_once 'conexion.php';

    $venta = $_POST['venta'];
    $pago = $_POST['pago'];
    $cambio = $_POST['cambio'];
    $forma = $_POST['forma'];
    $idu = $_POST['idu'];
    $cliente = $_POST['cliente'];

    $existe = "";

    if ($forma == 'Credito') {

        //Obtenemos el limite del credito del cliente seleccionado
        $sql = "SELECT saldo_ct, limite_ct, id_ct FROM clientes WHERE nom_ct = '" . $cliente . "'";
        $res = $con->query($sql);
        $res->execute();

        $saldo_ct = 0;
        $limite_ct = 0;
        $id_ct = 0;

        foreach ($res as $a) {
            $saldo_ct = $a['saldo_ct'];
            $limite_ct = $a['limite_ct'];
            $id_ct = $a['id_ct'];
        }

        if ($id_ct == 0) {
            echo 'El cliente que seleccionaste no existe intenta de nuevo con otro cliente';
            die();
        }


        if ($limite_ct != 0) {
            $limite_ct = $limite_ct - ($saldo_ct + abs($cambio));
    
    
            if ($limite_ct < 0) {
                echo 'El limite del cliente no alcanza para realizar la venta a credito';
                die();
            }
        }

        //Sumamos el saldo más el adeudo a pagar y lo actualizarmos en el saldo del cliente
        $limite_ct = $saldo_ct + abs($cambio);

        $sql = "UPDATE clientes SET saldo_ct = " . $limite_ct . " WHERE nom_ct = '" . $cliente . "'";
        $res = $con->query($sql);
        $res->execute();

        $cambio = abs($cambio);

        //Insertamos un renglon de abonos para manejar la cobranza del cliente
        $sql = "INSERT INTO `cobranza`(`id_cb`, `fecha_cb`, `hora_cb`, 
                            `id_ct`, `monto_cb`, `saldo_cb`, `id_v`, `id_u`) 
                VALUES (null, NOW(), NOW(), :idc, :monto, :saldo, :venta, :idu)";
                
        $statement = $con->prepare($sql);
        $statement->bindParam(':idc', $id_ct);
        $statement->bindParam(':monto', $cambio);
        $statement->bindParam(':saldo', $cambio);
        $statement->bindParam(':venta', $venta);
        $statement->bindParam(':idu', $idu);

        $statement->execute();
    }


    //Actualizamos la venta en el status 1 (Confirmada), La Forma de pago y el cambio
    //Pagados por el cliente
    
    $sql = "UPDATE ventas SET forma_v = :forma, pago_v = :pago, 
                cambio_v = :cambio, status_v = 1 
            WHERE ventan_v = :venta";

            
    $statement = $con->prepare($sql);
    $statement->bindParam(':forma', $forma);
    $statement->bindParam(':pago', $pago);
    $statement->bindParam(':cambio', $cambio);
    $statement->bindParam(':venta', $venta);

    $statement->execute();


    //Afectamos el inventario de manera general

    //1.- Consultamos cada renglón de la venta actual
    $sql = "SELECT cant_v, id_a FROM ventas2 WHERE id_v = " . $venta;
    $res = $con->query($sql);
    $res->execute();


    //Por cada renglón o producto de la venta vamos verificar las existencias de la sucursal
    foreach ($res as $a) {
        $ida = $a['id_a'];

        //Verificamos que el producto tenga manejo de inventario antes de modificar su existencia
        $consulta = "SELECT inv_a FROM articulos WHERE id_a = " . $ida;
        $resultado = $con->query($consulta);
        $resultado->execute();

        foreach ($resultado as $t) {
            $inventario = $t['inv_a'];
        }

        //Si el producto maneja inventario entonces se descuenta de inventario en sucursal
        if ($inventario == 1) {
                $sql2 = "SELECT egral_a FROM articulos WHERE id_a = " . $ida;
                $res2 = $con->query($sql2);
                $res2->execute();
        
                
                foreach ($res2 as $a2) {
                    $existe = $a2['egral_a'];
                }
        
                //Sino se ha asignado una cantidad de productos a la sucursal anexamos el producto
                //Con la existencia negativa
                if ($existe == null) {
                    $existe = 0;
                    $existe = 0 - $a['cant_v'];
                }else {
                    $existe -= $a['cant_v'];
                }
                    
                    
                    
                $sql3 = "UPDATE articulos SET egral_a = :existe 
                            WHERE id_a = :ida";

                        
                $statement = $con->prepare($sql3);
                $statement->bindParam(':existe', $existe);
                $statement->bindParam(':ida', $ida);

                $statement->execute();
            }   
        }


    
    echo 1;
    
    

?>