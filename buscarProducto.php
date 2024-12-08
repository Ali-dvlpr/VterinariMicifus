<?php
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $searchBy = $_POST['search_by'];
    $searchValue = $conn->real_escape_string($_POST['search_value']);

    // Construir consulta SQL
    if ($searchBy === 'id') {
        $sql = "SELECT * FROM productos WHERE id = '$searchValue'";
    } elseif ($searchBy === 'nombre') {
        $sql = "SELECT * FROM productos WHERE nombre LIKE '%$searchValue%'";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $producto = $result->fetch_assoc();
        echo json_encode($producto); // Devolver datos en formato JSON
    } else {
        echo json_encode(null); // No se encontró el producto
    }
}

$conn->close();
?>