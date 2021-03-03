function cambiarPaginaRole(pagina)
{
    $.ajax({
        //busqueda=
        url: 'roles-'+filtro+'?page='+pagina,
        type:"GET",
        success: function (respuesta) {
            $('#detalle-tabla').html(respuesta)
        }
    });
}
function mostrarFiltroRole(filtro)
{
    switch(filtro)
    {
        case 'todos':mostrarRolesTodos();break;
        case 'habilitados':mostrarRolesHabilitados();break;
        case 'eliminados': mostrarRolesEliminados();break;
    }
}

function buscarRole(buscar)
{
    switch(filtro)
    {
        case 'habilitados':mostrarRolesHabilitados(buscar);break;
        case 'todos': mostrarRolesTodos(buscar);break;
        case 'eliminados':mostrarRolesEliminados(buscar);break;
    }
}

function mostrarRolesTodos(buscar)
{
    buscar = (!buscar) ? '' : buscar
    $.ajax({
        url: 'roles-todos?buscar='+buscar,
        type:"GET",
        success: function (respuesta) {
            filtro = 'todos'
            $('#detalle-tabla').html(respuesta)
        }
    });
}

function mostrarRolesHabilitados(buscar)
{
    buscar = (!buscar) ? '' : buscar
    $.ajax({
        url: 'roles-habilitados?buscar='+buscar,
        type:"GET",
        success: function (respuesta) {
            filtro = 'habilitados'
            $('#detalle-tabla').html(respuesta)
        }
    });
}

function mostrarRolesEliminados(buscar)
{
    buscar = (!buscar) ? '' : buscar

    $.ajax({
        url: 'roles-eliminados?buscar='+buscar,
        type:"GET",
        success: function (respuesta) {
            filtro = 'eliminados'
            $('#detalle-tabla').html(respuesta)
        }
    });
}
// FUNCIONES PARA MODELO ROLE
function nuevoRol()
{
    $.ajax({
        url:'roles/create',
        type:"GET",
        success: function (respuesta) {
            estadoCrud = 'nuevo';
            $('#modal-default-title').html('Nuevo Rol');
            $('#modal-default-body').html(respuesta)
            $('#modal-default').modal('show')
        }
    });
}

function guardarRol()
{
    var form = $('#form-role'),
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
                    title: 'Roles',
                    text: respuesta.mensaje,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        cambiarVista('roles')
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

function editarRole(role)
{
    $.ajax({
        url:'roles/'+role+'/edit',
        dataType:'html',
        success: function(respuesta){
            estadoCrud = 'editar';
            $('#modal-default-title').html('Nuevo Rol');
            $('#modal-default-body').html(respuesta)
            $('#modal-default').modal('show')
        }
    })
}

function eliminarRole(role) {

    Swal.fire({
        title: 'Eliminar Rol',
        text: '¿Seguro de Eliminar El Registro? No podrá revertirlo',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText:"<i class='fas fa-trash-alt'></i> A Papelera",
        confirmButtonColor:"#6610f2",
        cancelButtonText:"<i class='fas fa-eraser'></i> Permanentemente",
        cancelButtonColor:"#e3342f"
    }).then((respuesta) => {
        if(respuesta.value) {
            eliminarTemporalRole(role)
        }
        else if( respuesta.dismiss === swal.DismissReason.cancel) {
            this.eliminarPermanenteRole(role)
        }
    })
}

function eliminarTemporalRole(role)
{
    $.ajax({
        url:'roles-delete/'+role,
        method:'POST',
        data:{
            _token:csrf_token
        },
        success: function(respuesta){
            if(respuesta.ok ==1)
            {

                Swal.fire({
                    title: 'Roles',
                    text: respuesta.mensaje,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        cambiarVista('roles')
                    }
                })
            }
        }
    })
}

function eliminarPermanenteRole(role)
{
    $.ajax({
        url:'roles/'+role,
        method:'DELETE',
        data:{
            _token:csrf_token
        },
        success: function(respuesta){
            if(respuesta.ok ==1)
            {

                Swal.fire({
                    title: 'Roles',
                    text: respuesta.mensaje,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        cambiarVista('roles')
                    }
                })
            }
        }
    })
}

function restaurarRole(role)
{
    swal.fire({
        title:"Roles",
        text:'¿Está Seguro de Restaurar el Rol?"',
        icon:"question",
        showCancelButton: true,
        confirmButtonText:"Si",
        confirmButtonColor:"#28a745",
        cancelButtonText:"No",
        cancelButtonColor:"#dc3545"
    }).then( (response) => {
        if(response.value) {

            $.ajax({
                url:'roles-restaurar',
                method:'POST',
                data:{
                    id: role,
                    _token:csrf_token
                },
                success: function(respuesta){
                    if(respuesta.ok ==1)
                    {

                        Swal.fire({
                            title: 'Roles',
                            text: respuesta.mensaje,
                            icon: 'success',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                cambiarVista('roles')
                            }
                        })
                    }
                }
            })
        }
    })
}
