let estadoCrud =''
let csrf_token = $('meta[name="csrf-token"]').attr('content');
let filtro = 'habilitados'
let paginacion = 5
let paginas = 1
window.tituloVista ='Cargos';



function cambiarVista(vista)
{
    window.tituloVista = vista
    $.ajax({
        url: vista+'?paginacion='+paginacion,
        type:"GET",
        success: function (respuesta) {
            $('#tab-content').html(respuesta)
            filtro = 'habilitados'
        }
    });
}

var script2= document.createElement('script')

script2.src='scripts/area.js'

document.head.appendChild(script2)

var script= document.createElement('script')

script.src='scripts/cargo.js'

document.head.appendChild(script)

var script2= document.createElement('script')

script2.src='scripts/tipodocumento.js'

document.head.appendChild(script2)

var script2= document.createElement('script')

script2.src='scripts/documento_tramite.js'

document.head.appendChild(script2)

var script2= document.createElement('script')

script2.src='scripts/tipotramite.js'

document.head.appendChild(script2)

$(function() {
    $.ajax({
        url: 'areas?buscar=',
        type:"GET",
        success: function (respuesta) {
            $('#tab-content').html(respuesta)
        }
    });
})
