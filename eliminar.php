<?php
require_once 'conexion.php';

// Consulta SQL para obtener los productos
$sql = "SELECT id, nombre, descripcion, precio FROM productos";
$result = $conn->query($sql);
?>

<div id="product-list">
    <?php
    // Verificar si hay resultados
    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>";
        // Mostrar datos en cada fila
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['nombre'] . "</td>
                    <td>" . $row['descripcion'] . "</td>
                    <td>" . $row['precio'] . "</td>
                    <td>
                        <button class='btnEliminar' data-id='" . $row['id'] . "'>Eliminar</button>
                    </td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron productos.";
    }

    // Cerrar conexión
    $conn->close();
    ?>
</div>

<div id="response-message"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    // Manejar el clic en el botón de eliminar
    $('.btnEliminar').click(function () {
        var id = $(this).data('id');

        if (confirm("¿Estás seguro de que deseas eliminar este producto?")) {
            $.ajax({
                url: 'ProcesarEliminar.php',
                type: 'POST',
                data: { id: id },
                success: function (response) {
                    $('#response-message').html('<p class="success">' + response + '</p>');
                    // Actualizar solo la lista de productos
                    loadProducts();
                },
                error: function () {
                    $('#response-message').html('<p class="error">Error al eliminar el producto.</p>');
                }
            });
        }
    });

    // Función para cargar los productos
    function loadProducts() {
        $.ajax({
            url: 'eliminar.php', // Archivo que contiene la lógica para listar los productos
            type: 'GET',
            success: function (data) {
                $('#product-list').html(data); // Actualizar solo la lista de productos
            },
            error: function () {
                $('#response-message').html('<p class="error">Error al cargar los productos.</p>');
            }
        });
    }
});
</script>