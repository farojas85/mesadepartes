function cambiarPaginaMenu(pagina)
{
    paginas = pagina
    $.ajax({
        //busqueda=
        url: 'menus-todos'+'?page='+paginas+'&paginacion='+paginacion,
        type:"GET",
        success: function (respuesta) {
            $('#detalle-tabla').html(respuesta)
        }
    });
}

function cambiarPaginacionMenu()
{
    paginacion = $('#menu-paginacion').val()
    $.ajax({
        //busqueda=
        url: 'menus-todos'+'?page='+paginas+'&paginacion='+paginacion,
        type:"GET",
        success: function (respuesta) {
            $('#detalle-tabla').html(respuesta)
        }
    });
}

function mostrarFiltroMenu(filtro)
{
    switch(filtro)
    {
        case 'todos':mostrarMenusTodos();break;
        case 'habilitados':mostrarMenusHabilitados();break;
        case 'eliminados': mostrarMenusEliminados();break;
    }
}

function buscarMenu(buscar)
{
    switch(filtro)
    {
        case 'habilitados':mostrarMenusHabilitados(buscar);break;
        case 'todos': mostrarMenusTodos(buscar);break;
        case 'eliminados':mostrarMenusEliminados(buscar);break;
    }
}

function mostrarMenusTodos(buscar)
{
    buscar = (!buscar) ? '' : buscar
    $.ajax({
        url: 'menus-todos?buscar='+buscar,
        type:"GET",
        success: function (respuesta) {
            filtro = 'todos'
            $('#detalle-tabla').html(respuesta)
        }
    });
}

function mostrarMenusHabilitados(buscar)
{
    buscar = (!buscar) ? '' : buscar
    $.ajax({
        url: 'menus-habilitados?buscar='+buscar,
        type:"GET",
        success: function (respuesta) {
            filtro = 'habilitados'
            $('#detalle-tabla').html(respuesta)
        }
    });
}

function mostrarMenusEliminados(buscar)
{
    buscar = (!buscar) ? '' : buscar

    $.ajax({
        url: 'menus-eliminados?buscar='+buscar,
        type:"GET",
        success: function (respuesta) {
            filtro = 'eliminados'
            $('#detalle-tabla').html(respuesta)
        }
    });
}

// FUNCIONES PARA MODELO PERMISO
function nuevoMenu()
{
    $.ajax({
        url:'menus/create',
        type:"GET",
        success: function (respuesta) {
            estadoCrud = 'nuevo';
            $('#modal-default-title').html('Nuevo Menú');
            $('#modal-default-body').html(respuesta)
            $('#modal-default').modal('show')
        }
    });
}

function guardarMenu()
{
    var form = $('#form-menu'),
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
                    title: 'Menús',
                    text: respuesta.mensaje,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        cambiarVista('menus')
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

function editarMenu(menu)
{
    $.ajax({
        url:'menus/'+menu+'/edit',
        dataType:'html',
        success: function(respuesta){
            estadoCrud = 'editar';
            $('#modal-default-title').html('Nuevo Menú');
            $('#modal-default-body').html(respuesta)
            $('#modal-default').modal('show')
        }
    })
}

function eliminarMenu(menu) {

    Swal.fire({
        title: 'Desactivar Menú',
        text: '¿Seguro que desea desactivar el Menú?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText:"<i class='fas fa-check'></i> Sí",
        confirmButtonColor:"#6610f2",
        cancelButtonText:"<i class='fas fa-times'></i> No",
        cancelButtonColor:"#e3342f"
    }).then((respuesta) => {
        if(respuesta.value) {
            $.ajax({
                url:'menus/'+menu,
                method:'DELETE',
                data:{
                    _token:csrf_token
                },
                success: function(respuesta){
                    if(respuesta.ok ==1)
                    {
                        Swal.fire({
                            title: 'Menús',
                            text: respuesta.mensaje,
                            icon: 'success',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                cambiarVista('menus')
                                //windows.location.href='sistema'
                            }
                        })
                    }
                }
            })
        }
        else if( respuesta.dismiss === swal.DismissReason.cancel) {

        }
    })
}

function restaurarMenu(menu)
{
    swal.fire({
        title:"Menús",
        text:'¿Está Seguro de Activar el Menú?"',
        icon:"question",
        showCancelButton: true,
        confirmButtonText:"<i class='fas fa-check'></i> Si",
        confirmButtonColor:"#28a745",
        cancelButtonText:"<i class='fas fa-times'></i> No",
        cancelButtonColor:"#dc3545"
    }).then( (response) => {
        if(response.value) {

            $.ajax({
                url:'menus-restaurar',
                method:'POST',
                data:{
                    id: menu,
                    _token:csrf_token
                },
                success: function(respuesta){
                    if(respuesta.ok ==1)
                    {
                        Swal.fire({
                            title: 'Menús',
                            text: respuesta.mensaje,
                            icon: 'success',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                cambiarVista('menus')
                                //windows.location.href='sistema'
                            }
                        })
                    }
                }
            })
        }
    })
}
