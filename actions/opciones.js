$(document).ready(function () {
    //$('#mvender').addClass('active');

    $('#mprods').on('click', function() {
        localStorage.setItem("valor", 1);
        validar();
        $('#contenido').load('views/productos.html');
    });

    $('#mclasifica').on('click', function() {
        localStorage.setItem("valor", 1);
        validar();
        $('#contenido').load('views/clasificaciones.html');
    });

    $('#mmarca').on('click', function() {
        localStorage.setItem("valor", 1);
        validar();
        $('#contenido').load('views/marcas.html');
    });

    $('#mcte').on('click', function() {
        localStorage.setItem("valor", 1);
        validar();
        $('#contenido').load('views/clientes.html');
    });

    $('#mcobranza').on('click', function() {
        localStorage.setItem("valor", 1);
        validar();
        $('#contenido').load('views/cobranza.php');
    });

    $('#mpr').on('click', function() {
        localStorage.setItem("valor", 1);
        validar();
        $('#contenido').load('views/proveedores.html');
    });

    $('#msucursales').on('click', function() {
        localStorage.setItem("valor", 1);
        validar();
        $('#contenido').load('views/sucursales.html');
    });

    $('#mcajeros').on('click', function() {
        localStorage.setItem("valor", 1);
        validar();
        $('#contenido').load('views/cajeros.html');
    });

    $('#musers').on('click', function() {
        localStorage.setItem("valor", 3);
        validar();
        $('#contenido').load('views/usuarios.html');
    });

    $('#mentradas').on('click', function() {
        localStorage.setItem("valor", 2);
        validar();
        $('#contenido').load('views/entradas.html');
    });

    $('#msalidas').on('click', function() {
        localStorage.setItem("valor", 2);
        validar();
        $('#contenido').load('views/salidas.html');
    });

    $('#mpedidos').on('click', function() {
        localStorage.setItem("valor", 2);
        validar();
        $('#contenido').load('views/pedidos.html');
    });

    $('#mtraspasos').on('click', function() {
        localStorage.setItem("valor", 2);
        validar();
        $('#contenido').load('views/traspasos.html');
    });

    $('#mtrassuc').on('click', function() {
        localStorage.setItem("valor", 2);
        validar();
        $('#contenido').load('views/trassuc.html');
    });

    $('#mempresa').on('click', function() {
        localStorage.setItem("valor", 3);
        validar();
        $('#contenido').load('views/empresa.php');
    });

    $('#mroles').on('click', function() {
        localStorage.setItem("valor", 3);
        validar();
        $('#contenido').load('views/roles.html');
    });

    $('#mcentrada').on('click', function() {
        localStorage.setItem("valor", 3);
        validar();
        $('#contenido').load('views/centrada.html');
    });

    $('#mcsalida').on('click', function() {
        localStorage.setItem("valor", 3);
        validar();
        $('#contenido').load('views/csalida.html');
    });

    $('#mvender').on('click', function() {
        localStorage.setItem("valor", 0);
        validar();
        $.post("views/vender.php",{ usuario: localStorage.getItem('usuario') }, 
					function(data) {
						$('#contenido').html(data);
					});
    });
    
    $('#mventas').on('click', function() {
        localStorage.setItem("valor", 7);
        validar();
        $('#contenido').load('php/ventas.php');
    });
    
    $('#mrecibos').on('click', function() {
        localStorage.setItem("valor", 8);
        validar();
        $('#contenido').load('php/recibos.php');
    });
    
    $('#mcontable').on('click', function() {
        localStorage.setItem("valor", 8);
        validar();
        $('#contenido').load('views/contable.html');
    });

    $('#mstore').on('click', function() {
        let sucursal = localStorage.getItem('sucursal');
        localStorage.setItem("valor", 6);
        validar();
        $.ajax({
            type: 'POST',
            url: 'php/misprods.php',
            data: 'sucursal=' + sucursal,
            success:function(res) {
                $('#contenido').html(res);
            }
        })
    });

    $('#mresumen').on('click', function() {
        let sucursal = localStorage.getItem('sucursal');
        let fecha = fecha_actual();
        $.ajax({
            type: 'POST',
            url: 'views/resumen.php',
            data: 'sucursal=' + sucursal + '&fecha=' + fecha,
            success:function(res) {
                $('#contenido').html(res);
                localStorage.setItem("valor", 4);
                validar();
            }
        });
    });

    $('#mcompras').on('click', function() {
        localStorage.setItem("valor", 2);
        validar();
        $('#contenido').load('views/compras.html');
    });


    $('#mcomprasuc').on('click', function() {
        localStorage.setItem("valor", 9);
        validar();
        $('#contenido').load('views/compras.html');
    });

    $('#mcorte').on('click', function() {
        localStorage.setItem("valor", 5);
        validar();
        $('#contenido').load('views/corte.html');
    });

    $('#mrptvta').on('click', function() {
        localStorage.setItem("valor", 5);
        validar();
        $('#contenido').load('views/reportes/reportesvtas.html');
    });

    $('#mrptinv').on('click', function() {
        localStorage.setItem("valor", 5);
        validar();
        $('#contenido').load('views/reportes/reporteinv.html');
    });

    $('#mrptcte').on('click', function() {
        localStorage.setItem("valor", 5);
        validar();
        $('#contenido').load('views/reportes/reportecte.html');
    });

    $('#mrptcomp').on('click', function() {
        localStorage.setItem("valor", 5);
        validar();
        $('#contenido').load('views/reportes/reportecomp.html');
    });

    $('#mrptsal').on('click', function() {
        localStorage.setItem("valor", 5);
        validar();
        $('#contenido').load('views/reportes/reportesal.html');
    });

    $('#mrpttras').on('click', function() {
        localStorage.setItem("valor", 5);
        validar();
        $('#contenido').load('views/reportes/reportetras.html');
    });

    $('#mrptped').on('click', function() {
        localStorage.setItem("valor", 5);
        validar();
        $('#contenido').load('views/reportes/reporteped.html');
    });


    $('#cerrar_sesion').on('click', function() {
        localStorage.setItem("valor", 0);
        validar();
        $('#logo').load('views/logo.html');
        $('#contenido').load('views/login.html');
        $('#barra').html('');
    });
});