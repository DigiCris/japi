const d = document;
const $buscar = d.getElementById("buscar"),
  $cerrarBusqueda = d.getElementById("cerrar-busqueda"),
  $tabla = d.getElementById("table"),
  $busquedaDinamica = d.getElementById("busqueda-dinamica"),
  $Modal = d.getElementById("modal"),
  $modalContent = d.getElementById("modal-content"),
  $modalTitle = d.getElementById("modal-title"),
  $modalMensaje = d.getElementById("mensaje-modal"),
  $mensajeModal = d.getElementById("mensaje-modal"),
  $comentarioModal = d.getElementById("comentario-modal")

  d.addEventListener("DOMContentLoaded", e => {

    d.addEventListener("click", (e) => {
      if(e.target.matches("#buscar")){
        $buscar.classList.add("none")
        $busquedaDinamica.classList.add("busqueda-dinamica-activa")
        $tabla.classList.add("mover-tabla")
      }
    
      if(e.target.matches("#cerrar")){
        $buscar.classList.remove("none")
        $busquedaDinamica.classList.remove("busqueda-dinamica-activa")
        $tabla.classList.remove("mover-tabla")
        $Modal.classList.remove("modal-active")
        $modalContent.classList.remove("modal-active")
        $comentarioModal.classList.remove("modal-active")
      }

      if(e.target.matches("#item-tabla")){
        $Modal.classList.add("modal-active");
        $modalContent.classList.add("modal-active")
        const dinamicTitle = e.target.textContent || e.target.innerText;
        $modalTitle.textContent = dinamicTitle;
      }

      if(e.target.matches("#btn-modal")) {
        $modalContent.classList.remove("modal-active");
        $mensajeModal.classList.add("modal-active")
        setTimeout(() => {
          $mensajeModal.classList.remove("modal-active")
          $comentarioModal.classList.add("modal-active")
        }, 1500)
      }

      
  });
})






/////////////////////// Segunda entrega /////////////////////////////////////



/// toma de datos /////

const botonRegistrar = document.getElementById('botonRegistrar');
botonRegistrar.addEventListener('click', function(event) {
  // Evitar la acción por defecto del botón
  event.preventDefault();
  getFormData();
});

function getFormData() {
  $id = "apellido_error"
  const apellido = document.getElementById('apellido').value;
  validateName(apellido,$id);

  $id = "apellido_error"
  const nombre = document.getElementById('nombre').value;
  validateName(nombre,$id);

  $id = "usuario_error"
  const usuario = document.getElementById('usuario').value;
  validateUsername(usuario,$id);

  $id = "telefono_error"
  const telefono = document.getElementById('telefono').value;
  validatePhone(telefono,$id);

  $id = "email_error"
  const email = document.getElementById('email').value;
  validateEmail(email,$id);

  $id = "password_error"
  const password = document.getElementById('password').value;
  validatePassword(password,$id);

  $id = "pais_error"
  const pais = document.getElementById('pais').value;
  validateCountry(pais,$id);

  $id = "provincia_error"
  const provincia = document.getElementById('provincia').value;
  validateName(provincia,$id);

  $id = "address_error"
  const address = document.getElementById('ciudad').value;
  validateAddress(address,$id);

  // Imprimo los inputs
  console.log('Apellido:', apellido);
  console.log('Nombre:', nombre);
  console.log('Usuario:', usuario);
  console.log('Teléfono:', telefono);
  console.log('Correo electrónico:', email);
  console.log('Contraseña:', password);
  console.log('País:', pais);
  console.log('Estado:', provincia);
  console.log('Dirección:', address);
}



///////////////////// Validaciones //////////////////////////////////
function validateName(input,$id) {
  // Regex para letras y espacios
  const nameRegex = /^[a-zA-Z\s]+$/;
  // true si nombre es valido, false si no lo es
  if (nameRegex.test(input)) {
    return input; // El nombre es válido
  } else {
    // El nombre no es válido, mostrar un alert con el error
    writeAlert("Solo letras y espacios.",$id);
    return false;
  }
}

function validateUsername(username,$id) {
  // - Mín 3 char
  // - Máx 20 char
  // - upper, Lower case, números y guiones bajos
  const usernameRegex = /^[a-zA-Z0-9_]{3,20}$/;

  // true si user es valido, false si no lo es
  if (usernameRegex.test(username)) {
    return username; // El usuario es válido
  } else {
    writeAlert("3 a 20 caracteres alfanumericos y _.",$id);
    return false;
  }
}

function validatePhone(phone,$id) {
  // - Mín 7 dígitos
  // - Máximo 15 dígitos
  // - Puede contener números, espacios, guiones y paréntesis
  //const phoneRegex = /^\+?[\d\s\-\(\)]{10,15}$/;
  const phoneRegex = /^[\d\s\-\+]{7,15}$/;

  // true si tel es valido, false si no lo es
  if (phoneRegex.test(phone)) {
    return phone; // El teléfono es válido
  } else {
    // El teléfono no es válido, mostrar un alert con el error
    writeAlert("7 a 15 dígitos (núm, espacios, - , () y +).",$id);
    return false;
  }
}

function validateEmail(email,$id) {
  // - Al menos un carácter antes del "@"
  // - No espacios
  // - Solo alfanuméricos y ".",  "_", "-"
  const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

  // true si cumple, false si no
  if (emailRegex.test(email)) {
    return email; // El correo electrónico es válido
  } else {
    // El correo electrónico no es válido, mostrar un alert con el error
    writeAlert("ej: example@domain.com, solo alfanumerico y especiales _, - y .",$id);
    return false;
  }
}

function validatePassword(password,$id) {
  // Expresión regular para verificar que la contraseña cumpla con los requisitos
  const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;

  // Verificar si la contraseña cumple con los requisitos
  if (passwordRegex.test(password)) {
    return password; // La contraseña es válida
  } else {
    // La contraseña no es válida, determinar cuál es el error
    if (password.length < 8) {
      writeAlert ("Minimo 8 caracteres.",$id);
    } else if (!/[a-z]/.test(password)) {
      writeAlert("Al menos 1 minúscula.",$id);
    } else if (!/[A-Z]/.test(password)) {
      writeAlert("Al menos 1 mayúscula.",$id);
    } else if (!/\d/.test(password)) {
      writeAlert("Al menos 1 un número.",$id);
    } else {
      writeAlert("Debe tener mayuscula, minusculas, numeros y al menos 8 letras.",$id);
    }
    return false;
  }
}


function validateCountry(country,$id) {
  // Convertir el país a minúsculas y quitar posibles puntos al final
  const normalizedCountry = country.toLowerCase().replace(/\.$/, "");

  // Verificar si el país es Argentina
  if (normalizedCountry === "argentina" || normalizedCountry === "arg") {
    return "argentina"; // El país es válido
  } else {
    writeAlert("Solo Argentina por ahora.",$id);
    return false;
  }
}

function validateAddress(address,$id) {
  //sin espacios en las puntas
  const trimmedAddress = address.trim();

  // Verificar si la dirección tiene al menos 5 caracteres
  if (trimmedAddress.length < 5) {
    writeAlert("Al menos 5 caracteres.",$id);
    return false;
  }

  // Verificar si la dirección contiene números
  if (!/\d/.test(trimmedAddress)) {
    writeAlert("Al menos 1 numero.",$id);
    return false;
  }

  // Verificar si la dirección contiene letras
  if (!/[a-zA-Z]/.test(trimmedAddress)) {
    writeAlert("Al menos 1 letra.",$id);
    return false;
  }
  // Si la dirección cumple con todos los requisitos, se considera válida
  return trimmedAddress;
}


function writeAlert($texto,$id) {
  //alert($id+" => "+$texto);
  // Obtener el elemento p con el id "address_error"
  const addressErrorElement = document.getElementById($id);

  // Escribir el texto "Error" en el elemento
  addressErrorElement.textContent = $texto;
}