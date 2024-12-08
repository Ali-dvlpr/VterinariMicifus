<?php
// Conexión a la base de datos
$servidor = "localhost";
$usuario = "root";
$password = "EAll2003";
$base_datos = "veterinaria";

$conn = new mysqli($servidor, $usuario, $password, $base_datos);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

$conn->set_charset("utf8");

?>