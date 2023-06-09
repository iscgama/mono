$(document).ready(function () {
    $('#rptinvgral').on('click', function() {
        $('#contenido').html('<div class="spinner-grow text-primary" role="status"><span class="sr-only">Loading...</span></div>');
        $.ajax({
            type: 'POST',
            url: 'php/reportes/inventariogral.php',
            success:function(res) {
                $('#contenido').html(res);
            }
        })
    });

    $('#rptinvclasif').on('click', () => {
        $('#contenido').load('views/reportes/rptinv/rptclasif.php');
    });


    $('#rptvalcosto').on('click', () => {
        $('#contenido').load('views/reportes/rptinv/rptvaluacion.php'); 
    });

});