function cambiarPaginaCargo(pagina)
{
    paginas = pagina
    $.ajax({
        //busqueda=
        url: 'cargos-todos'+'?page='+paginas+'&paginacion='+paginacion,
        type:"GET",
        success: function (respuesta) {
            $('#detalle-tabla').html(respuesta)
        }
    });
}

function cambiarPaginacionCargo()
{
    paginacion = $('#cargo-paginacion').val()
    $.ajax({
        //busqueda=
        url: 'cargos-todos'+'?page='+paginas+'&paginacion='+paginacion,
        type:"GET",
        success: function (respuesta) {
            $('#detalle-tabla').html(respuesta)
        }
    });
}

function mostrarFiltroCargo(filtro)
{
    switch(filtro)
    {
        case 'todos':mostrarCargosTodos();break;
        case 'habilitados':mostrarCargosHabilitados();break;
        case 'eliminados': mostrarCargosEliminados();break;
    }
}

function buscarCargo(buscar)
{
    //smostrarCargosTodos(buscar)
    switch(filtro)
    {
        case 'habilitados':mostrarCargosHabilitados(buscar);break;
        case 'todos':mostrarCargosTodos(buscar);break;
        case 'eliminados': mostrarCargosEliminados(buscar);break;
    }
}

function mostrarCargosTodos(buscar)
{
    buscar = (!buscar) ? '' : buscar
    $.ajax({
        url: 'cargos-todos?buscar='+buscar,
        type:"GET",
        success: function (respuesta) {
            filtro = 'todos'
            $('#detalle-tabla').html(respuesta)
        }
    });
}

function mostrarCargosHabilitados(buscar)
{
    buscar = (!buscar) ? '' : buscar
    $.ajax({
        url: 'cargos-habilitados?buscar='+buscar,
        type:"GET",
        success: function (respuesta) {
            filtro = 'habilitados'
            $('#detalle-tabla').html(respuesta)
        }
    });
}

function mostrarCargosEliminados(buscar)
{
    buscar = (!buscar) ? '' : buscar
    $.ajax({
        url: 'cargos-eliminados?buscar='+buscar,
        type:"GET",
        success: function (respuesta) {
            filtro = 'eliminados'
            $('#detalle-tabla').html(respuesta)
        }
    });
}

function nuevoCargo()
{
    $.ajax({
        url:'cargos/create',
        type:"GET",
        success: function (respuesta) {
            estadoCrud = 'nuevo';
            $('#modal-default-title').html('Nuevo Cargo');
            $('#modal-default-body').html(respuesta)
            $('#modal-default').modal('show')
        }
    });
}

function guardarCargo()
{
    var form = $('#form-cargo'),
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
                    title: 'Cargos',
                    text: respuesta.mensaje,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        cambiarVista('cargos')
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

function editarCargo(cargo)
{
    $.ajax({
        url:'cargos/'+cargo+'/edit',
        dataType:'html',
        success: function(respuesta){
            estadoCrud = 'editar';
            $('#modal-default-title').html('Nuevo Cargo');
            $('#modal-default-body').html(respuesta)
            $('#modal-default').modal('show')
        }
    })
}

function eliminarCargo(cargo) {

    Swal.fire({
        title: 'Eliminar Cargo',
        text: '¿Seguro de Eliminar El Registro? No podrá revertirlo',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText:"<i class='fas fa-trash-alt'></i> A Papelera",
        confirmButtonColor:"#6610f2",
        cancelButtonText:"<i class='fas fa-eraser'></i> Permanentemente",
        cancelButtonColor:"#e3342f"
    }).then((respuesta) => {
        if(respuesta.value) {
            eliminarTemporalCargo(cargo)
        }
        else if( respuesta.dismiss === swal.DismissReason.cancel) {
            this.eliminarPermanenteCargo(cargo)
        }
    })
}

function eliminarTemporalCargo(cargo)
{
    $.ajax({
        url:'cargos-delete/'+cargo,
        method:'POST',
        data:{
            _token:csrf_token
        },
        success: function(respuesta){
            if(respuesta.ok ==1)
            {

                Swal.fire({
                    title: 'Cargos',
                    text: respuesta.mensaje,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        cambiarVista('cargos')
                    }
                })
            }
        }
    })
}

function eliminarPermanenteCargo(cargo)
{
    $.ajax({
        url:'cargos/'+cargo,
        method:'DELETE',
        data:{
            _token:csrf_token
        },
        success: function(respuesta){
            if(respuesta.ok ==1)
            {

                Swal.fire({
                    title: 'Cargos',
                    text: respuesta.mensaje,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        cambiarVista('cargos')
                    }
                })
            }
        }
    })
}

function restaurarCargo(cargo)
{
    swal.fire({
        title:"Cargos",
        text:'¿Está Seguro de Restaurar el Cargo?"',
        icon:"question",
        showCancelButton: true,
        confirmButtonText:"Si",
        confirmButtonColor:"#28a745",
        cancelButtonText:"No",
        cancelButtonColor:"#dc3545"
    }).then( (response) => {
        if(response.value) {

            $.ajax({
                url:'cargos-restaurar',
                method:'POST',
                data:{
                    id: cargo,
                    _token:csrf_token
                },
                success: function(respuesta){
                    if(respuesta.ok ==1)
                    {

                        Swal.fire({
                            title: 'Cargos',
                            text: respuesta.mensaje,
                            icon: 'success',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                cambiarVista('cargos')
                            }
                        })
                    }
                }
            })
        }
    })
}


