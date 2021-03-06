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
