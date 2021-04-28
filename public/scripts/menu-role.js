function generarMenuRole()
{
    role = $('#role_id').val()

    $.ajax({
        url: 'menu-role-obtener-menu-role?role='+role,
        type:"GET",
        success: function (respuesta) {
            $('#detalle-menus').html(respuesta)
        }
    });
}

function guardarMenuRole()
{
    var form = $('#form-menu-role'),
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
                    title: 'Menú / Role',
                    text: respuesta.mensaje,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        cambiarVista('menu-role')
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
