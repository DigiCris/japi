


///////////// Validacion javascript //////////////////////////////
const botonIngresar = document.getElementById('botonIngresar');
botonIngresar.addEventListener('click', function(event) {
  // Evitar la acción por defecto del botón
  event.preventDefault();
  getFormData();
});
function getFormData() {
    $id = "usuario_error"
    var usuario = document.getElementById('usuario').value;
    usuario= validateUsername(usuario,$id);

    $id = "password_error"
    var password = document.getElementById('password').value;
    password = validatePassword(password,$id);

    // Imprimo los inputs por debug unicamente
    console.log('Usuario:', usuario);
    console.log('Contraseña:', password);
  
    if (usuario && password) {
      //alert('Validación JavaScript completada con éxito en registro');
      login(usuario,password);
    } else {
      // Si alguna variable es falsa, mostrar un alert
      alert('Por favor, ingrese bien los valores de registro.');
    }
  
}

function validatePassword(password,$id) {
    // Expresión regular para verificar que la contraseña cumpla con los requisitos
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
  
    // Verificar si la contraseña cumple con los requisitos
    if (passwordRegex.test(password)) {
      const errorElement = document.getElementById($id);
      errorElement.classList.add('noneView');
      return password; // La contraseña es válida
    } else {
      // La contraseña no es válida, determinar cuál es el error
      if (password.length < 8) {
        writeAlert ("Contraseña: Minimo 8 caracteres.",$id);
      } else if (!/[a-z]/.test(password)) {
        writeAlert("Contraseña: Al menos 1 minúscula.",$id);
      } else if (!/[A-Z]/.test(password)) {
        writeAlert("Contraseña: Al menos 1 mayúscula.",$id);
      } else if (!/\d/.test(password)) {
        writeAlert("Contraseña: Al menos 1 un número.",$id);
      } else {
        writeAlert("Contraseña: Debe tener mayuscula, minusculas, numeros y al menos 8 letras.",$id);
      }
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
      const errorElement = document.getElementById($id);
      errorElement.classList.add('noneView');
      return username; // El usuario es válido
    } else {
      writeAlert("Usuario: 3 a 20 caracteres alfanumericos y _.",$id);
      return false;
    }
}
  
  function writeAlert($texto,$id) {
  
    //alert($id+" => "+$texto);
    // Obtener el elemento p con el id "address_error"
    const addressErrorElement = document.getElementById($id);
    addressErrorElement.classList.remove('noneView');
    // Escribir el texto "Error" en el elemento
    addressErrorElement.textContent = $texto;
}
////////////////////////////////////////////////////////////////////////


////////////////// Validacion API //////////////////
function login($user,$password) {
    var myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");

    var raw = JSON.stringify({
    "method": "login",
    "username": $user,
    "password": $password
    });

    var requestOptions = {
    method: 'POST',
    headers: myHeaders,
    body: raw,
    redirect: 'follow'
    };
    //sessionStorage.setItem('flashiverySession', 'true');
    //const nombre = sessionStorage.getItem('flashiverySession');
    fetch("https://cursoblockchain.com.ar/flashivery/api/v1//user/login", requestOptions)
    .then(response => response.text())
    .then(result => {
        session = JSON.parse(result)["success"];
        if(session==false) {
          alert("¡Usuario y contraseña incorrectos!\n\nPrueba con estos datos:\n\nUsuario: Mar3\nContraseña: Test1234");
        }else {
            //alert("ahora puedes navegar");
            window.location.href = "https://cursoblockchain.com.ar/flashivery/productos.html";
        }        
        console.log(session);
        sessionStorage.setItem("flashiverySession",session);
    })
    .catch(error => console.log('error', error));    
}

//////////////////////////////////////////////////////////////////////////////////////////
  



