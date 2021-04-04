$(function () {

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

// DropzoneJS Demo Code Start
Dropzone.autoDiscover = false

// Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
var previewNode = document.querySelector("#template")
previewNode.id = ""
var previewTemplate = previewNode.parentNode.innerHTML
previewNode.parentNode.removeChild(previewNode)

var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "/target-url", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
})



myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
})

// Update the total progress bar
myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
})

myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1"
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
})

// Hide the total progress bar when nothing's uploading anymore
myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0"
})

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
}
document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true)
}

let estadoCrud =''

function limpiar()
{
    $('#fecha_hora').val('')
    $("select#documento_tramite_id").prop('selectedIndex', 0);
    $("#tipo_tramite_id").empty();
    $('#asunto').val('')
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
