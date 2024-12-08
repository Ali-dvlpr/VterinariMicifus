<?php
require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = intval($_POST['id']);
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    // Validar y escapar los datos
    $nombre = $conn->real_escape_string($nombre);
    $descripcion = $conn->real_escape_string($descripcion);
    $precio = floatval($precio); // Asegurarse que es un número

    // Actualizar el registro en la base de datos
    $sql = "UPDATE productos 
            SET nombre = '$nombre', descripcion = '$descripcion', precio = '$precio' 
            WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Producto actualizado correctamente.";
    } else {
        echo "Error al actualizar el producto: " . $conn->error;
    }
}

$conn->close();
?>