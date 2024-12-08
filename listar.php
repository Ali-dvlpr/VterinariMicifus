<h2>Lista de Productos</h2>
<table class="product-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
        </tr>
    </thead>
    <tbody>
        <?php
        require_once 'conexion.php';

        // Consulta SQL para obtener los productos
        $sql = "SELECT id, nombre, descripcion, precio FROM productos";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Mostrar cada producto en una fila
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                                    <td>" . htmlspecialchars($row['id']) . "</td>
                                    <td>" . htmlspecialchars($row['nombre']) . "</td>
                                    <td>" . htmlspecialchars($row['descripcion']) . "</td>
                                    <td>$" . number_format($row['precio'], 2) . "</td>
                                  </tr>";
            }
        } else {
            echo "<tr><td colspan='4' class='no-data'>No hay productos registrados.</td></tr>";
        }

        $conn->close();
        ?>
    </tbody>
</table>