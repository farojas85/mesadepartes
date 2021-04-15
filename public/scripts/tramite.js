let estadoCrud =''

$(function () {

    bsCustomFileInput.init();

    $('#archivo').val('');

    $('.select2').select2({
        placeholder: 'Seleccionar Tipo'
    })

    $('#fechahorapicker').datetimepicker({
        icons: { time: 'far fa-clock' },
        useCurrent:true,
        locale:'es',
        format: 'YYYY-MM-DD HH:mm:ss'
    })

})

function limpiar()
{
    $('#form-tramite')[0].reset()
    $('#fecha_hora').val('')
    $("select#documento_tramite_id").prop('selectedIndex', 0);
    $("#tipo_tramite_id").empty();
    $('#asunto').val('')
    $('#numero_folios').val('1')
    $('#archivo').val('')
}
function nuevoTramite()
{
    limpiar()

    obtenerDocumentoTramite()

    $('#modal-tramite-title').html('Nuevo Trámite');
    $('#modal-tramite').modal('show')
}

function obtenerDocumentoTramite()
{
    $.ajax({
        url:'documento-tramites-listar',
        type:"GET",
        success: function (respuesta) {
            let documentoTramite = respuesta
            documentoTramite.forEach(documento => {
                $('#documento_tramite_id').append($('<option>',{
                    value:documento.id,
                    text:documento.nombre
                }))
            });
        }
    });
}


function obtenerTipoTramiteLista(documentoTramite)
{
    //documentoTramite = $('#documento_tramite_id').val();
    //console.log(documentoTramite)

    $('#tipo_tramite_id').empty();

    $.ajax({
        url:'tipo-tramite-listar',
        data:{documento_tramite_id: documentoTramite},
        type:"GET",
        success: function (respuesta) {
            let tipotramite = respuesta
            $('#tipo_tramite_id').append($('<option>',{
                value:'',
                text:'-Seleccionar Tipo'
            }))
            tipotramite.forEach(tipo => {
                $('#tipo_tramite_id').append($('<option>',{
                    value:tipo.id,
                    text:tipo.nombre
                }))
            });
        }
    });
}


function eliminarClaseInvalid()
{
    $('.error-mensaje').remove()
    $('#fecha_hora').removeClass('is-invalid');
    $('#archivo').removeClass('is-invalid');
    $('#documento_tramite_id').removeClass('is-invalid');
    $('#tipo_tramite_id').removeClass('is-invalid');
    $('#asunto').removeClass('is-invalid');
    $('#numero_folios').removeClass('is-invalid');
}

function guardarTramite(event)
{
    event.preventDefault();

    var form = $('#form-tramite'),
            url = form.attr('action'),
            method =form.attr('method');

    var datos  = new FormData()

    datos.append('archivo' ,$('#archivo')[0].files[0])

    $.ajax({
        url : url+'?'+form.serialize(),
        method: method,
        data :datos,
        processData: false,
        contentType: false,
        success: function (respuesta) {
            //console.log(respuesta)
            if(respuesta.ok ==1)
            {
                eliminarClaseInvalid()
                $('#modal-tramite').modal('hide')

                Swal.fire({
                    title: 'Tramites',
                    text: respuesta.mensaje,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href='tramite'
                    }
                })
            }
            else if(respuesta.ok == 0)
            {
                eliminarClaseInvalid()
                $('#modal-tramite').modal('hide')
                Swal.fire({
                    title: 'Tramites',
                    text: respuesta.mensaje,
                    icon: 'warning',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href='tramite'
                    }
                })
            }
        },
        error : function (xhr) {
            var res = xhr.responseJSON;
            //console.clear()
            eliminarClaseInvalid()

            if ($.isEmptyObject(res) == false) {
                $.each(res.errors, function (key, value) {
                    $('#' + key).addClass('is-invalid')
                        .closest('.mensaje-error')
                        .append('<small class="text-danger error-mensaje">' + value + '</small>');
                });
            }
        }
    })
}
