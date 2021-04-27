function cambiarPaginaPermiso(pagina)
{
    paginas = pagina
    $.ajax({
        //busqueda=
        url: 'permisos-todos'+'?page='+paginas+'&paginacion='+paginacion,
        type:"GET",
        success: function (respuesta) {
            $('#detalle-tabla').html(respuesta)
        }
    });
}

function cambiarPaginacionPermiso()
{
    paginacion = $('#permiso-paginacion').val()
    $.ajax({
        //busqueda=
        url: 'permisos-todos'+'?page='+paginas+'&paginacion='+paginacion,
        type:"GET",
        success: function (respuesta) {
            $('#detalle-tabla').html(respuesta)
        }
    });
}

function mostrarFiltroPermiso(filtro)
{
    switch(filtro)
    {
        case 'todos':mostrarPermisosTodos();break;
        case 'habilitados':mostrarPermisosHabilitados();break;
        case 'eliminados': mostrarPermisosEliminados();break;
    }
}

function buscarPermiso(buscar)
{
    switch(filtro)
    {
        case 'habilitados':mostrarPermisosHabilitados(buscar);break;
        case 'todos': mostrarPermisosTodos(buscar);break;
        case 'eliminados':mostrarPermisosEliminados(buscar);break;
    }
}

function mostrarPermisosTodos(buscar)
{
    buscar = (!buscar) ? '' : buscar
    $.ajax({
        url: 'permisos-todos?buscar='+buscar,
        type:"GET",
        success: function (respuesta) {
            filtro = 'todos'
            $('#detalle-tabla').html(respuesta)
        }
    });
}

function mostrarPermisosHabilitados(buscar)
{
    buscar = (!buscar) ? '' : buscar
    $.ajax({
        url: 'permisos-habilitados?buscar='+buscar,
        type:"GET",
        success: function (respuesta) {
            filtro = 'habilitados'
            $('#detalle-tabla').html(respuesta)
        }
    });
}

function mostrarPermisosEliminados(buscar)
{
    buscar = (!buscar) ? '' : buscar

    $.ajax({
        url: 'permisos-eliminados?buscar='+buscar,
        type:"GET",
        success: function (respuesta) {
            filtro = 'eliminados'
            $('#detalle-tabla').html(respuesta)
        }
    });
}
// FUNCIONES PARA MODELO PERMISO
function nuevoPermiso()
{
    $.ajax({
        url:'permisos/create',
        type:"GET",
        success: function (respuesta) {
            estadoCrud = 'nuevo';
            $('#modal-default-title').html('Nuevo Permiso');
            $('#modal-default-body').html(respuesta)
            $('#modal-default').modal('show')
        }
    });
}

function guardarPermiso()
{
    var form = $('#form-permiso'),
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
                    title: 'Permisos',
                    text: respuesta.mensaje,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        cambiarVista('permisos')
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

function editarPermiso(permiso)
{
    $.ajax({
        url:'permisos/'+permiso+'/edit',
        dataType:'html',
        success: function(respuesta){
            estadoCrud = 'editar';
            $('#modal-default-title').html('Nuevo Permiso');
            $('#modal-default-body').html(respuesta)
            $('#modal-default').modal('show')
        }
    })
}

function eliminarPermiso(permiso) {

    Swal.fire({
        title: 'Eliminar Permiso',
        text: '¿Seguro de Eliminar El Registro? No podrá revertirlo',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText:"<i class='fas fa-trash-alt'></i> A Papelera",
        confirmButtonColor:"#6610f2",
        cancelButtonText:"<i class='fas fa-eraser'></i> Permanentemente",
        cancelButtonColor:"#e3342f"
    }).then((respuesta) => {
        if(respuesta.value) {
            eliminarTemporalPermiso(permiso)
        }
        else if( respuesta.dismiss === swal.DismissReason.cancel) {
            this.eliminarPermanentePermiso(permiso)
        }
    })
}

function eliminarTemporalPermiso(permiso)
{
    $.ajax({
        url:'permisos-delete/'+permiso,
        method:'POST',
        data:{
            _token:csrf_token
        },
        success: function(respuesta){
            if(respuesta.ok ==1)
            {

                Swal.fire({
                    title: 'Permisos',
                    text: respuesta.mensaje,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        cambiarVista('permisos')
                    }
                })
            }
        }
    })
}

function eliminarPermanentePermiso(permiso)
{
    $.ajax({
        url:'permisos/'+permiso,
        method:'DELETE',
        data:{
            _token:csrf_token
        },
        success: function(respuesta){
            if(respuesta.ok ==1)
            {

                Swal.fire({
                    title: 'Permisos',
                    text: respuesta.mensaje,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        cambiarVista('permisos')
                    }
                })
            }
        }
    })
}

function restaurarPermiso(permiso)
{
    swal.fire({
        title:"Permisos",
        text:'¿Está Seguro de Restaurar el Permiso?"',
        icon:"question",
        showCancelButton: true,
        confirmButtonText:"Si",
        confirmButtonColor:"#28a745",
        cancelButtonText:"No",
        cancelButtonColor:"#dc3545"
    }).then( (response) => {
        if(response.value) {

            $.ajax({
                url:'permisos-restaurar',
                method:'POST',
                data:{
                    id: permiso,
                    _token:csrf_token
                },
                success: function(respuesta){
                    if(respuesta.ok ==1)
                    {

                        Swal.fire({
                            title: 'Permisos',
                            text: respuesta.mensaje,
                            icon: 'success',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                cambiarVista('permisos')
                            }
                        })
                    }
                }
            })
        }
    })
}
