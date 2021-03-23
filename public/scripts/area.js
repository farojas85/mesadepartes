function cambiarPaginaArea(pagina)
{
    $.ajax({
        //busqueda=
        url: 'areas-'+filtro+'?page='+pagina,
        type:"GET",
        success: function (respuesta) {
            $('#detalle-tabla').html(respuesta)
        }
    });
}

function mostrarFiltroArea(filtro)
{
    switch(filtro)
    {
        case 'todos':mostrarAreasTodos();break;
        case 'habilitados':mostrarAreasHabilitados();break;
        case 'eliminados': mostrarAreasEliminados();break;
    }
}

function buscarArea(buscar)
{
    switch(filtro)
    {
        case 'habilitados':mostrarAreasHabilitados(buscar);break;
        case 'todos':mostrarAreasTodos(buscar);break;
        case 'eliminados': mostrarAreasEliminados(buscar);break;
    }
}

function mostrarAreasTodos(buscar)
{
    buscar = (!buscar) ? '' : buscar
    $.ajax({
        url: 'areas-todos?buscar='+buscar,
        type:"GET",
        success: function (respuesta) {
            filtro = 'todos'
            $('#detalle-tabla').html(respuesta)
        }
    });
}

function mostrarAreasHabilitados(buscar)
{
    buscar = (!buscar) ? '' : buscar
    $.ajax({
        url: 'areas-habilitados?buscar='+buscar,
        type:"GET",
        success: function (respuesta) {
            filtro = 'habilitados'
            $('#detalle-tabla').html(respuesta)
        }
    });
}

function mostrarAreasEliminados(buscar)
{
    buscar = (!buscar) ? '' : buscar
    $.ajax({
        url: 'areas-eliminados?buscar='+buscar,
        type:"GET",
        success: function (respuesta) {
            filtro = 'eliminados'
            $('#detalle-tabla').html(respuesta)
        }
    });
}

function nuevoArea()
{
    $.ajax({
        url:'areas/create',
        type:"GET",
        success: function (respuesta) {
            estadoCrud = 'nuevo';
            $('#modal-default-title').html('Nueva Área');
            $('#modal-default-body').html(respuesta)
            $('#modal-default').modal('show')
        }
    });
}

function guardarArea()
{
    var form = $('#form-area'),
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
                    title: 'Áreas',
                    text: respuesta.mensaje,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        cambiarVista('areas')
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

function editarArea(area)
{
    $.ajax({
        url:'areas/'+area+'/edit',
        dataType:'html',
        success: function(respuesta){
            estadoCrud = 'editar';
            $('#modal-default-title').html('Nueva Área');
            $('#modal-default-body').html(respuesta)
            $('#modal-default').modal('show')
        }
    })
}

function eliminarArea(area)
{
    Swal.fire({
        title: 'Eliminar Área',
        text: '¿Seguro de Eliminar El Registro? No podrá revertirlo',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText:"<i class='fas fa-trash-alt'></i> A Papelera",
        confirmButtonColor:"#6610f2",
        cancelButtonText:"<i class='fas fa-eraser'></i> Permanentemente",
        cancelButtonColor:"#e3342f"
    }).then((respuesta) => {
        if(respuesta.value) {
            eliminarTemporalArea(area)
        }
        else if( respuesta.dismiss === swal.DismissReason.cancel) {
            this.eliminarPermanenteArea(area)
        }
    })
}

function eliminarTemporalArea(area)
{
    $.ajax({
        url:'areas-delete/'+area,
        method:'POST',
        data:{
            _token:csrf_token
        },
        success: function(respuesta){
            if(respuesta.ok ==1)
            {

                Swal.fire({
                    title: 'Áreas',
                    text: respuesta.mensaje,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        cambiarVista('areas')
                    }
                })
            }
        }
    })
}

function eliminarPermanenteArea(area)
{
    $.ajax({
        url:'areas/'+area,
        method:'DELETE',
        data:{
            _token:csrf_token
        },
        success: function(respuesta){
            if(respuesta.ok ==1)
            {

                Swal.fire({
                    title: 'Áreas',
                    text: respuesta.mensaje,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        cambiarVista('areas')
                    }
                })
            }
        }
    })
}


function restaurarArea(area)
{
    swal.fire({
        title:"Áreas",
        text:'¿Está Seguro de Restaurar Área?"',
        icon:"question",
        showCancelButton: true,
        confirmButtonText:"Si",
        confirmButtonColor:"#28a745",
        cancelButtonText:"No",
        cancelButtonColor:"#dc3545"
    }).then( (response) => {
        if(response.value) {

            $.ajax({
                url:'areas-restaurar',
                method:'POST',
                data:{
                    id: area,
                    _token:csrf_token
                },
                success: function(respuesta){
                    if(respuesta.ok ==1)
                    {

                        Swal.fire({
                            title: 'Áreas',
                            text: respuesta.mensaje,
                            icon: 'success',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                cambiarVista('areas')
                            }
                        })
                    }
                }
            })
        }
    })
}
