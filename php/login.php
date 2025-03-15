<?php
include 'conexion.php';
global $conn;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE correo = '$correo' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Inicio de sesión exitoso";
    } else {
        echo "Correo o contraseña incorrectos";
    }

    $conn->close();
}
?>