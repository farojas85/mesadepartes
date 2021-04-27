let estadoCrud =''
let csrf_token = $('meta[name="csrf-token"]').attr('content');
let filtro = 'habilitados'
let paginacion = 5
let paginas = 1
window.tituloVista ='Roles';

function cambiarVista(vista)
{
    window.tituloVista = vista
    $.ajax({
        url: vista+'?paginacion='+paginacion,
        type:"GET",
        success: function (respuesta) {
            $('#tab-content').html(respuesta)
            filtro = 'habilitados'
            //paginacion = 5
        }
    });
}

var script= document.createElement('script')

script.src='scripts/role.js'

document.head.appendChild(script)

var script2= document.createElement('script')

script2.src='scripts/usuario.js'

document.head.appendChild(script2)

var script3= document.createElement('script')

script3.src='scripts/permiso.js'

document.head.appendChild(script3)

var script4= document.createElement('script')

script4.src='scripts/menu.js'

document.head.appendChild(script4)

//-----
$(function() {
    $.ajax({
        url: 'roles?buscar=',
        type:"GET",
        success: function (respuesta) {
            $('#tab-content').html(respuesta)
        }
    });
})
