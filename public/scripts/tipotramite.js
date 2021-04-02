function cambiarPaginaTipoTramite(pagina)
{
    paginas = pagina
    $.ajax({
        //busqueda=
        url: 'tipo-tramite-todos'+'?page='+paginas+'&paginacion='+paginacion,
        type:"GET",
        success: function (respuesta) {
            $('#detalle-tabla').html(respuesta)
        }
    });
}

function cambiarPaginaTipoTramite()
{
    paginacion = $('#tipoTramite-paginacion').val()
    $.ajax({
        //busqueda=
        url: 'tipo-tramite-todos'+'?page='+paginas+'&paginacion='+paginacion,
        type:"GET",
        success: function (respuesta) {
            $('#detalle-tabla').html(respuesta)
        }
    });
}

function buscarTipoTramite(buscar)
{
   mostrarTipoTramitesTodos(buscar);
}

function mostrarTipoTramitesTodos(buscar)
{
    buscar = (!buscar) ? '' : buscar
    $.ajax({
        url: 'tipo-tramite-todos?buscar='+buscar,
        type:"GET",
        success: function (respuesta) {
            filtro = 'todos'
            $('#detalle-tabla').html(respuesta)
        }
    });
}

function nuevoTipoTramite()
{
    $.ajax({
        url:'tipo-tramite/create',
        type:"GET",
        success: function (respuesta) {
            estadoCrud = 'nuevo';
            $('#modal-default-title').html('Nuevo Tipo Trámite');
            $('#modal-default-body').html(respuesta)
            $('#modal-default').modal('show')
        }
    });
}

function guardarTipoTramite(event)
{
    event.preventDefault();

    var form = $('#form-tipo-tramite'),
                url = form.attr('action'),
                method =form.attr('method');

    $.ajax({
        url : url,
        method: method,
        data : form.serialize(),
        success: function (respuesta) {
            if(respuesta.ok ==1)
            {
                $('#modal-default').modal('hide')

                Swal.fire({
                    title: 'Tipo Trámites',
                    text: respuesta.mensaje,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        cambiarVista('tipo-tramite')
                    }
                })
            }
        },
        error : function (xhr) {
            var res = xhr.responseJSON;
            if ($.isEmptyObject(res) == false) {
                $.each(res.errors, function (key, value) {
                    $('#' + key).addClass('is-invalid')
                        .closest('.col-md-9')
                        .append('<small class="text-danger">' + value + '</small>');
                });
            }
        }
    })
}

function editarTipoTramite(tipoTramite)
{
    $.ajax({
        url:'tipo-tramite/'+tipoTramite+'/edit',
        dataType:'html',
        success: function(respuesta){
            estadoCrud = 'editar';
            $('#modal-default-title').html('Nuevo Tipo Trámite');
            $('#modal-default-body').html(respuesta)
            $('#modal-default').modal('show')
        }
    })
}

function eliminarTipoTramite(tipoTramite) {

    Swal.fire({
        title: 'Eliminar el Tipo Trámite',
        text: '¿Seguro de Eliminar El Registro? No podrá revertirlo',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText:"<i class='fas fa-eraser'></i> Aceptar",
        confirmButtonColor:"#6610f2",
        cancelButtonText:"<i class='fas fa-times'></i> Cancelar",
        cancelButtonColor:"#e3342f"
    }).then((respuesta) => {
        if(respuesta.value) {
            eliminarPermanenteTipoTramite(tipoTramite)
        }
    })
}

function eliminarPermanenteTipoTramite(tipoTramite)
{
    $.ajax({
        url:'tipo-tramite/'+tipoTramite,
        method:'DELETE',
        data:{
            _token:csrf_token
        },
        success: function(respuesta){
            if(respuesta.ok ==1)
            {

                Swal.fire({
                    title: 'Tipo Trámites',
                    text: respuesta.mensaje,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        cambiarVista('tipo-tramite')
                    }
                })
            }
        }
    })
}
