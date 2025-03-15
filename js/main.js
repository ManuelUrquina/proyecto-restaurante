// Función para reservar un menú
function reservarMenu(menu) {
    if (!sessionStorage.getItem('loggedin')) {
        alert("Debes iniciar sesión para reservar.");
        window.location.href = "login.html";
        return;
    }

    const mesa = prompt("Ingrese el número de mesa:");
    if (mesa) {
        fetch('php/reservar.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ menu, mesa })
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
}

// Función para iniciar sesión
function login() {
    const correo = document.getElementById('correo').value;
    const password = document.getElementById('password').value;

    fetch('php/login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ correo, password })
    })
    .then(response => response.text())
    .then(data => {
        if (data === "Correo o contraseña incorrectos") {
            alert(data);
        } else {
            sessionStorage.setItem('loggedin', true);
            window.location.href = "servicios.html";
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// Función para registrarse

function registro() {
    const form = document.getElementById("registroForm");
    const formData = new FormData(form);

    fetch("php/registro.php", {
        method: "POST",
        body: formData,
    })
        .then(response => response.text())
        .then(data => {
            alert(data); // Mostrar mensaje del servidor
        })
        .catch(error => {
            console.error("Error al enviar el formulario:", error);
        });
}