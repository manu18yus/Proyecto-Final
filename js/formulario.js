//Creamos dos constantes una para el formulario y otra para los inputs del formulario que permitirá su interacción
const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');

//Crearemos expresiones regulares para poder validar nuestro formulario
const expresiones = {
    correo: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/,
    user: /^[a-zA-Z0-9\_\-]{4,15}$/,
    pass: /^[a-zA-Z0-9\_\-]{4,15}$/,
    rol_id:/^[2-3]{1}$/
} 

//Creamos una constante campos para los campos de nuestro formulario
const campos = {
    correo: false,
    user: false,
    pass: false,
    rol_id: false
}

//Creamos una constante llamada validar formulario donde realizaremos un switch con la llamada a la constante expresiones
const validarFormulario = (e) =>{
    switch(e.target.name){
        case "correo":
            validar(expresiones.correo, e.target, 'correo');
        break;
        case "user":
                validar(expresiones.user, e.target, 'user');
            break;
        case "pass":
                validar(expresiones.pass, e.target, 'pass');
                validarContrasenia2();
            break;
        case "pass2":
                validarContrasenia2();
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

//Con esta función lo que haremos será comprobar que la primera contraseña que el usuario introduzca
//sea la misma que la segunda para que no haya errores
const validarContrasenia2 = () => {
	const inputContrasenia1 = document.getElementById('pass');
	const inputContrasenia2 = document.getElementById('pass2');

	if(inputContrasenia1.value !== inputContrasenia2.value){
		document.getElementById(`grupo__pass2`).classList.add('formulario__grupo-error');
		document.getElementById(`grupo__pass2`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__pass2 img.mal`).classList.add('mostrar');
		document.querySelector(`#grupo__pass2 img.bien`).classList.remove('mostrar');
		document.querySelector(`#grupo__pass2 .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos['pass'] = true;
	} else {
		document.getElementById(`grupo__pass2`).classList.remove('formulario__grupo-error');
		document.getElementById(`grupo__pass2`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__pass2 img.mal`).classList.remove('mostrar');
		document.querySelector(`#grupo__pass2 img.bien`).classList.add('mostrar');
		document.querySelector(`#grupo__pass2 .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['pass'] = false;
	}
}


//Creamos dos oyentes para la constante de validarFormulario, una de keyup y otra de blur
inputs.forEach((input) => {
    input.addEventListener('keyup', validarFormulario);
    input.addEventListener('blur', validarFormulario);
});
