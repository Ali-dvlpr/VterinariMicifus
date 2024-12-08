<?php
// Verificar que la solicitud se haya realizado mediante POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Datos de conexión a la base de datos
    require_once 'conexion.php';

    // Capturar los datos enviados por AJAX
    $nombre = isset($_POST['nombre']) ? $conn->real_escape_string($_POST['nombre']) : null;
    $descripcion = isset($_POST['descripcion']) ? $conn->real_escape_string($_POST['descripcion']) : null;
    $precio = isset($_POST['precio']) ? $conn->real_escape_string($_POST['precio']) : null;

    // Validar que no haya campos vacíos
    if (empty($nombre) || empty($descripcion) || empty($precio)) {
        echo "Todos los campos son obligatorios.";
        $conn->close();
        exit;
    }

    // Preparar la consulta para insertar los datos en la tabla productos
    $sql = "INSERT INTO productos (nombre, descripcion, precio) VALUES ('$nombre', '$descripcion', $precio)";

    // Ejecutar la consulta e informar el resultado
    if ($conn->query($sql) === TRUE) {
        echo "Producto registrado exitosamente.";
    } else {
        echo "Error al registrar el producto: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
} else {
    // Si no es una solicitud POST, mostrar un error
    echo "Método no permitido.";
}
?>
