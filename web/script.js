function mostrarFechaHora() {
    let reloj = document.getElementById('reloj');
    if (reloj) {
        let fecha = new Date();
       
        reloj.innerHTML = "Hoy es: " + fecha.toLocaleString('es-MX', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' });
    }
}

setInterval(mostrarFechaHora, 1000);


function validarFormulario() {
    let nombre = document.getElementById('nombre').value;
    let apellidos = document.getElementById('apellidos').value;

    if (nombre === "" || apellidos === "") {
        alert("Error: Debes escribir tu nombre y tus apellidos.");
        return false; 
    }
    alert("¡Formulario enviado correctamente!");
    return true; 
}


function convertirPesos() {
    let dolares = document.getElementById('dolares').value;
    let pesos = dolares * 19.50; // Tipo de cambio 
    document.getElementById('resultadoConvertidor').innerHTML = "$" + pesos.toFixed(2) + " MXN";
}


function calcular() {
    let n1 = parseFloat(document.getElementById('num1').value);
    let n2 = parseFloat(document.getElementById('num2').value);
    let op = document.getElementById('operacion').value;
    let res = 0;

    if (op === "+") res = n1 + n2;
    if (op === "-") res = n1 - n2;
    if (op === "*") res = n1 * n2;
    if (op === "/") res = n1 / n2;

    document.getElementById('resultadoCalculadora').innerHTML = "Resultado: " + res;
}


function revisarCuestionario() {
    let p1 = document.getElementById('preg1').value.toLowerCase();
    let p2 = document.getElementById('preg2').value.toLowerCase();
    let puntaje = 0;

    if (p1 === "13") puntaje++;
    if (p2 === "20") puntaje++;

    
}

// Validación para Registro (Coincidencia de Contraseñas)
function validarRegistro() {
    let nombre = document.getElementById('reg_nombre').value.trim();
    let email = document.getElementById('reg_email').value.trim();
    let pass1 = document.getElementById('reg_password').value;
    let pass2 = document.getElementById('reg_repassword').value;

    if (nombre === "" || email === "" || pass1 === "" || pass2 === "") {
        alert("Todos los campos del registro son obligatorios.");
        return false;
    }

    if (pass1.length < 6) {
        alert("La contraseña debe tener al menos 6 caracteres.");
        return false;
    }

    if (pass1 !== pass2) {
        alert("Las contraseñas no coinciden. Por favor, verifícalas.");
        return false;
    }

    return true;
}

function editarUsuario(id, nombre, email) {
    document.getElementById('mod_id').value = id;
    document.getElementById('mod_nombre').value = nombre;
    document.getElementById('mod_email').value = email;
    document.getElementById('sec_modificar').style.display = 'block';
    window.scrollTo({ top: document.getElementById('sec_modificar').offsetTop, behavior: 'smooth' });
}

function cancelarEdicion() {
    document.getElementById('sec_modificar').style.display = 'none';
}
