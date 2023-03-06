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
                        template += `<li class="texto_blanco">
                        ${formulario.user}
                        <button  class="edit-task btn btn-warning" taskId="${formulario.id_usuario}">Editar</button>
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
            correo: $('#correo').val(),
            user: $('#user').val(),
            pass: $('#pass').val(),
            rol_id: $('#rol_id').val(),
            id_usuario: $('#taskId').val()
        };

        let url = edit === false ? 'agregar.php' : 'editar.php';
        console.log(url);
    
        $.post(url, postData, function(response) {
            console.log(response);
            fetchTasks();
            $('#formulario')[0].reset();
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
                        <tr class='lista_blanca' taskId="${formulario.id_usuario}">
                            <td>${formulario.id_usuario}</td>
                            <td>
                                <a href="#" class="task-item">${formulario. user}</a>
                            </td>
                            <td>${formulario.correo}</td>
                            <td>${formulario.pass}</td>
                            <td>${formulario.rol}</td>
                            <td>
                                <button  class="task-delete btn btn-danger">Eliminar</button>
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
            let id_usuario = $(elemento).attr('taskId');
            $.post('borrar.php', {id_usuario}, function (response) {
                fetchTasks();
            })
        }
    });

//Con está función lo que haremos será editar los datos que tenemos en nuestra base de datos y actualizaremos los datos que tenemos
//en la pantalla que ve el usuario 
    $(document).on('click', '.task-item', function(){
        let element=$(this)[0].parentElement.parentElement;
        let id_usuario = $(element).attr('taskId')
        $.post('tareaUnica.php', {id_usuario}, function(response){
            const tarea = JSON.parse(response);
            $('#correo').val(tarea.correo);
            $('#user').val(tarea.user);
            $('#pass').val(tarea.pass);
            $('#rol_id').val(tarea.rol_id);
            $('#taskId').val(tarea.id_usuario);
            edit=true;
        })
    })

//Con esta función lo que se lográ hacer es que cuando se llama a la función de buscar usuario y se presiona el botón de editar 
//aparezcan los valores del usuario y se puedan editar    
    $(document).on('click', '.edit-task', function() {
        let taskId = $(this).attr('taskId');
        $.post('tareaUnica.php', {id_usuario: taskId}, function(response){
            const tarea = JSON.parse(response);
            $('#correo').val(tarea.correo);
            $('#user').val(tarea.user);
            $('#pass').val(tarea.pass);
            $('#rol_id').val(tarea.rol_id);
            $('#taskId').val(tarea.id_usuario);
            edit=true;
        });
    });
    

});