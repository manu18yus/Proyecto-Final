
/* Cuando el documento esté listo */
$(document).ready(() => {

    $.ajax({
        url: 'api/read.php',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            const productos = response['body']

            productos.forEach(producto => {

                let item = `
                <div class="contenedor">
                <li class="izquierda">
                <form class="form-item">
                    <h4 class="titulo">${producto.nombre}</h4>
                    <div><img src="imagenes/${producto.id}.jpg" title="${producto.descripcion}" class="imagenes"></div>
                    <div>Precio : &euro; ${producto.precio}<div>
                            <div class="item-box">
                                <div>
                                    Cantidad :
                                    <select name="product_qty">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
    
                                <div>
                                    Tamaño :
                                    <select name="product_size">
                                        <option value="M">40</option>
                                        <option value="XL">41</option>
                                        <option value="XXL">42</option>
                                        <option value="XXL">43</option>
                                        <option value="XXL">44</option>
                                        <option value="XXL">45</option>

                                    </select>
                                </div>
    
                                <input name="codigo" type="hidden" value="${producto.codigo}">
                                <a href="./detalles.php?id=<?php echo $f['id'] ?>">ver</a>
                                <button type="submit">Añadir al carrito</button>
                            </div>
                </form>
            </li>
            </div>
        `;

                $('#products-wrp').append(item);

            });

        }
    })




})

