function cambiarPaginaDocumentoTramite(pagina)
{
    paginas = pagina
    $.ajax({
        //busqueda=
        url: 'documento-tramites-todos'+'?page='+paginas+'&paginacion='+paginacion,
        type:"GET",
        success: function (respuesta) {
            $('#detalle-tabla').html(respuesta)
        }
    });
}

function cambiarPaginacionDocumentoTramite()
{
    paginacion = $('#documento-tramite-paginacion').val()
    $.ajax({
        url: 'documento-tramites-todos'+'?page='+paginas+'&paginacion='+paginacion,
        type:"GET",
        success: function (respuesta) {
            $('#detalle-tabla').html(respuesta)
        }
    });
}

function buscarDocumentoTramite(buscar)
{
   mostrarDocumentoTramitesTodos(buscar);
}

function mostrarDocumentoTramitesTodos(buscar)
{
    buscar = (!buscar) ? '' : buscar
    $.ajax({
        url: 'documento-tramites-todos?buscar='+buscar,
        type:"GET",
        success: function (respuesta) {
            filtro = 'todos'
            $('#detalle-tabla').html(respuesta)
        }
    });
}

function nuevoDocumentoTramite()
{
    $.ajax({
        url:'documento-tramites/create',
        type:"GET",
        success: function (respuesta) {
            estadoCrud = 'nuevo';
            $('#modal-default-title').html('Nuevo Documento Trámite');
            $('#modal-default-body').html(respuesta)
            $('#modal-default').modal('show')
        }
    });
}

function guardarDocumentoTramite()
{
    var form = $('#form-documento-tramite'),
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
                    title: 'Documento Trámites',
                    text: respuesta.mensaje,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        cambiarVista('documento-tramites')
                    }
                })
            }
        },
        error : function (xhr) {
            var res = xhr.responseJSON;
            if ($.isEmptyObject(res) == false) {
                $.each(res.errors, function (key, value) {
                    $('#' + key).addClass('is-invalid')
                        .closest('.col-md-10')
                        .append('<small class="text-danger">' + value + '</small>');
                });
            }
        }
    })
}

function editarDocumentoTramite(documentoTramite)
{
    $.ajax({
        url:'documento-tramites/'+documentoTramite+'/edit',
        dataType:'html',
        success: function(respuesta){
            estadoCrud = 'editar';
            $('#modal-default-title').html('Nuevo Documento Trámite');
            $('#modal-default-body').html(respuesta)
            $('#modal-default').modal('show')
        }
    })
}


function eliminarDocumentoTramite(documentoTramite) {

    Swal.fire({
        title: 'Eliminar el Documento Trámite',
        text: '¿Seguro de Eliminar El Registro? No podrá revertirlo',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText:"<i class='fas fa-eraser'></i> Aceptar",
        confirmButtonColor:"#6610f2",
        cancelButtonText:"<i class='fas fa-times'></i> Cancelar",
        cancelButtonColor:"#e3342f"
    }).then((respuesta) => {
        if(respuesta.value) {
            eliminarPermanenteDocumentoTramite(documentoTramite)
        }
    })
}

function eliminarPermanenteDocumentoTramite(documentoTramite)
{
    $.ajax({
        url:'documento-tramites/'+documentoTramite,
        method:'DELETE',
        data:{
            _token:csrf_token
        },
        success: function(respuesta){
            if(respuesta.ok ==1)
            {

                Swal.fire({
                    title: 'Documentos Trámites',
                    text: respuesta.mensaje,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        cambiarVista('documento-tramites')
                    }
                })
            }
        }
    })
}
