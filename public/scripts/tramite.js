let estadoCrud =''

function nuevoTramite()
{
    $.ajax({
        url:'tramite/create',
        type:"GET",
        success: function (respuesta) {
            estadoCrud = 'nuevo';
            $('#modal-xl-title').html('Nuevo Trámite');
            $('#modal-xl-body').html(respuesta)
            $('#modal-xl').modal('show')
        }
    });
}
