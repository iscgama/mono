$(document).ready(function () {
    $('#impclasif').on('click', () => {
        
        let clasif = $('#clasif').val();

        if (clasif != '') {
            let sucursal = localStorage.getItem('sucursal');
            let usuario = localStorage.getItem('usuario');

            let printdata = "clasif=" + clasif + '&sucursal=' + sucursal + '&usuario=' + usuario;

            $.get('tickets/invclasif.php', printdata, function(){
                window.open("tickets/invclasif.php?clasif=" + clasif + '&sucursal=' + sucursal + '&usuario=' + usuario); 
            });    
        }else {
            mensajes('No existen clasificaciones para mostrar');
        }

        
    });
});