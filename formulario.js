//Creamos dos constantes una para el formulario y otra para los inputs del formulario que permitirá su interacción
const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');

//Crearemos expresiones regulares para poder validar nuestro formulario
const expresiones = {
    nombre:/^[a-zA-ZÀ-ÿ\s]{1,35}$/,
    apellido:/^[a-zA-ZÀ-ÿ\s]{1,40}$/,
    usuario: /^[a-zA-Z0-9\_\-]{4,15}$/,
    contrasenia: /^[a-zA-Z0-9\_\-]{4,15}$/,
    dni: /^[0-9]{8}[A-Z]$/,
    rol_id:/^[2-3]{1}$/
} 

//Creamos una constante campos para los campos de nuestro formulario
const campos = {
    nombre: false,
    apellido: false,
    usuario: false,
    contrasenia: false,
    dni: false,
    rol_id: false
}

//Creamos una constante llamada validar formulario donde realizaremos un switch con la llamada a la constante expresiones
const validarFormulario = (e) =>{
    switch(e.target.name){
        case "nombre":
            validar(expresiones.nombre, e.target, 'nombre');
            break;
        case "apellido":
            validar(expresiones.apellido, e.target, 'apellido');
            break;
        case "usuario":
                validar(expresiones.usuario, e.target, 'usuario');
            break;
        case "contrasenia":
                validar(expresiones.contrasenia, e.target, 'contrasenia');
                validarContrasenia2();
            break;
        case "contrasenia2":
                validarContrasenia2();
            break;
        case "dni":
                validar(expresiones.dni, e.target, 'dni');
            break;
        case "rol_id":
                validar(expresiones.rol_id, e.target, 'rol_id');
            break;
    }
}

//Con esta constante lo que haremos sera validar y dependiedo si esta bien o mal se le mostrara al usuario
//con el color rojo y verde y un icono adicional para que el usuario lo entienda 
const validar = (expresion, input, campo) => {
    if (expresion.test (input.value)) {
        document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-error');
        document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
        document.querySelector(`#grupo__${campo} img.bien`).classList.add('mostrar');
        document.querySelector(`#grupo__${campo} img.mal`).classList.remove('mostrar');
        document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
        campos[campo]=true;
    }else {
        document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-error');
        document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
        document.querySelector(`#grupo__${campo} img.bien`).classList.remove('mostrar');
        document.querySelector(`#grupo__${campo} img.mal`).classList.add('mostrar');
        document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
        campos[campo]=false;
    }
}

const validarContrasenia2 = () => {
	const inputContrasenia1 = document.getElementById('contrasenia');
	const inputContrasenia2 = document.getElementById('contrasenia2');

	if(inputContrasenia1.value !== inputContrasenia2.value){
		document.getElementById(`grupo__contrasenia2`).classList.add('formulario__grupo-error');
		document.getElementById(`grupo__contrasenia2`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__contrasenia2 img.mal`).classList.add('mostrar');
		document.querySelector(`#grupo__contrasenia2 img.bien`).classList.remove('mostrar');
		document.querySelector(`#grupo__contrasenia2 .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos['contrasenia'] = true;
	} else {
		document.getElementById(`grupo__contrasenia2`).classList.remove('formulario__grupo-error');
		document.getElementById(`grupo__contrasenia2`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__contrasenia2 img.mal`).classList.remove('mostrar');
		document.querySelector(`#grupo__contrasenia2 img.bien`).classList.add('mostrar');
		document.querySelector(`#grupo__contrasenia2 .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['contrasenia'] = false;
	}
}


//Creamos dos oyentes para la constante de validarFormulario, una de keyup y otra de blur
inputs.forEach((input) => {
    input.addEventListener('keyup', validarFormulario);
    input.addEventListener('blur', validarFormulario);
});

//Crearemos una función para el documento en donde interactuaremos con nuestros phps para poder realizar determinadas funciones en la pagina
$(document).ready(function(){
    let edit = false;
    console.log('jquery esta funcionando');
    $('#task-result').hide();
    fetchTasks();

//Con este ajax lo que haremos será basicamente buscar un usuario en nuestra base de datos
//Una vez encontrado un nombre que coincida con alguno de nuestra base de datos se lo mostraremos al usuario mediante 
//una lista desordenada   
    $('#search').keyup(function(e){
       if ($('#search').val()){
            let search = $('#search').val();
            $.ajax({
                url: 'buscar.php',
                type: 'POST',
                data: {search},
                success: function(response){
                    let tarea = JSON.parse(response);
                    let template = '';

                    tarea.forEach(formulario => {
                        template += `<li>
                            ${formulario.nombre}
                        </li>`
                    });
                    $('#container').html(template);
                    $('#task-result').show();
                }
            });
        }
    });

//Con esta funcion lo que haremos será introducir datos en nuestra base de datos con el boton Guardar
//y mediante el fichero de agregar de php se lo pasaremos la información al server     
    $('#formulario').submit(function(e){
        const postData = {
            nombre: $('#nombre').val(),
            apellido: $('#apellido').val(),
            usuario: $('#usuario').val(),
            contrasenia: $('#contrasenia').val(),
            contrasenia2: $('#contrasenia').val(),
            dni: $('#dni').val(),
            rol_id: $('#rol_id').val(),
            id: $('#taskId').val()
        };

        let url = edit === false ? 'agregar.php' : 'editar.php';
        console.log(url);
        
        $.post(url, postData, function(response) {
            console.log(response);
            fetchTasks();
           $('#task-form').trigger('reset');
        });
        e.preventDefault();
    });
    
//Con está función lo que haremos será mostrar por pantalla una tabla y añadiremos tambien el botón de eliminar
//al lado de cada uno de los datos insertados pondremos el botón de eliminar     
    function fetchTasks(){
        $.ajax({
            url: 'lista.php',
            type: 'GET',
            success: function(response){
                let tasks = JSON.parse(response);
                let template = '';
                tasks.forEach(formulario =>{
                    template += `
                        <tr taskId="${formulario.id}">
                            <td>${formulario.id}</td>
                            <td>
                                <a href="#" class="task-item">${formulario. nombre}</a>
                            </td>
                            <td>${formulario.apellido}</td>
                            <td>${formulario.usuario}</td>
                            <td>${formulario.dni}</td>
                            <td>
                                <button class="task-delete btn btn-danger">Eliminar</button>
                            </td>
                        </tr>
                    `
                });
                $('#tasks').html(template);
            }
        });
    }

    
//Con esta función lo que haremos será eliminar los datos de la fila que nosotros queramos, además de pedir una confirmación 
//por pantalla para poder eliminar los datos o no     
    $(document).on('click', '.task-delete', function() {

        if(confirm('¿Estas seguro de que quieres eliminarlo?')){
            let elemento = $(this)[0].parentElement.parentElement;
            let id = $(elemento).attr('taskId');
            $.post('borrar.php', {id}, function (response) {
                fetchTasks();
            })
        }
    });

//Con está función lo que haremos será editar los datos que tenemos en nuestra base de datos y actualizaremos los datos que tenemos
//en la pantalla que ve el usuario 
    $(document).on('click', '.task-item', function(){
        let element=$(this)[0].parentElement.parentElement;
        let id = $(element).attr('taskId')
        $.post('tareaUnica.php', {id}, function(response){
            const tarea = JSON.parse(response);
            $('#nombre').val(tarea.nombre);
            $('#apellido').val(tarea.apellido);
            $('#usuario').val(tarea.usuario);
            $('#dni').val(tarea.dni);
            $('#taskId').val(tarea.id);
            edit=true;
        })
    })

});