let estadoCrud =''
let csrf_token = $('meta[name="csrf-token"]').attr('content');
let filtro = 'habilitados'
window.tituloVista ='Cargos';



function cambiarVista(vista)
{
    window.tituloVista = vista
    $.ajax({
        url: vista,
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

$(function() {
    $.ajax({
        url: 'areas?buscar=',
        type:"GET",
        success: function (respuesta) {
            $('#tab-content').html(respuesta)
        }
    });
})
