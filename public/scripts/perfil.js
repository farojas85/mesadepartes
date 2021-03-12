function mdlSubirFoto(usuario)
{
    $.ajax({
        url:'usuarios-subir-foto?id='+usuario,
        type:"GET",
        success: function (respuesta) {
            $('#modal-default-title').html('Modificar Imagen');
            $('#modal-default-body').html(respuesta)
            $('#modal-default').modal('show')
        }
    });
}

function guardarFoto(event)
{
    event.preventDefault();

    var form = $('#form-guardar-foto'),
                url = form.attr('action'),
                method =form.attr('method');


    var foto =

    console.log(foto)

    var datos  = new FormData()

    datos.append('foto' ,$('#foto')[0].files[0])

    $.ajax({
        url : url+'?'+form.serialize(),
        method: method,
        data :datos,
        processData: false,
        contentType: false,
        success: function (respuesta) {
            //eliminarClaseInvalidPassword()

            if(respuesta.ok ==1)
            {
                $('.error-mensaje').remove()
                $('#modal-default').modal('hide')

                Swal.fire({
                    title: 'Usuarios',
                    text: respuesta.mensaje,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href='usuarios-perfil'
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
                        .closest('.col-md-12')
                        .append('<small class="text-danger error-mensaje">' + value + '</small>');
                });
            }
        }
    })
}

function mdlMostrarDatoPersonal(usuario)
{
    $.ajax({
        url:'perfil-mostrar-dato-personal?id='+usuario,
        dataType:'html',
        success: function(respuesta){
           $('#dato-personal').html(respuesta)
        }
    })
}

function mdlMostrarDatoUsuario(usuario)
{
    $.ajax({
        url:'perfil-mostrar-dato-usuario?id='+usuario,
        dataType:'html',
        success: function(respuesta){
           $('#dato-usuario').html(respuesta)
        }
    })
}

function mdlEditarDatoPersonal(usuario)
{
    $.ajax({
        url:'perfil-editar-dato-personal?id='+usuario,
        dataType:'html',
        success: function(respuesta){
           $('#dato-personal').html(respuesta)
        }
    })
}

function mdlEditarDatoUsuario(usuario)
{
    $.ajax({
        url:'perfil-editar-dato-usuario?id='+usuario,
        dataType:'html',
        success: function(respuesta){
           $('#dato-usuario').html(respuesta)
        }
    })
}

function modificarDatoPersonal(event)
{
    event.preventDefault();

    var form = $('#form-editar-dato-personal'),
                url = form.attr('action'),
                method =form.attr('method');


    $.ajax({
        url : url,
        method: method,
        data :form.serialize(),
        success: function (respuesta) {
            if(respuesta.ok ==1)
            {
                Swal.fire({
                    title: 'Perfil Usuarios',
                    text: respuesta.mensaje,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        mdlMostrarDatoPersonal(respuesta.usuario.id)
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

function modificarDatoUsuario(event)
{
    event.preventDefault();

    var form = $('#form-editar-dato-usuario'),
                url = form.attr('action'),
                method =form.attr('method');


    $.ajax({
        url : url,
        method: method,
        data :form.serialize(),
        success: function (respuesta) {
            if(respuesta.ok ==1)
            {
                Swal.fire({
                    title: 'Perfil Usuarios',
                    text: respuesta.mensaje,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        mdlMostrarDatoUsuario(respuesta.usuario.id)
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

function mdlCambiarContrasena(usuario)
{
    $.ajax({
        url:'usuarios-modificar-contrasena?id='+usuario,
        type:"GET",
        success: function (respuesta) {
            $('#modal-default-title').html('Nuevo Usuario');
            $('#modal-default-body').html(respuesta)
            $('#modal-default').modal('show')
        }
    });
}

function eliminarClaseInvalidPassword()
{
    $('.error-mensaje').remove()
    $('#password').removeClass('is-invalid');
    $('#password_confirmation').removeClass('is-invalid');
}

function guardarContrasena(event)
{

    event.preventDefault();

    var form = $('#form-cambiar-contrasena'),
                url = form.attr('action'),
                method =form.attr('method');


    $.ajax({
        url : url,
        method: method,
        data :form.serialize(),
        success: function (respuesta) {
            eliminarClaseInvalidPassword()

            if(respuesta.ok ==1)
            {
                $('#modal-default').modal('hide')

                Swal.fire({
                    title: 'Usuarios',
                    text: respuesta.mensaje,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
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
                        .closest('.col-md-7')
                        .append('<small class="text-danger error-mensaje">' + value + '</small>');
                });
            }
        }
    })
}
