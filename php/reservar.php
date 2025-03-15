<?php
global $conn;
include 'conexion.php'; // Asegúrate de que el archivo 'conexion.php' esté configurado correctamente.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitizar y validar entradas
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $correo = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_EMAIL);
    $telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING);
    $fecha = $_POST['fecha']; // Validaremos esta entrada más adelante.
    $hora = $_POST['hora']; // Validaremos esta entrada más adelante.
    $personas = filter_input(INPUT_POST, 'personas', FILTER_VALIDATE_INT);

    // Validar campos específicos
    if (empty($nombre) || empty($correo) || empty($telefono) || empty($fecha) || empty($hora) || empty($personas)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    // Validar formato de fecha y hora (opcional)
    $fechaRegex = '/^\d{4}-\d{2}-\d{2}$/'; // Formato yyyy-mm-dd
    $horaRegex = '/^\d{2}:\d{2}$/'; // Formato hh:mm

    if (!preg_match($fechaRegex, $fecha) || !preg_match($horaRegex, $hora)) {
        echo "Formato de fecha o hora inválido.";
        exit;
    }

    // Consulta preparada
    $sql = $conn->prepare("INSERT INTO reservas (nombre, correo, telefono, fecha, hora, personas) VALUES (?, ?, ?, ?, ?, ?)");
    $sql->bind_param("sssssi", $nombre, $correo, $telefono, $fecha, $hora, $personas);

    if ($sql->execute()) {
        echo "Reserva registrada con éxito.";
    } else {
        echo "Error al registrar la reserva: " . $sql->error;
    }

    // Cerrar la consulta y la conexión
    $sql->close();
    $conn->close();
}
?>