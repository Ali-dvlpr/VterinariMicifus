<?php
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // Consulta para eliminar el producto
    $sqlEliminar = "DELETE FROM productos WHERE id = $id";

    if ($conn->query($sqlEliminar) === TRUE) {
        echo "<p style='color: green;'>Producto eliminado correctamente.</p>";
    } else {
        echo "<p style='color: red;'>Error al eliminar el producto: " . $conn->error . "</p>";
    }
} else {
    echo "<p style='color: red;'>Solicitud inválida.</p>";
}

// Cerrar conexión
$conn->close();
?>