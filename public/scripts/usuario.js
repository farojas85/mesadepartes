
function nuevoUsuario()
{
    $.ajax({
        url:'usuarios/create',
        type:"GET",
        success: function (respuesta) {
            estadoCrud = 'nuevo';
            $('#modal-xl-title').html('Nuevo Usuario');
            $('#modal-xl-body').html(respuesta)
            $('#modal-xl').modal('show')
        }
    });
}

function cambiarPaginaUsuario(pagina)
{
    $.ajax({
        //busqueda=
        url: 'usuarios-'+filtro+'?page='+pagina,
        type:"GET",
        success: function (respuesta) {
            $('#detalle-tabla').html(respuesta)
        }
    });
}
function mostrarFiltroUsuario(filtro)
{
    switch(filtro)
    {
        case 'todos':mostrarUsuariosTodos();break;
        case 'habilitados':mostrarUsuariosHabilitados();break;
        case 'eliminados': mostrarUsuariosEliminados();break;
    }
}

function mostrarUsuariosTodos(buscar)
{
    buscar = (!buscar) ? '' : buscar
    $.ajax({
        url: 'usuarios-todos?buscar='+buscar,
        type:"GET",
        success: function (respuesta) {
            filtro = 'todos'
            $('#detalle-tabla').html(respuesta)
        }
    });
}

function mostrarUsuariosHabilitados(buscar)
{
    buscar = (!buscar) ? '' : buscar
    $.ajax({
        url: 'usuarios-habilitados?buscar='+buscar,
        type:"GET",
        success: function (respuesta) {
            filtro = 'habilitados'
            $('#detalle-tabla').html(respuesta)
        }
    });
}

function mostrarUsuariosEliminados(buscar)
{
    buscar = (!buscar) ? '' : buscar

    $.ajax({
        url: 'usuarios-eliminados?buscar='+buscar,
        type:"GET",
        success: function (respuesta) {
            filtro = 'eliminados'
            $('#detalle-tabla').html(respuesta)
        }
    });
}

function buscarUsuario(buscar)
{
    switch(filtro)
    {
        case 'habilitados':mostrarUsuariosHabilitados(buscar);break;
        case 'todos': mostrarUsuariosTodos(buscar);break;
        case 'eliminados':mostrarUsuariosEliminados(buscar);break;
    }
}

function verificarNumeroDoumento()
{
    tipo_documento_id = $('#tipo_documento_id').val()
    numero_documento = $('#numero_documento').val()

    if(numero_documento.length==0)
    {
        $('#nombres').val('')
        $('#apellido_paterno').val('')
        $('#apellido_materno').val('')
    }
    else {
        $.ajax({
            url:'usuario-verificar-documento',
            data:{
                tipo_documento_id : tipo_documento_id,
                numero_documento : numero_documento
            },
            type:"GET",
            success: function (respuesta) {
               console.log(respuesta)
               $('.error-mensaje').remove()
               $('#numero_documento').removeClass('is-invalid')
               $('#nombres').val('')
               $('#apellido_paterno').val('')
               $('#apellido_materno').val('')
               let persona = respuesta.persona
               if(persona) {
                   if(tipo_documento_id == 1)  {
                       $('#nombres').val(persona.nombres)
                       $('#apellido_paterno').val(persona.apellidoPaterno)
                       $('#apellido_materno').val(persona.apellidoMaterno)
                   }
               }
               $('#usuario_codigo').val($('#numero_documento').val())
            },
            error : function (xhr) {
                var res = xhr.responseJSON;
                console.clear()
                $('.error-mensaje').remove()

                if ($.isEmptyObject(res) == false) {
                    $.each(res.errors, function (key, value) {
                        $('#' + key).addClass('is-invalid')
                            .closest('.col-md-9')
                            .append('<small class="text-danger error-mensaje">' + value + '</small>');
                    });
                }
            }
        });
    }
}

function eliminarClaseInvalidUsuario()
{
    $('.error-mensaje').remove()
    $('#tipo_documento_id').removeClass('is-invalid');
    $('#numero_documento').removeClass('is-invalid');
    $('#nombres').removeClass('is-invalid');
    $('#apellido_paterno').removeClass('is-invalid');
    $('#apellido_materno').removeClass('is-invalid');
    $('#usuario_codigo').removeClass('is-invalid');
    $('#password').removeClass('is-invalid');
    $('#cargo_id').removeClass('is-invalid');
    $('#role_id').removeClass('is-invalid');
}

function guardarUsuario(event)
{
    event.preventDefault();

    var form = $('#form-usuario'),
                url = form.attr('action'),
                method =form.attr('method');


    $.ajax({
        url : url,
        method: method,
        data :form.serialize(),
        success: function (respuesta) {
            eliminarClaseInvalidUsuario()
           // console.log(respuesta)
            if(respuesta.ok ==1)
            {
                $('#modal-xl').modal('hide')

                Swal.fire({
                    title: 'Usuarios',
                    text: respuesta.mensaje,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        cambiarVista('usuarios')
                    }
                })
            }
        },
        error : function (xhr) {
            var res = xhr.responseJSON;
            console.clear()
            $('.error-mensaje').remove()
            if ($.isEmptyObject(res) == false) {
                $.each(res.errors, function (key, value) {
                    $('#' + key).addClass('is-invalid')
                        .closest('.col-md-9')
                        .append('<small class="text-danger error-mensaje">' + value + '</small>');
                });
            }
        }
    })
}