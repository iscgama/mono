<?php

    //Esta función permite que podamos aplicar mayoreo a una venta al tener capturado 
    //el precio de mayoreo y este sea mayor a 0
    function validar_precio($articulo, $cantidad, $con) {
        $mensajes = '';
        $precionuevo = 0;

        $sql = "SELECT precio_a, may1_a, cant1_a, may2_a, cant2_a FROM articulos WHERE id_a = " . $articulo;
        $res = $con->query($sql);
        $res->execute();

        $may1_a = 0;
        $cant1_a = 0;
        $may2_a = 0;
        $cant2_a = 0;

        foreach ($res as $a) {
            $may1_a = $a['may1_a'];
            $cant1_a = $a['cant1_a'];
            $may2_a = $a['may2_a'];
            $cant2_a = $a['cant2_a'];
            $precio_a = $a['precio_a'];
        }

       
        //Si hay precio de mayoreo y cantidad definidos podemos hacer precios de mayoreo
        if ($may1_a != 0 && $cant1_a != 0) {
            if ($cantidad >= $cant1_a) {
                $precionuevo = $may1_a;
            }else {
                $mensajes = 'Por ' . ($cant1_a - $cantidad) . ' unidades más el precio baja a $' . $may1_a;
            }

        }
        
        if ($may2_a != 0 && $cant2_a != 0 && $cantidad >= $cant1_a) {
            if ($cantidad >= $cant2_a) {
                $precionuevo = $may2_a;
            }else {
                $mensajes = 'Por ' . ($cant2_a - $cantidad) . ' unidades más el precio baja a $' . $may2_a;
            }
        }

        if ($precionuevo == 0) {
            $precionuevo = $precio_a;
        }

        $datos = array (
            'precio' => $precionuevo,
            'mensaje' => $mensajes
        );


        return $datos;
    }

    //Verifica el cliente y de acuerdo a su lista de precios se le hace descuento
    //al cliente
    function precios_cliente($cliente, $articulo, $con) {
        //Obtenemos el precio otorgado al cliente
        $sql = "SELECT lprecio_ct FROM clientes WHERE id_ct = '" . $cliente . "'";
        $res = $con->query($sql);
        $res->execute();

        $precio = 0;

        foreach ($res as $a) {
            $precio = $a['lprecio_ct'];
        }

        if ($precio == 1) {
            $precio = 0;
            $mensajes = '';
        }else {
            $lprecio = $precio;
            $precio--;
            
            $precio = 'may' . $precio . '_a';

            $sql = "SELECT precio_a, " . $precio  . " FROM articulos WHERE id_a = " . $articulo;
            $res = $con->query($sql);
            $res->execute();

            foreach ($res as $a) {
                $precio = $a[$precio];
                $precio_a = $a['precio_a'];
            }

            if ($precio == 0) {
                $precio = $precio_a;
            }

            
            $mensajes = "Se aplico la lista de precios: " . $lprecio;

        }
        
        $datos = array (
            'precio' => $precio,
            'mensaje' => $mensajes
        );

        return $datos;
    }

?>