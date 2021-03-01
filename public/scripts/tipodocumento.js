$(function() {
    $.ajax({
        url: 'tipodocumentos?buscar=',
        type:"GET",
        success: function (respuesta) {
            $('#tab-content').html(respuesta)
        }
    });
})

function cambiarPaginaTipoDocumento(pagina)
{
    $.ajax({
        //busqueda=
        url: 'tipodocumentos-'+filtro+'?page='+pagina,
        type:"GET",
        success: function (respuesta) {
            $('#detalle-tabla').html(respuesta)
        }
    });
}

function mostrarFiltroTipoDocumento(filtro)
{
    switch(filtro)
    {
        case 'todos':mostrarTipoDocumentosTodos();break;
        case 'habilitados':mostrarTipoDocumentosHabilitados();break;
        case 'eliminados':mostrarTipoDocumentosEliminados();break;
    }
}

function buscarTipoDocumento(buscar)
{
    switch(filtro)
    {
        case 'habilitados':mostrarTipoDocumentosHabilitados(buscar);break;
        case 'todos':mostrarTipoDocumentosTodos(buscar);break;
        case 'eliminados':mostrarTipoDocumentosEliminados(buscar);break;
    }
}

function mostrarTipoDocumentosTodos(buscar)
{
    buscar = (!buscar) ? '' : buscar
    $.ajax({
        url: 'tipodocumentos-todos?buscar='+buscar,
        type:"GET",
        success: function (respuesta) {
            filtro = 'todos'
            $('#detalle-tabla').html(respuesta)
        }
    });
}

function mostrarTipoDocumentosHabilitados(buscar)
{
    buscar = (!buscar) ? '' : buscar
    $.ajax({
        url: 'tipodocumentos-habilitados?buscar='+buscar,
        type:"GET",
        success: function (respuesta) {
            filtro = 'habilitados'
            $('#detalle-tabla').html(respuesta)
        }
    });
}

function mostrarTipoDocumentosEliminados(buscar)
{
    buscar = (!buscar) ? '' : buscar
    $.ajax({
        url: 'tipodocumentos-eliminados?buscar='+buscar,
        type:"GET",
        success: function (respuesta) {
            filtro = 'eliminados'
            $('#detalle-tabla').html(respuesta)
        }
    });
}

function nuevoTipoDocumento()
{
    $.ajax({
        url:'tipodocumentos/create',
        type:"GET",
        success: function (respuesta) {
            estadoCrud = 'nuevo';
            $('#modal-default-title').html('Nuevo Tipo Documento');
            $('#modal-default-body').html(respuesta)
            $('#modal-default').modal('show')
        }
    });
}

function guardarTipoDocumento()
{
    var form = $('#form-tipodocumento'),
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
                    title: 'Tipo Documentos',
                    text: respuesta.mensaje,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        cambiarVista('tipodocumentos')
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

function editarTipoDocumento(tipodocumento)
{
    $.ajax({
        url:'tipodocumentos/'+tipodocumento+'/edit',
        dataType:'html',
        success: function(respuesta){
            estadoCrud = 'editar';
            $('#modal-default-title').html('Nuevo Tipo Documento');
            $('#modal-default-body').html(respuesta)
            $('#modal-default').modal('show')
        }
    })
}

function eliminarTipoDocumento(tipodocumento) {

    Swal.fire({
        title: 'Eliminar Tipo Documento',
        text: '¿Seguro de Eliminar El Registro? No podrá revertirlo',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText:"<i class='fas fa-trash-alt'></i> A Papelera",
        confirmButtonColor:"#6610f2",
        cancelButtonText:"<i class='fas fa-eraser'></i> Permanentemente",
        cancelButtonColor:"#e3342f"
    }).then((respuesta) => {
        if(respuesta.value) {
            eliminarTemporalTipoDocumento(tipodocumento)
        }
        else if( respuesta.dismiss === swal.DismissReason.cancel) {
            this.eliminarPermanenteTipoDocumento(tipodocumento)
        }
    })
}

function eliminarTemporalTipoDocumento(tipodocumento)
{
    $.ajax({
        url:'tipodocumentos-delete/'+tipodocumento,
        method:'POST',
        data:{
            _token:csrf_token
        },
        success: function(respuesta){
            if(respuesta.ok ==1)
            {

                Swal.fire({
                    title: 'Tipo Documentos',
                    text: respuesta.mensaje,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        cambiarVista('tipodocumentos')
                    }
                })
            }
        }
    })
}

function eliminarPermanenteTipoDocumento(tipodocumento)
{
    $.ajax({
        url:'tipodocumentos/'+tipodocumento,
        method:'DELETE',
        data:{
            _token:csrf_token
        },
        success: function(respuesta){
            if(respuesta.ok ==1)
            {

                Swal.fire({
                    title: 'Tipo Documentos',
                    text: respuesta.mensaje,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        cambiarVista('tipodocumentos')
                    }
                })
            }
        }
    })
}

function restaurarTipoDocumento(tipodocumento)
{
    swal.fire({
        title:"Tipo Documentos",
        text:'¿Está Seguro de Restaurar el Tipo Documento?"',
        icon:"question",
        showCancelButton: true,
        confirmButtonText:"Si",
        confirmButtonColor:"#28a745",
        cancelButtonText:"No",
        cancelButtonColor:"#dc3545"
    }).then( (response) => {
        if(response.value) {

            $.ajax({
                url:'tipodocumentos-restaurar',
                method:'POST',
                data:{
                    id: tipodocumento,
                    _token:csrf_token
                },
                success: function(respuesta){
                    if(respuesta.ok ==1)
                    {

                        Swal.fire({
                            title: 'Tipo Documentos',
                            text: respuesta.mensaje,
                            icon: 'success',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                cambiarVista('tipodocumentos')
                            }
                        })
                    }
                }
            })
        }
    })
}


