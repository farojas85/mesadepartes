function generarPermisoRole()
{
    role = $('#role_id').val()
    modelo = $('#modelo_id').val()
    $.ajax({
        url: 'permiso-role-obtener-permiso-role?role='+role+'&modelo='+modelo,
        type:"GET",
        success: function (respuesta) {
            $('#detalle-permisos').html(respuesta)
        }
    });
}

function guardarPermisoRole()
{
    var form = $('#form-permiso-role'),
                url = form.attr('action'),
                method =form.attr('method');

    $.ajax({
        url : url,
        method: method,
        data : form.serialize(),
        success: function (respuesta) {
            if(respuesta.ok ==1)
            {
                Swal.fire({
                    title: 'Permiso / Role',
                    text: respuesta.mensaje,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        cambiarVista('permiso-role')
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
