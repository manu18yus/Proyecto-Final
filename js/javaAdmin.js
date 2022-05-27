/* Carga */
$(document).ready( () => {

    $('#create').click( () => {
        crearProducto();
    })

    cargarProductos();





})

/* Funciones */

function crearProducto() {
    const create_codigo = $('#create_codigo').val();
    const create_titulo = $('#create_titulo').val();
    const create_descripcion = $('#create_descripcion').val();
    const create_precio = $('#create_precio').val();

    $.ajax({
        url: 'api/create.php',
        dataType: 'json',
        type: 'POST',
        data: {
            nombre: create_titulo,
            descripcion: create_descripcion,
            codigo: create_codigo,
            precio: create_precio,
            imagen: null
        }, success: function (respuesta) {
            console.log("Se ha enviado")
        }, error: function (xhr) {
            console.log("No se ha podido enviar")
        }, complete: function () {
            console.log("Completado")
        }
    })
}

function cargarProductos() {

    $.ajax({
        url: 'api/read.php',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            response['body'].forEach(p => {

                const id = p.id

                let item = `
                <li>
                <h5>${p.nombre}</h5>
				<div><img src="imagenes/${p.id}.jpg" width="80px"></div>
                <div>Codigo: <input name="product_code" value="${p.codigo}" id="codigo${p.id}"><br>
				<div>Producto: <input type="text" value="${p.nombre}" id="producto${p.id}"/></div>
                <div>Descripición: <input type="text" value="${p.descripcion}" size="100" id="descripcion${p.id}"/></div>
				<div>Precio : <input type="text" value="${p.precio}" size="6" id="precio${p.id}"> &euro;</div>
				<br>
                <button id="editar${p.id}">Editar producto</button>
                <button id="eliminar${p.id}">Eliminar producto</button>
                <hr>
			    </li>
                `
                
                $('#lista_editar').append(item)


                $('#eliminar' + id).click( () => {
                    $.ajax({
                        url: 'api/delete.php',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: id
                        },
                        success: function (response) {
                            console.log("Zapatillas eliminada")
                        }
                    })
                })

                $('#editar' + id).click( () => {


                    const editar_codigo = $('#codigo' + id).val();
                    const editar_titulo = $('#producto' + id).val();
                    const editar_descripcion = $('#descripcion' + id).val();
                    const editar_precio = $('#precio' + id).val();

                    $.ajax({
                        url: 'api/update.php',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: id,
                            nombre: editar_titulo,
                            descripcion: editar_descripcion,
                            codigo: editar_codigo,
                            precio: editar_precio,
                            imagen: null
                        },
                        success: function (response) {
                            console.log("Zapatillas editadas")
                        }, error: function (xhr) {
                            console.log(xhr.responseText)
                        }
                    })
                })
            });
        }
    })
}