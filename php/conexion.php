<?php
$servername = "localhost:1900";
$username = "root";
$password = "Ad2556229";
$dbname = "restaurante";



$conn = new mysqli( $servername, $username,  $password,  $dbname);
// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>

