<?php

include 'conexion.php'; // Asegúrate de que este archivo establece la conexión correctamente
global $conn;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitizar las entradas
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $correo = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password']; // En este caso, la contraseña será encriptada más adelante.

    // Validar que ningún campo esté vacío
    if (empty($nombre) || empty($correo) || empty($password)) {
        echo "Todos los campos deben ser completados.";
        exit;
    }

    // Encriptar la contraseña
    $password_hashed = password_hash($password, PASSWORD_BCRYPT);

    // Consulta preparada para prevenir inyección SQL
    $sql = $conn->prepare("INSERT INTO usuarios (nombre, correo, password) VALUES (?, ?, ?)");
    $sql->bind_param("sss", $nombre, $correo, $password_hashed);

    if ($sql->execute()) {
        echo "Registro exitoso";
    } else {
        echo "Error: " . $sql->error;
    }

    // Cerrar la conexión
    $sql->close();
    $conn->close();
}
?>