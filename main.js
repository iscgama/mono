/* Bloque de funciones generales  */

const mostrar_error = ( mensaje ) => {
    $('#error').html('<i class="fas fa-exclamation-triangle"></i> ' +  mensaje );
    $('#error').slideDown('slow');
    setTimeout(( ) => {
        $('#error').slideUp('slow');
    }, 3500);
}


const cancelar_venta = ( id ) => {
    let sucursal = localStorage.getItem('sucursal');
    $.ajax({
        type: 'POST',
        url: 'php/cancelando.php',
        data: 'id=' + id + '&sucursal=' + sucursal,
        success:( res ) =>  {
            if (res == 1) {
                localStorage.setItem("valor", 7);
                validar();
                $('#contenido').load('php/ventas.php');
                mensajes('La venta ha sido cancelada');
            }
        }
    });
}

const mensajes = ( sms ) => {
	$('#mensaje').html(sms);
	$('#ventana').modal('toggle');
}


const fecha_actual = ( ) => {
	let now = new Date();

    let day = ("0" + now.getDate()).slice(-2);
    let month = ("0" + (now.getMonth() + 1)).slice(-2);

    let today = now.getFullYear()+"-"+(month)+"-"+(day);

    return today;
}


const validar = ( ) => {
    let valor = localStorage.getItem("valor");
    $('.nav-item').removeClass('active');
    $('.nav-link').removeClass('active');
    valor = parseInt(valor);
	switch(valor) {
        case 0:
			$('#mvender').addClass('active');
            break;
		case 1:
			$('#mcatalogos').addClass('active');
			break;
		case 2:
			$('#minventario').addClass('active');
			break;
		case 3:
			$('#mseguridad').addClass('active'); 
			break;
        case 4:
            $('#mresumen').addClass('active');
            break;
        case 5:
            $('#madmon').addClass('active');
            break;
        case 6:
            $('#mstore').addClass('active');
            break;
        case 7:
            $('#mventas').addClass('active');
            break;
        case 8:
            $('#mcontab').addClass('active');
            break;
        case 9:
            $('#mcomprasuc').addClass('active');
            break;
	}
}

const focus_Next = ( event, Next ) => {
    if ( event.keyCode == 13 ) {
        $('#' + Next).focus( );
    }
}

const cargar_menu = ( ) => {
    let usuario = localStorage.getItem('usuario');
    let tipo = localStorage.getItem('tipo');
    let sucursal = localStorage.getItem('sucursal');
    usuario = usuario.toLowerCase();
    document.title = "SoftPoint v 1.2 - " + ' User: ' + usuario;

    
    if (usuario != '') {
        $.ajax({
            type: 'POST',
            url: 'views/menu.php',
            data: 'usuario=' + usuario + '&tipo=' + tipo
                  + '&sucursal=' + sucursal,
            success:( res ) => {
                $('#barra').html(res);
                $('#mvender').addClass('active');
            }
        });
    }else {
        $('#logo').load('views/logo.html');
        $('#contenido').load('views/login.html');
    }
}

/* Fin bloque funciones generales */

const login_key = ( { keyCode } ) => {
    if ( keyCode == 13) {
        verificar( );
    }
}

/* Bloque de funciones login */
const verificar = (  ) => { 
    let usuario = $('#usuario').val();
    let password = $('#password').val();


    if (usuario != '' && password != '') {
        $.ajax({
            type: 'POST',
            url: 'php/login.php',
            data: 'usuario=' + usuario + '&password=' + password,
            dataType: 'json',
            success:  ( res ) => {
                if (res.estado === 'ok') {
                    let tipo = res.tipo;
                    let sucursal = res.sucursal;
                    let idu = res.idu;
                    localStorage.setItem('tipo', tipo);
                    localStorage.setItem('sucursal', sucursal);
                    localStorage.setItem('usuario', usuario);
                    localStorage.setItem('idu', idu);
                    cargar_menu( );
                    localStorage.setItem("valor", 0);
                    $.post("views/vender.php",{ usuario: localStorage.getItem('usuario') }, 
                    ( data ) => {
                        $('#contenido').html(data);
                    });
                }else {
                    mensajes('Error al iniciar sesion');
                }
            }
        });
    }else {
        mensajes('Debes introducir el nombre de usuario y contraseña para continuar');
        }
}

const userMinus = ( ) => {
    let usuario = $('#usuario').val();
	$('#usuario').val(usuario.toLowerCase());
}
/* Fin de bloque de funciones login */

/* Bloque de funciones para venta */

const inicializar_vta = ( ) => {
    $("#codigov").attr("autocomplete","off");
    $('#clientev').val('Cliente de Mostrador');
    $('#codigov').focus();

    let idu = localStorage.getItem('idu');
    let sucursal = localStorage.getItem('sucursal');

    $.ajax({
        type: 'POST',
        url: 'php/consecvta.php',
        data: 'idu=' + idu + '&sucursal=' + sucursal,
        success:( res ) => {
            localStorage.setItem('venta', res);
            detalle_vta();
        }
    });
}


const producto_listar = ( codigo ) => {
    //let ventana = localStorage.getItem('ventana');
    // if (ventana == 1) {
    //     $('#ventana').modal('toggle');
    //     localStorage.removeItem('ventana');
    // }

    $('#listabusq').html('');
    let cliente = $('#clientev').val();
    //Este evento se relaciona a la lectura del codigo de barras y el enter que da despues
    //De la lectura
    //var codigo = $(this).val();
    $('#codigov').val('');
    $('#descripv').html('Producto');
    //$(this).focus();
    //Esta búsqueda se encarga de verificar el código de barras en la tabla
    //de articulos y después en la tabla de códigos en caso de no encontrar nada
    //nos devuelve error al verificar que exista el producto
    $.ajax({
        type: 'POST',
        url: 'php/queryprod.php',
        data: 'codigo=' + codigo,
        dataType: 'json',
        success:( res ) => {
            
            if (res.estado == 'ok') {
                //Al devolver todos los datos insertarmos el renglon en la
                //tabla de ventas de la venta actual
                let venta = localStorage.getItem('venta');
                //Esta variable nos da la venta actual
                let idu = localStorage.getItem('idu');
                //Obtenemos el login actual
                let sucursal = localStorage.getItem('sucursal');
                //Obtenemos la sucursal para registrar la venta
                
                $.ajax({
                    type: 'POST',
                    url: 'php/agregar_reng_vta.php',
                    data: 'ida=' + res.ida + '&precio=' + res.precio 
                            + '&venta=' + venta + '&idu=' + idu
                            + '&sucursal=' + sucursal + '&cliente=' + cliente,
                    success: ( res ) => {
                        $('#escritos').html(res);
                        detalle_vta();
                        $('#codigov').focus();
                        $('#ventana').modal('hide');
                    }
                })
            }else {
                $('#escritos').html('El producto no existe');
            }
        }
    });
}
 
const buscar_producto = ( control ) => {
    let articulo = $('#' + control).val();
    if (articulo != '') {
        $.ajax({
            type: 'POST',
            url: 'php/queryprod.php',
            data: 'codigo=' + articulo,
            dataType: 'json',
            success: ( res ) => {
                if (res == 'error') {
                    mensajes('No se encontro el producto seleccionado, registrelo antes de continuar');
                    $('#' + control).val('');
                    $('#' + control).focus();
                }else {
                    $('#descripv').html(res.desc);
                    $('#' + control).select();
                    $('#' + control).focus();
                }
            }
        });
    }else {
        mensajes('Debes indicar el codigo de barras de tu producto antes de continuar');
    }
}


const buscar_producto_2 = ( articulo ) => {
    // let articulo = $('#articulo').val();
    if (articulo != '') {
        $.ajax({
            type: 'POST',
            url: 'php/queryprod.php',
            data: 'codigo=' + articulo,
            dataType: 'json',
            success: ( res ) => {
                if (res == 'error') {
                    mensajes('No se encontro el producto seleccionado, registrelo antes de continuar');
                    $('#articulo').val('');
                    $('#articulo').focus();
                }else {
                    $('#articulo').val(res.cod);
                    $('#descrip').html(res.desc);
                    $('#price').val(res.costo);
                    $('#count').val('1');
                    $('#count').select();
                    $('#count').focus();
                }
            }
        });
    }else {
        mensajes('Debes indicar el codigo de barras de tu producto antes de continuar');
    }
}

const seleccionar_cod = ( id, control ) => {
    $('#ventana').modal('hide');
    $('#' + control).val(id);
    let pantalla = localStorage.getItem('pantalla');
    if (pantalla == 'ventas') {
        buscar_producto( control );
    }else {
        buscar_producto_2( id );
    }
}
/*
    Función para eliminar completamente el renglón de venta o cancelarlo
*/

const eliminar_ren_v = ( id ) => {
    let idu = localStorage.getItem('idu');
    let numvta = localStorage.getItem('venta');
   $.ajax({
       type: 'POST',
       url: 'php/del_reng_vta.php',
       data: 'id=' + id + '&idu=' + idu + '&venta=' + numvta,
       success: ( res ) => {
           if (res == 1) {
               detalle_vta();
           }else {
               mensajes(res);
           }
       }
   }); 
}
/*
    Esta función permite cambiar la cantidad de un renglón en el punto de
    venta, aumentando o disminuyendo de acuerdo al boton presionado
    también por medio del renglon seleccionado
*/

const cambiar_cantidad = ( id, modo ) => {
    let venta = localStorage.getItem('venta');
    let cliente = $('#clientev').val();
    $.ajax({
        type: 'POST',
        url: 'php/cantventa.php',
        data: 'renglon=' + id + '&modo=' + modo
                + '&venta=' + venta + '&cliente=' + cliente,
        success: ( res ) => {
            $('#escritos').html(res);
            detalle_vta();
        }
    });
}


/*

    Funcion que se ocupa de mostrar el detalle de la venta actual,
    sacar la cantidad de piezas que se venden, así como el total
    de la venta actual

*/
const detalle_vta = ( ) => {
    let numvta = localStorage.getItem('venta');
    $.ajax({
        type: 'POST',
        url: 'php/detallevta.php',
        data: 'venta=' + numvta,
        dataType: 'json',
        success: ( res ) => {
            $('#prodlist').html(res.detalle);
            $('#unidades').val(res.unidades);
            $('#totalv').val(res.total);
            $('.tablas').DataTable({"paging": false});
            if (screen.height > 768) {
                $('#prodlist').attr('height', 450);
            }
        }
    });
}


const cantidades_venta_granel = ( id ) => {
    $.ajax({
        type: 'POST',
        url: 'views/componentesvta/cantventareng.php',
        data: '&id=' + id,
        success:( res ) => {
            $('#mensaje').html(res);
            $('#ventana').modal('toggle');
        }
    })
}

const cobrar_boton = (  ) => {
    let venta = localStorage.getItem('venta');
    $.ajax({
        type: 'POST',
        url: 'views/componentesvta/cobro.php',
        data: 'venta=' + venta,
        success: ( res ) => {
            $('#mensaje').html(res);
            $('#ventana').modal('toggle');
        }
    });
}

const opciones_boton = ( ) => {
    $('#mensaje').load( 'views/opciones.html' );
    $('#ventana').modal('toggle');
}

const verifica_cliente = ( ) => {
    if ($('#clientev').val() == '') {
        $('#clientev').val('Cliente de Mostrador');
    }
}

const valida_cliente = ( ) => {
    $('#clientev').val('');
}


const muestra_lista_prods = ( ) => {
    let valor = $('#codigov').val();
    let sucursal = localStorage.getItem('sucursal');
    localStorage.setItem('ventana', 1);
    $.ajax({
        type: 'POST',
        url: 'php/searchprodv.php',
        data: 'codigo=' + valor + '&sucursal=' + sucursal,
        success:( res )  => {

            $('#mensaje').html(res);
            $('#ventana').modal('toggle');
        }
    });
}

const introducir_codigo = ( { keyCode } ) => {
    let venta = localStorage.getItem('venta');
        if (keyCode == 13) {
            producto_listar($('#codigov').val());
        }
        /*
            Este código permite aumentar la cantidad de producto del último renglón
        */
        if (keyCode == 43) {
            let modo = 1;
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'php/cantultima.php',
                data: 'modo=' + modo + '&venta=' + venta,
                success: ( ) => {
                    detalle_vta();
                }
            });
        }

         /*
            Este código permite disminuir la cantidad de producto del último renglón
        */
            if (keyCode == 45) {
                let modo = 0;
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'php/cantultima.php',
                    data: 'modo=' + modo + '&venta=' + venta,
                    success:function(e) {
                        detalle_vta();
                    }
                });
            }

        // Este código te permite borrar el último renglón
        if ( keyCode == 46 ) {
            let venta = localStorage.getItem('venta');
            $.ajax({
                type: 'POST',
                url: 'php/quitar_ultimo_vta.php',
                data: 'venta=' + venta,
                success: ( res ) => {
                    if (res == 1) {
                        detalle_vta();
                    }
                }
            });
        }


        // Este codigo busca un producto cuando se presiona una tecla abajo para buscar producto
        if ( keyCode == 40 ) {
            muestra_lista_prods();
        }
}

/* Fin de bloque de funciones para venta */

/* Bloque de funciones de usuarios */

//Funcion para cambiar permisos de ventas de un usuario
const permisos_user = ( id ) => {
    $.ajax({
        type: 'POST',
        url: 'views/permisos.php',
        data: 'usuario=' + id,
        success: ( res ) => {
            $('#mensaje').html(res);
	        $('#ventana').modal('toggle');
        }
    });
}

const editar_user = ( id ) => {
    $.ajax({
        type: 'POST',
        url: 'php/edituser.php',
        data: 'id=' + id,
        success: ( res ) => {
            $('#mensaje').html(res);
	        $('#ventana').modal('toggle');
        }
    });
}


const eliminar_user = ( id ) => {
    $.ajax({
        type: 'POST',
        url: 'php/deluser.php',
        data: 'id=' + id,
        success: ( res ) => {
            if (res != 0) {
                mensajes("El elemento se ha dado de baja correctamente");
                $('#contenido').load('views/usuarios.html');
            }
        }
    });
}


const inicializar_user = ( ) => {
    $('#listusers').html('<div class="spinner-grow text-primary" role="status"><span class="sr-only">Loading...</span></div>');
    $('#listusers').load( 'php/users.php' );
}

const nuevo_usuario = ( ) => {
    $('#mensaje').load('views/newuser.php');
    $('#ventana').modal('toggle');
}
/* Fin bloque de funciones de usuarios */


/* Bloque de funciones de abonos */
// function imprimir_abono(id) {
//     var printdata = "id=" + id;
//     $.get('tickets/ticketabono.php', printdata, function(){
//             window.open("tickets/ticketabono.php?id=" + id); 
//       });
// }

const imprimir_formato = ( id, formato ) => {
    let printdata = "id=" + id;
    $.get('tickets/ticket' + formato + '.php', printdata, ( ) => {
        window.open("tickets/ticket" + formato + ".php?id=" + id); 
  });
}


const aplicar_abono = ( ) => {
    let formapago = $('#formapago').val();
    let monto = $('#monto').val();
    let adeudo = localStorage.getItem('montoabono');
    let id = localStorage.getItem('cobranzaid');
    let idu = localStorage.getItem('idu');
    let cliente = $('#cobcte').val();

    if (monto != '') {
        if ( monto >= adeudo ) {
            $.ajax({
                type: 'POST',
                url: 'php/aplicarabono.php',
                data: 'forma=' + formapago 
                        + '&monto=' + monto + '&adeudo=' + adeudo  
                        + '&id=' + id + '&cliente=' + cliente + '&idu=' + idu,
                success:( res ) => {
                        imprimir_formato(res, 'abono');
                        $('#contenido').load('views/cobranza.php');
                        $('#ventana').modal('toggle');
                }
            });
        }else {
            mostrar_error('El pago no puede ser mayor a lo adeudado');    
        }
    }else {
        mostrar_error('Debes introducir un monto valido');
    }
}
/* Bloque de funciones de abonos */

/* Bloque de funciones de productos */
const eliminar_prod = ( id ) => {
    $.ajax({
        type: 'POST',
        url: 'php/delprod.php',
        data: 'id=' + id,
        success: ( res ) => {
            if (res != 0) {
                mensajes("El elemento se ha dado de baja correctamente");
                $('#contenido').load('views/productos.html');
            }
        }
    });
}

const editar_prod = ( id ) => {
    localStorage.setItem('codprod', id);
    // $('#mensaje').load('views/newprod.php');
    // $('#ventana').modal('toggle');
    $('#contenido').html('<div class="spinner-grow text-primary" role="status"><span class="sr-only">Loading...</span></div>');
    $.ajax({
        type: 'POST',
        url: 'views/newprod.php',
        success:(res) => {
            $('#contenido').html(res);
        }
    });
}

const agregar_codigo = ( id ) => {
    $.ajax({
        type: 'POST',
        url: 'php/codigos.php',
        data: 'id=' + id,
        success: ( res ) => {
            $('#contenido').html(res);
        }
    });
}

const nuevo_producto = ( ) => {
    localStorage.setItem('codprod', '');
    $('#contenido').html('<div class="spinner-grow text-primary" role="status"><span class="sr-only">Loading...</span></div>');
    $('#contenido').load('views/newprod.php');
}

const registrar_producto = ( ) => {
    let clasif = $('#clasif').val();
    let marca = $('#marca').val();
    let codigo = $('#codigo').val();
    // cva = cva.toUpperCase();
    let desc = $('#desc').val();
    desc = desc.toUpperCase();
    let costo = $('#costo').val();
    let precio = $('#precio').val();
    let existencia = $('#existencia').val();
    let may1 = $('#may1').val();
    let cant1 = $('#cant1').val();
    let may2 = $('#may2').val();
    let cant2 = $('#cant2').val();
    let may3 = $('#may3').val();
    let cant3 = $('#cant3').val();
    let smin = $('#smin').val();
    let smax = $('#smax').val();
    let granel = ($('#granel').is(':checked') ? 1 : 0);
    let inventario = ($('#inventario').is(':checked') ? 1 : 0);
    let favorito = ($('#favorito').is(':checked') ? 1 : 0);
    let idu = localStorage.getItem('idu');
    desc = desc.toUpperCase();
    let operacion = localStorage.getItem('operacion');
    let var1 = localStorage.getItem('var1');

    let nclasif = $('#newclasif').val();
    let nmarca = $('#newmarca').val();

    

    if (codigo != '' && desc != '' && precio != '') {
        $.ajax({
            type: 'POST',
            url: 'php/newprod.php',
            data: 'operacion=' + operacion + '&idu=' + idu + '&codigo=' + codigo 
            + '&desc=' + desc + '&costo=' + costo + '&precio=' + precio + '&existencia='
            + existencia + '&clasif=' + clasif + '&marca=' + marca + '&may1=' + may1 
            + '&cant1=' + cant1 + '&may2=' + may2 + '&cant2=' + cant2 
            + '&may3=' + may3 + '&cant3=' + cant3 + '&smin=' + smin + '&smax=' + smax
            + '&granel=' + granel + '&inventario=' + inventario + '&ida=' + var1
            + '&nclasif=' + nclasif + '&nmarca=' + nmarca + '&favorito=' + favorito,
            success:( res ) => {
                if (res != 0) {
                    localStorage.setItem('codprod', '');
                    // $('#mensaje').load('views/newprod.php');
                    // $('#ventana').modal('toggle');
                    $('#contenido').html('<div class="spinner-grow text-primary" role="status"><span class="sr-only">Loading...</span></div>');
                    $.ajax({
                        url: 'views/newprod.php',
                        success: ( res ) => {
                            $('#contenido').html( res );
                            mostrar_error('Producto registrado con éxito: ' + desc);
                            localStorage.setItem('operacion', 0);
                            localStorage.setItem('var1', 0);
                        }
                    })
                    
                    
                }else {
                    mostrar_error(res);
                }
            }
        });
    }else {
        mostrar_error('Debes llenar los siguientes campos para continuar: código, descripción y precio de venta');
    }
}


const buscar_producto_registro = ( ) => {
    // let var1 = 0;
    let codigo = $('#codigo').val();
    if (codigo != '') {
        $('#desc').focus();
        $.ajax({
            type: 'POST',
            url: 'php/queryprod.php', 
            data: 'codigo=' + codigo,
            dataType: 'json',
            success: ( res ) => {
                if (res.estado === 'ok') {
                    localStorage.setItem('operacion', 1);
                    localStorage.setItem('var1', res.ida);
                    $('#codigo').val(res.cod);
                    // $('#cva').val(res.cva);
                    $('#desc').val(res.desc);
                    $('#costo').val(res.costo);
                    $('#precio').val(res.precio);
                    $('#existencia').val(res.existencia);
                    $('#clasif').val(res.clasif);
                    $('#marca').val(res.marca);
                    $('#may1').val(res.may1);
                    $('#cant1').val(res.cant1);
                    $('#may2').val(res.may2);
                    $('#cant2').val(res.cant2);
                    $('#may3').val(res.may3);
                    $('#cant3').val(res.cant3);
                    $('#smin').val(res.smin);
                    $('#smax').val(res.smax);
                    $("#granel").prop("checked", res.granel);
                    $('#inventario').val(res.inventario);
                    $("#favorito").prop("checked", res.favorito);
                }else {
                    localStorage.setItem('var1', 0);
                    localStorage.setItem('operacion', 0);
                    // $('#cva').val('');
                    $('#desc').val('');
                    $('#costo').val('0');
                    $('#precio').val('0');
                    $('#existencia').val('0');
                    // $('#clasif').val('');
                    // $('#marca').val();
                    $('#may1').val('0');
                    $('#cant1').val('0');
                    $('#may2').val('0');
                    $('#cant2').val('0');
                    $('#may3').val('0');
                    $('#cant3').val('0');
                    $('#smin').val('0');
                    $('#smax').val('0');
                    $('#granel').val('');
                    $('#inventario').val('');
                }
            }
        });
    }else {
        mostrar_error('Debes introducir un codigo de barras válido');
        $('#codigo').focus();
    }
    $('#desc').focus( );
}

const busqueda_prods = ( { keyCode } ) => {
    if (keyCode == 13) {
        buscar_producto_registro( );
    }
}
/* Fin Bloque de funciones de productos */

/* Bloque de funciones de cobro */
const finalizar_venta = ( )  => {
    let monto = $('#montov').val();
    let forma = $('#forma').val();
    let pago = $('#pagov').val();
    let cambio = $('#cambiov').val();
    let venta = localStorage.getItem('venta');
    let sucursal = localStorage.getItem('sucursal');
    let idu = localStorage.getItem('idu');
    let cliente = $('#clientev').val();
    //-------------------------------------------------------------
    //Este bloque sirve para pagar unicamente en efectivo o tarjeta
    //-------------------------------------------------------------
    if (forma == 'Efectivo' || forma == 'Tarjeta') {
        if (cambio >= 0) {
            $.ajax({
                type: 'POST',
                url: 'php/finalizar_vta.php',
                data: 'forma=' + forma + '&cambio=' + cambio 
                        + '&pago=' + pago + '&venta=' + venta 
                        + '&sucursal=' + sucursal + '&idu=' + idu + '&cliente=' + cliente,
                success: (res) => {
                    if (res == 1) {
                        imprimir_formato( venta , '');
                        $.post("views/vender.php",{ usuario: localStorage.getItem('usuario') }, 
                            function(data) {
                                $('#contenido').html(data);
                        });
                        $('#ventana').modal('toggle');
                    }else {
                        mostrar_error(res);
                    }
                    //$('#mensaje').html('Se ha fianlizado con éxito');
                }
            });
        }else {
            mostrar_error('Indique una cantidad suficiente para pagar');
            $('#pagov').select();
            $('#pagov').focus();
        }
    }else {
        //-------------------------------------------------------------
        //Este bloque sirve para pagar a crédito
        //-------------------------------------------------------------
        if (cliente != "Cliente de Mostrador") {
               if (monto > pago) {
                   $.ajax({
                       type: 'POST',
                       url: 'php/finalizar_vta.php',
                       data: 'forma=' + forma + '&cambio=' + cambio + '&pago=' + pago
                             + ' &venta=' + venta + '&sucursal=' + sucursal + '&idu=' + idu
                             + '&cliente=' + cliente,
                        success:( res ) => {
                            if (res == 1) {
                                imprimir_formato( venta , '');
                                $('#contenido').load('views/vender.php');
                                $('#ventana').modal('toggle');
                            }else {
                                mostrar_error(res);
                            }
                            
                        }
                   });
               }else {
                   mostrar_error('No hay cantidad para pagar a crédito');
               }            
        }else {
            mostrar_error('Debe seleccionar un cliente para vender a crédito');
        }
    }
}



const calcular_pago_vta = ( ) => {
    let pago_vta = $('#pagov').val();
    if (pago_vta != '' && !isNaN(pago_vta)) {
        let monto = $('#montov').val();
        let result = parseFloat(pago_vta) - parseFloat(monto);
        $('#cambiov').val(result);
    }
}


const cobrar_enter = ( e ) => {
    if (e.keyCode == 13) {
        e.preventDefault();
        finalizar_venta();
    }
}

const forma_credito = ( ) => {
    let forma = $('#forma').val();
    if (forma == 'Credito') {
        $('#pagov').val('0');
        calcular_pago_vta();
    }
}
/* Fin de bloque de funciones de cobro */

/* Bloque de funciones de compras */
const eliminar_compra = ( id ) => {
    let sucursal = localStorage.getItem('sucursal');
    let idu = localStorage.getItem('idu');
    $.ajax({
        type: 'POST',
        url: 'php/eliminarcompra.php',
        data: 'id=' + id + '&sucursal=' + sucursal + '&idu=' + idu,
        success: ( res ) => {
            if (res == 1) {
                mensajes('El movimiento fue cancelado y el inventario ha cambiado');
                $('#contenido').load('views/compras.html');
            }else {
                mensajes(res);
            }
        }
    });
}

const finalizar_compra = ( id ) => {
    var sucursal = localStorage.getItem('sucursal');
    var usuario = localStorage.getItem('idu');
    $.ajax({
        type: 'POST',
        url: 'php/finalizarcompra.php',
        data: 'id=' + id + '&sucursal=' + sucursal
                + '&usuario=' + usuario,
        success: ( res ) => {
            if (res == 1) {
                mensajes('Compra realizada con éxito');
                imprimir_formato( id, 'compra' );
                $('#contenido').load('views/compras.html');
            }else {
                mostrar_error(res);
            }
        }
    });
}

const nueva_compra = ( ) => {
    $('#contenido').load('views/newcompra.php');
}


const eliminar_reng_com = ( id ) => {
    $.ajax({
        type: 'POST',
        url: 'php/eliminar_reng_com.php',
        data: 'id=' + id,
        success: ( res ) => {
            if (res != 0) {
                detalle_compra();
            }
        }
    })
}

const agregar_renglon = ( ) => {
    let code = $('#articulo').val();
    let count = $('#count').val();
    let price = $('#price').val();
    let numcompra = $('#compra').val();
    let idu = localStorage.getItem('idu');
    //let sucursal = $('#sucursales').val();
    let prov = $('#proveedores').val();
    $('#proveedores').attr("disabled", "true");

    if (code != '' && !isNaN(count) && !isNaN(price)) {
        $.ajax({
            type: 'POST',
            url: 'php/agrega_reng_comp.php',
            data: 'code=' + code + '&count=' + count + '&price=' + price
                    + '&compra=' + numcompra + '&idu=' + idu  + '&prov=' + prov,
            success: function(res) {
                if (res == 0) {
                    detalle_compra();

                }else {
                    mensajes(res);
                }
            }
        })
    }else {
        mensajes('Datos no válidos, debes introducir el código del producto, cantidad y precio');
    }
}


const cambiarcant = (id, valor) => {
    localStorage.setItem('cantidad', valor);
    localStorage.setItem('renglon', id);
    $('#mensaje').load('views/cambiar_cantidades.html');
    $('#ventana').modal('toggle');
}

const cambiarprecio = (id, valor) => {
    localStorage.setItem('precio', valor);
    localStorage.setItem('renglon', id);
    $('#mensaje').load('views/cambiar_precios.html');
    $('#ventana').modal('toggle');
}




const obtener_consec_compra = () => {
    $.ajax({
        type: 'POST',
        url: 'php/obtener_consec.php',
        success:(res) => {
            $('#compra').val(res);
            localStorage.setItem('numcompra', res);
            detalle_compra( );
        }
    });

    // $('#articulo').focus();
}


const detalle_compra = ( ) => {
    let num = $('#compra').val();
    $.ajax({
        type: 'POST',
        url: 'php/detallecompra.php',
        data: 'num=' + num,
        success: (res) => {
            $('#descrip').html('Descripción');
            $('#articulo').val('');
            $('#count').val('');
            $('#price').val('');
            $('#detallecompra').html(res);
            $('#articulo').focus();
        }
    });
}

const pasar_cantidad = ( e ) => {
    let articulo = $('#articulo').val();
    if ( e.keyCode == 13 &&  articulo != '') {
        if ($('#count').val() != '') {
            e.preventDefault();
            agregar_renglon_compra();
            $('#ttcompra').removeAttr("disabled");
        }else {
            mensajes('Debes colocar una cantidad valida');
        }
    }
}

/* Fin de bloque de funciones de compras */

/* Bloque de funciones de clasifica */
const eliminar_clasifica = ( id ) => {
    $.ajax({
        type: 'POST',
        url: 'php/delclasifica.php',
        data: 'id=' + id,
        success: ( res ) => {
            if (res != 0) {
                mensajes("El elemento se ha dado de baja correctamente");
                $('#contenido').load('views/clasificaciones.html');
            }
        }
    });
}

const editar_clasif = ( id ) => {
    $.ajax({
        type: 'POST',
        url: 'php/modclasif.php',
        data: 'id=' + id,
        success:( res ) => {
            $('#mensaje').html(res);
            $('#ventana').modal('toggle');
        }
    });
}

const botono_nueva_clasificacion = ( ) => {
    $('#mensaje').load('views/newclasifica.html');
	$('#ventana').modal('toggle');
}
/* Fin de bloque de funciones de clasifica */

/* Bloque de funciones de cajeros */
const eliminar_cajero = ( id ) => {
    $.ajax({
        type: 'POST',
        url: 'php/delcajeros.php',
        data: 'id=' + id,
        success: ( res ) => {
            if (res != 0) {
                mensajes("El elemento se ha dado de baja correctamente");
                $('#contenido').load('views/cajeros.html');
            }
        }
    });
}

const editar_cj = ( id ) => {
    $.ajax({
        type: 'POST',
        url: 'views/newcajero.php',
        data: 'id=' + id,
        success:( res ) => {
            $('#mensaje').html(res);
            $('#ventana').modal('toggle');
        }
    });
}

const boton_nuevocajero = ( ) => {
    $('#mensaje').load('views/newcajero.php');
	$('#ventana').modal('toggle');
}

/* Fin de bloque de funciones de cajeros */

/* Bloque de funciones de contable */
const mostrar_lista = ( ) => {
    $.ajax({
        type: 'POST',
        url: 'php/listadocaja.php',
        success: ( res ) => {
            $('#listacaja').html(res);
        }
    })
}


const cancelar_movimiento =( id ) => {
    $.ajax({
        type: 'POST',
        url: 'php/eliminar_mov.php',
        data: 'id=' + id,
        success: ( ) => {
            mensajes('Se dio de baja correctamente el movimiento');
            mostrar_lista();
        }
    })
}

const boton_nuevoingreso = ( ) => {
    $('#mensaje').load('views/registro_ingreso.html');
    $('#ventana').modal('toggle');
}

const boton_nuevoegreso = ( ) => {
    $('#mensaje').load('views/registro_egreso.html');
    $('#ventana').modal('toggle');
}
/* Fin de bloque de funciones de contable */

/* Bloque de funciones de contable */
const guardar_egresos = ( tipo ) => {
    
    let fecha = $('#fecha').val();
    let concepto = $('#concepto').val();
    let monto = $('#monto').val();


    if (concepto != '' && monto != '') {
        $.ajax({
            type: 'POST',
            url: 'php/registro.php',
            data: 'usuario=' + id + '&fecha=' + fecha + '&concepto=' 
                        + concepto + '&monto=' + monto + '&tipo=' + tipo
                        + '&concepto=' + concepto,
            success:( res ) => {
                $('#mensaje').html(res);
                $('#contenido').load('views/egresos.html');
            }
        })
    }else {
        mostrar_error('Debes introducir el concepto y el monto');
    }
}





const guardar_movimiento = ( tipo ) => {
    let concepto = $('#concepto').val();
    let monto = $('#monto').val();
    let fecha = $('#fecha').val();
    $.ajax({
        type: 'POST',
        url: 'php/guardar_movimiento.php',
        data: 'concepto=' + concepto + '&monto=' + monto 
                + '&fecha=' + fecha + '&tipo=' + tipo,
        success: function(res) {
            if (res == 1) {
                $('#mensaje').html('Se ha registrado con éxito');
                $('#contenido').load('views/contable.html');
            }else {
                mostrar_error(res);
            }
        }
    })
}
/* Fin de bloque de funciones de contable */

/* Bloque de funciones de entradas */

const eliminar_entrada =( id ) => {
    let sucursal = localStorage.getItem('sucursal');
    $.ajax({
        type: 'POST',
        url: 'php/eliminarentrada.php',
        data: 'id=' + id + '&sucursal=' + sucursal,
        success: ( res ) => {
            if (res == 1) {
                mensajes('El movimiento fue cancelado y el inventario ha cambiado');
                $('#contenido').load('views/entradas.html');
            }else {
                mensajes(res);
            }
        }
    });
}


const finalizar_entrada = ( id ) => {
    let sucursal = localStorage.getItem('sucursal');
    $.ajax({
        type: 'POST',
        url: 'php/finalizarentrada.php',
        data: 'id=' + id + '&sucursal=' + sucursal,
        success: ( res ) => {
            if (res == 1) {
                mensajes('Entrada realizada con éxito');
                imprimir_formato(id, 'entrada');
                $('#contenido').load('views/entradas.html');
            }else {
                mostrar_error(res);
            }
        }
    });
}

/* Fin de bloque de funciones de entradas */

/* Bloque de funciones de salidas */

const eliminar_salida =( id ) => {
    let sucursal = localStorage.getItem('sucursal');
    $.ajax({
        type: 'POST',
        url: 'php/eliminarsalida.php',
        data: 'id=' + id + '&sucursal=' + sucursal,
        success: ( res ) => {
            if (res == 1) {
                mensajes('El movimiento fue cancelado y el inventario ha cambiado');
                $('#contenido').load('views/salidas.html');
            }else {
                mensajes(res);
            }
        }
    });
}


const finalizar_salida = ( id ) => {
    let sucursal = localStorage.getItem('sucursal');
    $.ajax({
        type: 'POST',
        url: 'php/finalizarsalida.php',
        data: 'id=' + id + '&sucursal=' + sucursal,
        success: ( res ) => {
            if (res == 1) {
                mensajes('Entrada realizada con éxito');
                imprimir_formato(id, 'salida');
                $('#contenido').load('views/salidas.html');
            }else {
                mostrar_error(res);
            }
        }
    });
}
/* Fin de bloque de funciones de salidas */


/* Bloque de funciones de recibos */
const editar_recibo =( id ) => {
    $.ajax({
        type: 'POST',
        url: 'php/modrecibo.php',
        data: 'id=' + id,
        success: ( res ) => {
            $('#mensaje').html(res);
            $('#ventana').modal('toggle');
        }
    });
}



const eliminar_recibo = ( id ) => {
    $.ajax({
        type: 'POST',
        url: 'php/delrecibo.php',
        data: 'id=' + id,
        success: ( res ) => {
            if (res == 1) {
                mensajes('Se dio de baja el recibo con éxito');
                $('#contenido').load('php/recibos.php');
            }else {
                mensaje(res);
            }
        }
    });
}
 
const modificar_recibo = ( id ) => {
    let nombre = $('#nombre').val();
    let concepto = $('#concepto').val();
    let monto = $('#monto').val();
    $.ajax({
        type: 'POST',
        url: 'php/modificar_recibo.php',
        data: 'nombre=' + nombre + '&concepto=' + concepto
                + '&monto=' + monto + '&id=' + id,
        success: ( res ) => {
            if (res == 1) {
                imprimir_recibo(id);
                $('#mensaje').html('Se ha modificado con éxito');
                $('#contenido').load('php/recibos.php');
            }else {
                mostrar_error(res);
            }
        }
    })
}
/* Fin de bloque de funciones de recibos */

/* Bloque de funciones de reimprimir */
const reimprimir_ticket = ( ) => {
    let id = $('#ticketvta').val();
    imprimir_formato( id, '' );
    $('#ventana').modal('hide');
}
/* Fin de bloque de funciones de reimprimir */

/* Bloque de funciones de cobranza */
const abonar_cuenta = ( id, cliente, saldo ) => {
    localStorage.setItem('cobranzaid' , id);
    $.ajax({
        type: 'POST',
        url: 'php/abono.php',
        data: 'cliente=' + cliente + '&saldo=' + saldo,
        success: ( res ) => {
            $('#mensaje').html(res);
            $('#ventana').modal('toggle');
        }
    });
}

const realizar_consulta = ( ) => {
    let cliente = $('#cobcte').val();
    if (cliente != '') {
        $.ajax({
            type: 'POST',
            url: 'php/cobranzaquery.php',
            data: 'cliente=' + cliente,
            success:( res ) => {
                $('#listacobranza').html(res);
            }
        });
    }else {
        mostrar_error('Debes seleccionar un cliente para consultar sus datos');
    }
}


const realizar_consulta_global = ( ) => {
    let cliente = $('#cobcte').val();
    if (cliente != '') {
        $.ajax({
            type: 'POST',
            url: 'php/cobranzaqueryg.php',
            data: 'cliente=' + cliente,
            success:( res ) => {
                $('#listacobranza').html(res);
            }
        });
    }else {
        mostrar_error('Debes seleccionar un cliente para consultar sus datos');
    }
}
/* Fin de bloque de funciones de cobranza */

/* Bloque de funciones de marcas */
const eliminar_marca = ( id ) => {
    $.ajax({
        type: 'POST',
        url: 'php/delmarcas.php',
        data: 'id=' + id,
        success: ( res ) => {
            if (res != 0) {
                mensajes("El elemento se ha dado de baja correctamente");
                $('#contenido').load('views/marcas.html');
            }
        }
    });
}

const editar_marca = ( id ) => {
    $.ajax({
        type: 'POST',
        url: 'php/modmarca.php',
        data: 'id=' + id,
        success:( res ) => {
            $('#mensaje').html(res);
            $('#ventana').modal('toggle');
        }
    })
}
/* Fin de bloque de funciones de marcas */

/* Bloque de funciones de codigos */
const eliminar_codigo = ( id ) => {
    $.ajax({
        type: 'POST',
        url: 'php/delcodigo.php',
        data: 'id=' + id,
        success: ( res ) => {
            if (res != 0) {
                mensajes("El elemento se ha dado de baja correctamente");
                $('#contenido').load('views/productos.html');
            }
        }
    });
}


const save_code = ( ) => {
    let codigon = $('#codigon').val();
    let ida = $('#ida').html();
    let idu = localStorage.getItem('idu');
    if (codigon != '') {
        $.ajax({
            type: 'POST',
            url: 'php/regcodigo.php',
            data: 'codigo=' + codigon + '&idu=' + idu + '&ida=' + ida,
            success: function(res) {
                if (res == 1) {
                    mensajes('Se actualizo el código de barras nuevo');
                    $('#contenido').load('views/productos.html');
                }else {
                    mostrar_error(res);
                }
            }
        });
    }else {
        mostrar_error('Debes introducir un código para actualizar el anterior');
    }
}
/* Fin de bloque de funciones de codigos */


/* Bloque de funciones de sucursales */

const eliminar_suc = ( id ) => {
    $.ajax({
        type: 'POST',
        url: 'php/delsuc.php',
        data: 'id=' + id,
        success: ( res ) => {
            if (res != 0) {
                mensajes("El elemento se ha dado de baja correctamente");
                $('#contenido').load('views/sucursales.html');
            }
        }
    });
}

const editar_suc = ( id ) => {
    $.ajax({
        type: 'POST',
        url: 'views/modsuc.php',
        data: 'id=' + id,
        success:( res ) => {
            $('#mensaje').html(res);
            $('#ventana').modal('toggle');
        }
    });
}
/* Bloque de funciones de sucursales */

/* Bloque de funciones de clientes */
const eliminar_cte =( id ) => {
    $.ajax({
        type: 'POST',
        url: 'php/delcte.php',
        data: 'id=' + id,
        success: ( res ) => {
            if (res != 0) {
                mensajes("El elemento se ha dado de baja correctamente");
                $('#contenido').load('views/clientes.html');
            }
        }
    });
}

const editar_cte = ( id ) => {
    $.ajax({
        type: 'POST',
        url: 'views/newcte.php',
        data: 'id=' + id,
        success:( res ) => {
            $('#mensaje').html(res);
            $('#ventana').modal('toggle');
        }
    });
}
/* Bloque de funciones de clientes */


/* Bloque de funciones de transpasos */
const eliminar_traspaso = ( id ) => {
    $.ajax({
        type: 'POST',
        url: 'php/traspasos/eliminartraspaso.php',
        data: 'id=' + id,
        success: ( ) => {
            mensajes('Se ha eliminado el traspaso con éxito');
            $('#contenido').load('views/traspasos.html');
        }
    })
}

const editar_traspaso =( id ) => { 
    // let idu = localStorage.getItem('idu');
    // let sucursal = localStorage.getItem('sucursal');
    localStorage.setItem('numtras', id);
    $('#contenido').load('views/newtraspaso.php');
     
}

const aplicar_traspaso = ( id ) => {
    let idu = localStorage.getItem('idu');
    $.ajax({
        type: 'POST',
        url: 'php/traspasos/aplicartraspaso.php',
        data: 'id=' + id + '&idu=' + idu,
        success: ( res ) => {
            if (res == 1) {
                mensajes('Se ha aplicado con éxito el traspaso a la sucursal');
                $('#contenido').load('views/traspasos.html');
            }else {
                mensajes(res);
            }
        }
    });
}
/* Bloque de funciones de transpasos */

/* Bloque de funciones de roles */
const eliminar_rol =( id ) => {
    $.ajax({
        type: 'POST',
        url: 'php/delrol.php',
        data: 'id=' + id,
        success: ( res ) => {
            if (res != 0) {
                mensajes("El elemento se ha dado de baja correctamente");
                $('#contenido').load('views/roles.html');
            }
        }
    });
}
/* Bloque de funciones de roles */

/* Bloque de funciones de proveedores */
const eliminar_pr =( id ) => {
    $.ajax({
        type: 'POST',
        url: 'php/delpr.php',
        data: 'id=' + id,
        success: ( res ) => {
            if (res != 0) {
                mensajes("El elemento se ha dado de baja correctamente");
                $('#contenido').load('views/proveedores.html');
            }
        }
    });
}

const editar_pr =( id ) => {
    $.ajax({
        type: 'POST',
        url: 'views/newpr.php',
        data: 'id=' + id,
        success:( res ) => {
            $('#mensaje').html(res);
            $('#ventana').modal('toggle');
        }
    });
}
/* Bloque de funciones de proveedores */

/* Bloque de funciones de empresa */
const guardar_empresa = ( ) => {
    let nombre = $('#nombre').val();
    let dir = $('#dir').val();
    let tel = $('#tel').val();
    let codigo = $('#codigo').val();
    let ciudadr = $('#ciudadr').val();
    let estador = $('#estador').val();
    
    $.ajax({
        type: 'POST',
        url: 'php/regemp.php',
        data: 'nombre=' + nombre + '&dir=' + dir
            + '&tel=' + tel + '&codigo=' + codigo
            + '&ciudadr=' + ciudadr + '&estador=' + estador,
        success:( ) => {
            mensajes('Se ha guardado con éxito la información');
        }
    });
}
/* Bloque de funciones de empresa */

/* Bloque de funciones de reportes */
const reporte = ( ) => {
	var socio = $('#socio').val();
	if(socio == '') {
		mensajes('Debes seleccionar al menos un socio para generar su reporte');
	}else {
        $('#resultado').html('<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>');
		$.ajax({
            type: 'POST',
            url: 'php/ingvsegre.php',
            data: 'socio=' + socio,
            success: ( ) => {
                $('#resultado').html(res);
            }
        });
	}
}
/* Bloque de funciones de reportes */

/* Bloque de funciones de retirar dinero */

const retirar_dinero = ( ) => {
    let concepto = $('#concepto').val();
    let monto = $('#monto').val();
    let idu = localStorage.getItem('idu');
    let sucursal = localStorage.getItem('sucursal');

    if (concepto != '' && monto != '') {
        $.ajax({
            type: 'POST',
            url: 'php/retirar.php',
            data: 'concepto=' + concepto + '&monto=' + monto
                    + '&idu=' + idu 
                    + '&sucursal=' + sucursal + '&tipo=' + "E",
            success: ( res ) => {
                imprimir_formato(res, 'retiro');
                $('#mensaje').html('Se ha realizado con exito el retiro');
            }
        });
    }else {
        mostrar_error('Debes introducir el concepto y el monto del retiro antes de continuar');
    }
}
/* Bloque de funciones de retirar dinero */

/* Bloque de funciones de nuevo rol */
const save_rol = ( ) => {
    let desc = $('#desc').val();
    let productos = ($('#productos').is(':checked') ? 1 : 0);
    let clasif = ($('#clasif').is(':checked') ? 1 : 0);
    let marcas = ($('#marcas').is(':checked') ? 1 : 0);
    let clientes = ($('#clientes').is(':checked') ? 1 : 0);
    let pr = ($('#pr').is(':checked') ? 1 : 0);
    let sucursales = ($('#sucursales').is(':checked') ? 1 : 0);
    let cajas = ($('#cajas').is(':checked') ? 1 : 0);
    let entradas = ($('#entradas').is(':checked') ? 1 : 0);
    let salidas = ($('#salidas').is(':checked') ? 1 : 0);
    let compras = ($('#compras').is(':checked') ? 1 : 0);
    let pedidos = ($('#pedidos').is(':checked') ? 1 : 0);
    let traspasos = ($('#traspasos').is(':checked') ? 1 : 0);
    let usuarios = ($('#usuarios').is(':checked') ? 1 : 0);
    let roles = ($('#roles').is(':checked') ? 1 : 0);
    let cajeros = ($('#cajeros').is(':checked') ? 1 : 0);
    let permisos = ($('#permisos').is(':checked') ? 1 : 0);
    let datos = ($('#datos').is(':checked') ? 1 : 0);
    let cobranza = ($('#cobranza').is(':checked') ? 1 : 0);
    let vender = 1;
    let operacion = 0;
    
    if(desc != '') {
        $.ajax({
            type: 'POST',
            url: 'php/regrol.php',
            data: 'productos=' + productos + '&clasif=' + clasif + '&marcas=' + marcas
                    + '&clientes=' + clientes  + '&pr=' + pr + '&sucursales=' + sucursales
                    + '&cajas=' + cajas + '&entradas=' + entradas + '&salidas=' + salidas
                    + '&compras=' + compras + '&pedidos=' + pedidos + '&traspasos=' + traspasos
                    + '&usuarios=' + usuarios + '&roles=' + roles + '&cajeros=' + cajeros
                    + '&permisos=' + permisos + '&datos=' + datos + '&operacion=' + operacion
                    + '&desc=' + desc + '&cobranza=' + cobranza + '&vender=' + vender,
            success: function(res) {
                if (res == 1) {
                    $('#mensaje').html('Se ha registrado con éxito');
                    $('#contenido').load('views/roles.html');
                }else {
                    mostrar_error(res);
                }
            }
        })
    }else {
        mostrar_error('Debes indicar al menos el nombre del rol para continuar');
        $('#desc').focus();
    }
}

const selected_controls = ( ) => {
    let valor = (localStorage.getItem('seleccion') == 0 ? true : false);
    $('#productos').attr('checked', valor);
    $('#clasif').attr('checked', valor);
    $('#marcas').attr('checked', valor);
    $('#clientes').attr('checked', valor);
    $('#pr').attr('checked', valor);
    $('#sucursales').attr('checked', valor);
    $('#cajas').attr('checked', valor);
    $('#entradas').attr('checked', valor);
    $('#salidas').attr('checked', valor);
    $('#compras').attr('checked', valor);
    $('#pedidos').attr('checked', valor);
    $('#traspasos').attr('checked', valor);
    $('#usuarios').attr('checked', valor);
    $('#roles').attr('checked', valor);
    $('#cajeros').attr('checked', valor);
    $('#permisos').attr('checked', valor);
    $('#datos').attr('checked', valor);
    $('#cobranza').attr('checked', valor);
    valor = (valor ? 1 : 0);
    localStorage.setItem('seleccion', valor);
}
/* Bloque de funciones de nuevo rol */

/* Bloque de funciones de nuevo pr */
const guardar_datos_pr = ( id, operacion ) => {
    let razon = $('#razon').val();
    let nombre = $('#nombre').val();
    let direccion = $('#direccion').val();
    let colonia = $('#colonia').val();
    let telefono = $('#telefono').val();
    let poblacion = $('#poblacion').val();
    let estado = $('#estado').val();
    let saldo = $('#saldo').val();
    let idu = localStorage.getItem("idu");

    saldo = (saldo != '' ? 0 : saldo);

    if (razon != '' && nombre != '') {
        $.ajax({
            type: 'POST',
            url: 'php/regpr.php',
            data: 'idu=' + idu + '&razon=' + razon + '&nombre=' + nombre 
                    + '&direccion=' + direccion + '&colonia=' + colonia 
                    + '&telefono=' + telefono + '&poblacion=' + poblacion
                    + '&estado=' + estado + '&saldo=' + saldo + '&operacion=' + operacion
                    + '&anterior=' + id,
            success:( res ) => {
                if (res == 1) {
                    $('#mensaje').html('Se ha registrado con exito');
                    $('#contenido').load('views/proveedores.html');
                }else {
                    mostrar_error(res);
                }
            }
        });
    }else {
        mostrar_error('Debes capturar al menos el nombre y la razon social');
        $('#razon').focus();
    }
}

const editar_prov = ( id ) => {
    guardar_datos_pr( id, 1);
}
/* Bloque de funciones de nuevo pr */

/* Bloque de funciones de nuevo usuario */
const save_user = ( ) => {
    let nombre = $('#nombre').val();
    let usuario = $('#usuario').val();
    let pass = $('#pass').val();
    let roles = $('#roles').val();
    let sucursales = $('#sucursales').val();
    let operacion = 0;


    if(nombre != '' && usuario != '' && pass != '' && roles != '' && sucursales != '') {
        $.ajax({
            type: 'POST',
            url: 'php/reguser.php',
            data: 'nombre=' + nombre + '&usuario=' + usuario + '&pass=' + pass 
                    + '&roles=' + roles + '&sucursales=' + sucursales
                    + '&operacion=' + operacion,
            success: ( res ) => {
                if (res == 1) {
                    $('#mensaje').html('Se ha registrado con éxito');
                    $('#contenido').load('views/usuarios.html');
                }else {
                    mostrar_error(res);
                }
            }
        })
    }else {
        mostrar_error('Debes llenar todo el formulario completo para registrar a un usuario');
    }
}
/* Bloque de funciones de nuevo usuario */

/* Bloque de funciones de nueva marca */
const save_trademark = ( ) => {
    let desc = $('#desc').val();
    let idu = localStorage.getItem('idu');
    if (desc != '') {
        $.ajax({
            type: 'POST',
            url: 'php/regmarca.php',
            data: '&idu=' + idu + '&desc=' + desc,
            success:( res ) => {
                if (res == 1) {
                    $('#mensaje').html('Se ha registrado con exito');
                    $('#contenido').load('views/marcas.html');
                }else {
                    mostrar_error(res);
                }
            }
        });
    }else {
        mostrar_error('Debes introducir un nombre valido')
    }
}
/* Bloque de funciones de nueva marca */

/* Bloque de funciones de centrada */
const eliminar_ce = ( id ) => {
    $.ajax({
        type: 'POST',
        url: 'php/delce.php',
        data: 'id=' + id,
        success: ( res ) => {
            if (res != 0) {
                mensajes("El elemento se ha dado de baja correctamente");
                $('#contenido').load('views/centrada.html');
            }
        }
    });
}

/* Bloque de funciones de centrada */

/* Bloque de funciones de csalida */
const eliminar_cs = ( id ) => {
    $.ajax({
        type: 'POST',
        url: 'php/delcs.php', 
        data: 'id=' + id,
        success: ( res ) => {
            if (res != 0) {
                mensajes("El elemento se ha dado de baja correctamente");
                $('#contenido').load('views/csalida.html');
            }
        }
    });
}

/* Bloque de funciones de csalida */


/* Bloque de funciones de cortedia */
const checar_cantidades = ( ) => {
    // Bloque de billetes
    $('#b1000').val($('#b1000').val() == '' ? 0 : $('#b1000').val());
    $('#b500').val($('#b500').val() == '' ? 0 : $('#b500').val());
    $('#b200').val($('#b200').val() == '' ? 0 : $('#b200').val());
    $('#b100').val($('#b100').val() == '' ? 0 : $('#b200').val());
    $('#b50').val($('#b50').val() == '' ? 0 : $('#b200').val());
    $('#b20').val($('#b20').val() == '' ? 0 : $('#b200').val());
    // Bloque de billetes

    // Bloque de monedas
    $('#m10').val($('#m10').val() == '' ? 0 : $('#m10').val());
    $('#m5').val($('#m5').val() == '' ? 0 : $('#m5').val());
    $('#m2').val($('#m2').val() == '' ? 0 : $('#m2').val());
    $('#m1').val($('#m1').val() == '' ? 0 : $('#m1').val());
    $('#m05').val($('#m05').val() == '' ? 0 : $('#m05').val());
   
    // Bloque de monedas
}

const cantidades = ( ) => {
    //checar_cantidades();
    let total = 0;
    /* Inicio de bloque de billetes y sus denominaciones  */
    let valor = $('#b1000').val();
    valor = parseInt(valor);
    total += valor * 1000;


    valor = $('#b500').val();
    valor = parseInt(valor);
    total += valor * 500;

    valor = $('#b200').val();
    valor = parseInt(valor);
    total += valor * 200;

    valor = $('#b100').val();
    valor = parseInt(valor);
    total += valor * 100;

    valor = $('#b50').val();
    valor = parseInt(valor);
    total += valor * 50;

    valor = $('#b20').val();
    valor = parseInt(valor);
    total += valor * 20;
    /* Final de bloque de billetes y sus denominaciones */

    /* Inicio de bloque de billetes y sus denominaciones  */
    valor = $('#m20').val();
    valor = parseInt(valor);
    total += valor * 20;

    valor = $('#m10').val();
    valor = parseInt(valor);
    total += valor * 10;

    valor = $('#m5').val();
    valor = parseInt(valor);
    total += valor * 5;

    valor = $('#m2').val();
    valor = parseInt(valor);
    total += valor * 2;

    valor = $('#m1').val();
    valor = parseInt(valor);
    total += valor * 1;

    valor = $('#m05').val();
    valor = parseInt(valor);
    total += valor * 0.5;

    
    /* Final de bloque de billetes y sus denominaciones */
    localStorage.setItem('totalarq', total);

    const usCurrencyFormat = new Intl.NumberFormat('en-US', {style: 'currency', currency: 'MXN'})

    total = usCurrencyFormat.format(total);

    $('#subtotal').val(total);
}


const enviarcorte = ( ) => {
    const imprimir_corte = new Promise ( ( resolve, reject )  => {
        let sucursal = localStorage.getItem('sucursal');
        let usuario = localStorage.getItem('usuario');
        let contado = localStorage.getItem('totalarq');

        let printdata = "sucursal=" + sucursal + '&usuario=' + usuario + '&contado=' + contado;
        var ventana;

        $.get('tickets/ticketcorte.php', printdata, ( ) =>{
                ventana = window.open("tickets/ticketcorte.php?sucursal=" + sucursal + '&usuario=' + usuario + '&contado=' + contado); 7
                ventana.addEventListener('load' , () => {
                    resolve();
                });
        });

        return Promise;
    });


    imprimir_corte
            .then(() => {
                let sucursal = localStorage.getItem('sucursal');
                let usuario = localStorage.getItem('usuario');
                let dinero = localStorage.getItem('totalarq');
                $.ajax({
                    type: 'POST',
                    url: 'php/cerrar_corte.php',
                    data: 'sucursal=' + sucursal 
                                + '&usuario=' + usuario + '&dinero=' + dinero,
                    success:( ) => {

                    }
                });
                $('#mensaje').html('<h1 class="title">Corte realizado con éxito</h1>');
            });
}
/* Bloque de funciones de cortedia */


/* Bloque de funciones de nueva compra */
const validar_tecla_compra = ( { keyCode } ) => {
    let articulo = $('#articulo').val();
    switch (keyCode) {
        case 13:
            buscar_producto_2 ( articulo );
            break;
        case 40:
            busq_prod (  );
            break;
        default:
            break;
    }
}


const busq_prod = ( ) => {
    let articulo = $('#articulo').val();
        $.ajax({
            type: 'POST',
            url: 'php/searchprods.php',
            data: 'criterio=' + articulo,
            success: ( res ) => {
                $('#mensaje').html(res);
                $('#ventana').modal('toggle');
            }
        });
}

const agregar_renglon_compra = ( ) => {
    let code = $('#articulo').val();
    let count = $('#count').val();
    let price = $('#price').val();
    let numcompra = $('#compra').val();
    let idu = localStorage.getItem('idu');
    //let sucursal = $('#sucursales').val();
    let prov = $('#proveedores').val();
    $('#proveedores').attr("disabled", "true");

    if (code != '' && !isNaN(count) && !isNaN(price)) {
        $.ajax({
            type: 'POST',
            url: 'php/agrega_reng_comp.php',
            data: 'code=' + code + '&count=' + count + '&price=' + price
                    + '&compra=' + numcompra + '&idu=' + idu  + '&prov=' + prov,
            success: ( res ) => {
                if (res == 0) {
                    detalle_compra();
                }else {
                    mensajes(res);
                }
            }
        })
    }else {
        mensajes('Datos no válidos, debes introducir el código del producto, cantidad y precio');
    }
}

/* Bloque de funciones de nueva compra */

/* Bloque de funciones de nueva entrada */
const eliminar_reng_ent = ( id ) => {
    $.ajax({
        type: 'POST',
        url: 'php/eliminar_reng_ent.php',
        data: 'id=' + id,
        success: ( res ) => {
            if (res != 0) {
                detalle_entrada();
            }
        }
    })
}


const agregar_renglon_entrada = (  ) => {
    $('#ttentrada').removeAttr("disabled");
    let code = $('#articulo').val();
    let count = $('#count').val();
    let price = $('#price').val();
    let numentrada = $('#entrada').val();
    let idu = localStorage.getItem('idu');
    //let sucursal = $('#sucursales').val();
    let concepto = $('#conceptos').val();
    $('#conceptos').attr("disabled", "true");

    if ( code != '' && !isNaN(count) && !isNaN(price) ) {
        $.ajax({
            type: 'POST',
            url: 'php/agrega_reng_ent.php',
            data: 'code=' + code + '&count=' + count + '&price=' + price
                    + '&compra=' + numentrada + '&idu=' + idu  + '&concepto=' + concepto,
            success: ( res ) => {
                if (res == 0) {
                    $('#descrip').html('Descripción');
                    $('#articulo').val('');
                    $('#count').val('');
                    $('#price').val('');
                    $('#articulo').focus();
                    detalle_entrada();

                }else {
                    mensajes(res);
                }
            }
        })
    }else {
        mensajes('Datos no válidos, debes introducir el código del producto, cantidad y precio');
    }
}


const obtener_consec_entrada = ( ) => {
    $.ajax({
        type: 'POST',
        url: 'php/obtener_consec_entrada.php',
        success:function(res) {
            $('#entrada').val(res);
            localStorage.setItem('numentrada', res);
            detalle_entrada(res);
        }
    });

    $('#articulo').focus();
}

const detalle_entrada = ( ) => {
    let num = $('#entrada').val();
    $.ajax({
        type: 'POST',
        url: 'php/detalleentrada.php', 
        data: 'num=' + num,
        success: ( res ) => {
            $('#detalleentrada').html(res);
        }
    });
}


const cambiarcant_ent = (id, valor) => {
    localStorage.setItem('cantidad', valor);
    localStorage.setItem('renglon', id);
    $('#mensaje').load('views/cambiar_cantent.html');
    $('#ventana').modal('toggle');
}

const cambiarprecio_ent = (id, valor) => {
    localStorage.setItem('precio', valor);
    localStorage.setItem('renglon', id);
    $('#mensaje').load('views/cambiar_pentrada.html');
    $('#ventana').modal('toggle');
}
/* Bloque de funciones de nueva entrada */

/* Bloque de funciones de nueva salida */
const eliminar_reng_sal = ( id ) => {
    $.ajax({
        type: 'POST',
        url: 'php/eliminar_reng_sal.php',
        data: 'id=' + id,
        success: ( res ) => {
            if (res != 0) {
                detalle_salida();
            }
        }
    })
}



const agregar_renglon_sal = ( ) => {
    let code = $('#articulo').val();
    let count = $('#count').val();
    let price = $('#price').val();
    let numsalida = $('#salida').val();
    let idu = localStorage.getItem('idu');
    //let sucursal = $('#sucursales').val();
    let concepto = $('#conceptos').val();
    $('#conceptos').attr("disabled", "true");

    if (code != '' && !isNaN(count) && !isNaN(price)) {
        $.ajax({
            type: 'POST',
            url: 'php/agrega_reng_sal.php',
            data: 'code=' + code + '&count=' + count + '&price=' + price
                    + '&compra=' + numsalida + '&idu=' + idu  + '&concepto=' + concepto,
            success: ( res ) => {
                if (res == 0) {
                    $('#descrip').html('Descripción');
                    $('#articulo').val('');
                    $('#count').val('');
                    $('#price').val('');
                    $('#articulo').focus();
                    detalle_salida();

                }else {
                    mensajes(res);
                }
            }
        })
    }else {
        mensajes('Datos no válidos, debes introducir el código del producto, cantidad y precio');
    }
}

const detalle_salida = ( ) => {
    let num = $('#salida').val();
    $.ajax({
        type: 'POST',
        url: 'php/detallesalida.php', 
        data: 'num=' + num,
        success: ( res ) => {
            $('#detallesalida').html(res);
        }
    });
}


const obtener_consec = ( ) => {
    $.ajax({
        type: 'POST',
        url: 'php/obtener_consec_salida.php',
        success:( res ) => {
            $('#salida').val(res);
            localStorage.setItem('numsalida', res);
            detalle_salida(res);
        }
    });

    $('#articulo').focus();
}


const cambiarcant_sal = ( id, valor ) => {
    localStorage.setItem('cantidad', valor);
    localStorage.setItem('renglon', id);
    $('#mensaje').load('views/cambiar_cantsal.html');
    $('#ventana').modal('toggle');
}

const cambiarprecio_sal = ( id, valor ) => {
    localStorage.setItem('precio', valor);
    localStorage.setItem('renglon', id);
    $('#mensaje').load('views/cambiar_psalida.html');
    $('#ventana').modal('toggle');
}

/* Bloque de funciones de nueva salida */

/* Bloque de funciones de pedidos de compra */
const eliminar_pedido = ( id ) => {
    $.ajax({
        type: 'POST',
        url: 'php/eliminarpedido.php',
        data: 'id=' + id,
        success: ( res ) => {
            if (res == 1) {
                mensajes('Se desecho el pedido');
                $('#contenido').load('views/pedidos.html');
            }else {
                mensajes(res);
            }
        }
    });
}

const finalizar_pedido = ( id ) => {
    $.ajax({
        type: 'POST',
        url: 'php/finalizarpedido.php',
        data: 'id=' + id,
        success: ( res ) => {
            console.log(res);
            if (res == 1) {
                mensajes('Pedido guardado con éxito');
                imprimir_formato(id, 'pedido');
                $('#contenido').load('views/pedidos.html');
            }else {
                mostrar_error(res);
            }
        }
    });
}


/* Bloque de funciones de pedidos de compra */

/* Bloque de funciones de nuevo pedidos de compra */
const eliminar_reng_ped = ( id ) => {
    $.ajax({
        type: 'POST',
        url: 'php/eliminar_reng_ped.php',
        data: 'id=' + id,
        success: ( res ) => {
            if (res != 0) {
                detalle_pedido();
            }
        }
    })
}

const agregar_renglon_pedido = ( ) => {
    let code = $('#articulo').val();
    let count = $('#count').val();
    let price = $('#price').val();
    let numpedido = $('#pedido').val();
    let idu = localStorage.getItem('idu');
    //let sucursal = $('#sucursales').val();
    let pr = $('#proveedores').val();
    $('#proveedores').attr("disabled", "true");

    if (code != '' && !isNaN(count) && !isNaN(price)) {
        $.ajax({
            type: 'POST',
            url: 'php/agrega_reng_ped.php',
            data: 'code=' + code + '&count=' + count + '&price=' + price
                    + '&compra=' + numpedido + '&idu=' + idu  + '&pr=' + pr,
            success: ( res ) => {
                if (res == 0) {
                    $('#descrip').html('Descripción');
                    $('#articulo').val('');
                    $('#count').val('');
                    $('#price').val('');
                    $('#articulo').focus();
                    detalle_pedido();

                }else {
                    mensajes(res);
                }
            }
        })
    }else {
        mensajes('Datos no válidos, debes introducir el código del producto, cantidad y precio');
    }
}

const cambiarcant_pedido = ( id, valor ) => {
    localStorage.setItem('cantidad', valor);
    localStorage.setItem('renglon', id);
    $('#mensaje').load('views/cambiar_cantped.html');
    $('#ventana').modal('toggle');
}

const cambiarprecio_pedido =( id, valor ) => {
    localStorage.setItem('precio', valor);
    localStorage.setItem('renglon', id);
    $('#mensaje').load('views/cambiar_ppedido.html');
    $('#ventana').modal('toggle');
}

const obtener_consec_pedido = ( ) => {
    $.ajax({
        type: 'POST',
        url: 'php/obtener_consec_pedido.php',
        success:( res ) => {
            $('#pedido').val(res);
            localStorage.setItem('numpedido', res);
            detalle_pedido(res);
        }
    });

    $('#articulo').focus();
}

/*
    Funcion que muestra el detalle de la entrada
*/
const detalle_pedido = ( ) => {
    let num = $('#pedido').val();
    $.ajax({
        type: 'POST',
        url: 'php/detallepedido.php', 
        data: 'num=' + num,
        success: ( res ) => {
            $('#detallepedido').html(res);
        }
    });
}

/* Bloque de funciones de nuevo pedidos de compra */

/* Bloque de funciones de transpaso a sucursal */
const eliminar_traspaso_suc = ( id ) => {
    $.ajax({
        type: 'POST',
        url: 'php/traspasos/eliminartraspaso.php',
        data: 'id=' + id,
        success: ( ) => {
            mensajes('Se ha eliminado el traspaso con éxito');
            $('#contenido').load('views/trassuc.html');
        }
    })
}

const editar_traspaso_suc = ( id ) => { 
    let idu = localStorage.getItem('idu');
    let sucursal = localStorage.getItem('sucursal');
    localStorage.setItem('numtras', id);
    $('#contenido').load('views/newtrsuc.php');
     
}

// function imprimir_traspaso(id) {
//     var printdata = "id=" + id;
//     $.get('tickets/traspasoticket.php', printdata, function(){
//             window.open("tickets/traspasoticket.php?id=" + id); 
//       });
// }

const aplicar_traspaso_suc = ( id ) => {
    let idu = localStorage.getItem('idu');
    $.ajax({
        type: 'POST',
        url: 'php/trassuc/aplicartraspaso.php',
        data: 'id=' + id + '&idu=' + idu,
        success: ( res ) => {
            if (res == 1) {
                mensajes('Se ha aplicado con éxito el traspaso a la sucursal');
                $('#contenido').load('views/trassuc.html');
            }else {
                mensajes(res);
            }
        }
    });
}
/* Bloque de funciones de transpaso a sucursal */

/* Bloque de funciones de nueva sucursal */
const guardar_sucursal = ( operacion, id ) => {
    let sucursal = $('#sucursal').val();
    let direccion = $('#direccion').val();
    let telefono = $('#telefono').val();
    let cp = $('#cp').val();
    let ciudad = $('#ciudad').val();
    let estado = $('#estado').val();
    let idu = localStorage.getItem('idu');

    if (sucursal != '' && direccion != '') {
        $.ajax({
            type: 'POST',
            url: 'php/regsuc.php',
            data: 'sucursal=' + sucursal + '&direccion=' + direccion + '&telefono=' + telefono 
                    + '&cp=' + cp + '&ciudad=' + ciudad + '&estado=' + estado 
                    + '&operacion=' + operacion + '&idu=' + idu + '&anterior=' + id,
            success: ( res ) => {
                if (res == 1) {
                    $('#mensaje').html('Se ha registrado con éxito');
                    $('#contenido').load('views/sucursales.html');
                }else {
                    mostrar_error(res);
                }
            }
        });
    }else {
        mostrar_error('Debes llenar los siguientes campos: sucursal, direccion para continuar');
    }
}
/* Bloque de funciones de nueva sucursal */

/* Bloque de funciones de nuevos clientes */
const actualizar_cte = ( id ) => {
    guardar_datos(1, id);
}

const guardar_datos = ( operacion, id) => {
    let nombre = $('#nombre').val();
    let direccion = $('#direccion').val();
    let telefono = $('#telefono').val();
    let poblacion = $('#poblacion').val();
    let estado = $('#estado').val();
    let lista = $('#lista').val();
    let clasifica = $('#clasifica').val();
    let limite = $('#limite').val();
    let idu = localStorage.getItem('idu');

    if (nombre != '') {
        $.ajax({
            type: 'POST',
            url: 'php/regcte.php',
            data: 'idu=' + idu + '&nombre=' + nombre + '&direccion=' + direccion
            + '&telefono=' + telefono + '&poblacion=' + poblacion + '&estado=' + estado
                + '&lista=' + lista + '&operacion=' + operacion
                + '&clasifica=' + clasifica  + '&limite=' + limite + '&anterior=' + id,
            success:( res ) => {
                if (res == 1) {
                    $('#mensaje').html('Se ha registrado con exito');
                    $('#contenido').load('views/clientes.html');
                }else {
                    mostrar_error(res);
                }
            }
        });
    }else {
        mostrar_error('Debes introducir un nombre de cliente antes de continuar')
    }
}
/* Bloque de funciones de nuevos clientes */

/* Bloque de funciones de ingresardinero */
const ingresar_dinero = ( ) => {
    let concepto = $('#concepto').val();
    let monto = $('#monto').val();
    let idu = localStorage.getItem('idu');
    let sucursal = localStorage.getItem('sucursal');

    if (concepto != '' && monto != '') {
        $.ajax({
            type: 'POST',
            url: 'php/retirar.php',
            data: 'concepto=' + concepto + '&monto=' + monto
                    + '&idu=' + idu 
                    + '&sucursal=' + sucursal + '&tipo=' + "I",
            success: ( res ) => {
                imprimir_formato(res, 'retiro');
                $('#mensaje').html('Se ha realizado con exito el ingreso');
            }
        });
    }else {
        mostrar_error('Debes introducir el concepto y el monto del ingreso antes de continuar');
    }
}
/* Bloque de funciones de ingresardinero */

/* Bloque de funciones de individual */
const reporte_ind = ( ) => {
    $('#resultado').html('<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>');
    var socio = $('#socio').val();
    if (socio != '') {
        $.ajax({
            type: 'POST',
            url: 'php/resultados2.php',
            data: 'socio=' + socio + '&fecha1=' + $('#fecha1').val()
                        + '&fecha2=' + $('#fecha2').val(),
            success: ( res ) => {
                $('#lindiviual').html(res);
                $('#formulario').slideUp('slow');
            }
        });    
    }else {
        mensajes('Debes indicar el nombre del socio');
    }
}

const regresar = ( ) => {
    $('#contenido').load('views/individual.html');
}
/* Bloque de funciones de individual */

/* Bloque de funciones de nuevo transpaso */
const eliminar_reng_t = ( id ) => {
    $.ajax({
        type: 'POST',
        url: 'php/traspasos/eliminar_reng_tras.php',
        data: 'id=' + id,
        success: ( res ) => {
            if (res != 0) {
                detalle_traspaso();
            }
        }
    })
}

const detalle_traspaso = ( ) => {
    let numtras = localStorage.getItem('numtras');
    $.ajax({
        type: 'POST',
        url: 'php/traspasos/detalletraspasos.php',
        data: 'traspaso=' + numtras,
        success:( res ) => {
            $('#traspasoslist').html(res);
        }
    })
}


const a_traspasos_reng = ( ) => {
    let producto = $('#codigov').val();
    let cantidad = $('#cantidades').val();
    let descrip = $('#descripv').html();
    let sucursal = $('#sucursal').html();
    let numtras = localStorage.getItem('numtras');

    if (producto != '' && descrip != '' && cantidad != '') {
        $.ajax({
            type: 'POST',
            url: 'php/traspasos/agregar_reng.php',
            data: 'producto=' + producto + '&cantidad=' + cantidad
                    + '&sucursal=' + sucursal + '&numtras=' + numtras,
            success: ( ) => {
                $('#sucursal').attr('disabled', true);
                $('#codigov').val('');
                $('#cantidades').val('1');
                $('#descripv').html('Prod');
                $('#codigov').focus();
                detalle_traspaso();
            }
        })
    }else {
        mostrar_error('Debes capturar el producto y la cantidad que deseas traspasar');
    }
}


const guardar_traspaso = ( ) => {
    let numtras = localStorage.getItem('numtras');
    let sucursal = $('#sucursal').val();
    if (sucursal != '') {
        $.ajax({
            type: 'POST',
            url: 'php/traspasos/guardar_traspaso.php',
            data: 'numtras=' + numtras + '&sucursal=' + sucursal,
            success: ( res ) => {
                if (res == 1) {
                    mensajes('Se guardo con éxito el traspaso, solo falta confirmarlo');
                    $('#contenido').load('views/traspasos.html');
                }else {
                    mostrar_error(res);
                }
            }
        })
    }else {
        mostrar_error('Debes seleccionar la sucursal a la que se aplicará el traspaso');
    }
}



/* Bloque de funciones de nuevo transpaso */


/* Bloque de funciones de nuevo recibo */
const guardar_recibo = ( ) =>  {
    let nombre = $('#nombre').val();
    let concepto = $('#concepto').val();
    let monto = $('#monto').val();

    if (nombre != '' && concepto != '' && monto != '') {
        $.ajax({
            type: 'POST',
            url: 'php/salvar_recibo.php',
            data: 'nombre=' + nombre + '&concepto=' 
                    + concepto + '&monto=' + monto
                    + '&fecha=' + fecha_actual(),
            success: ( res ) => {
                if (res != 0) {
                    $('#mensaje').html('Se ha registrado con éxito');
                    $('#contenido').load('php/recibos.php');
                    imprimir_formato(res, 'recibo');
                }else {
                    mostrar_error(res);
                }
            }
        })
    }else {
        mostrar_error('Debes introducir todos los datos antes de continuar');
        $('#nombre').focus();
    }
}
/* Bloque de funciones de nuevo recibo */

 



 
  

$(document).ready(( ) => {
    
    localStorage.clear();

	$.extend( true, $.fn.dataTable.defaults, {
        "language": {
                "decimal": ",",
                "thousands": ".",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoPostFix": "",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "loadingRecords": "Cargando...",
                "lengthMenu": "Mostrar _MENU_ registros",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "processing": "Procesando...",
                "search": "Buscar:",
                "searchPlaceholder": "Término de búsqueda",
                "zeroRecords": "No se encontraron resultados",
                "emptyTable": "Ningún dato disponible en esta tabla",
                "aria": {
                    "sortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                //only works for built-in buttons, not for custom buttons
                "buttons": {
                    "create": "Nuevo",
                    "edit": "Cambiar",
                    "remove": "Borrar",
                    "copy": "Copiar",
                    "csv": "fichero CSV",
                    "excel": "tabla Excel",
                    "pdf": "documento PDF",
                    "print": "Imprimir",
                    "colvis": "Visibilidad columnas",
                    "collection": "Colección",
                    "upload": "Seleccione fichero...."
                },
                "select": {
                    "rows": {
                        _: '%d filas seleccionadas',
                        0: 'clic fila para seleccionar',
                        1: 'una fila seleccionada'
                    }
                }
            },
            buttons: [
                'copy',
                'excel'
            ]
    });


        
});
