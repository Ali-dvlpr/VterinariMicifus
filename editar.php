<h2>Actualizar Producto</h2>

<!-- Contenedor para los dos formularios -->
<div id="form-container">
    <!-- Formulario para buscar el producto -->
    <form id="search-form">
        <label for="search_by">Buscar por:</label>
        <select name="search_by" id="search_by" required>
            <option value="id">ID</option>
            <option value="nombre">Nombre</option>
        </select>
        <br><br>
        <label for="search_value">Valor de búsqueda:</label>
        <input type="text" id="search_value" name="search_value" required>
        <br><br>
        <button type="submit">Buscar</button>
    </form>

    <div id="product-details" style="display:none;">
        <!-- Formulario para actualizar los datos del producto -->
        <form id="update-form">
            <input type="hidden" name="id" id="product-id">

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="4" required></textarea>

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" step="0.01" required>

            <button type="submit">Actualizar</button>
        </form>
    </div>
</div>

<div id="response-message"></div>


<div id="response-message"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    // Manejar el envío del formulario de búsqueda
    $('#search-form').submit(function (e) {
        e.preventDefault(); // Evitar el envío normal del formulario

        const searchBy = $('#search_by').val();
        const searchValue = $('#search_value').val();

        $.ajax({
            url: 'buscarProducto.php',
            type: 'POST',
            data: { search_by: searchBy, search_value: searchValue },
            success: function (response) {
                const product = JSON.parse(response);
                if (product) {
                    $('#product-id').val(product.id);
                    $('#nombre').val(product.nombre);
                    $('#descripcion').val(product.descripcion);
                    $('#precio').val(product.precio);
                    $('#product-details').show(); // Mostrar el formulario de actualización
                    $('#search-form').hide()//Oculta el de busqueda
                } else {
                    $('#response-message').html('<p class="error">No se encontró ningún producto con ese criterio.</p>');
                }
            },
            error: function () {
                $('#response-message').html('<p class="error">Error al buscar el producto.</p>');
            }
        });
    });

    // Manejar el envío del formulario de actualización
    $('#update-form').submit(function (e) {
        e.preventDefault(); // Evitar el envío normal del formulario

        const formData = $(this).serialize(); // Obtener todos los datos del formulario

        $.ajax({
            url: 'ProcesarEditar.php',
            type: 'POST',
            data: formData,
            success: function (response) {
                $('#response-message').html('<p class="success">' + response + '</p>');
                loadProducts();
            },
            error: function () {
                $('#response-message').html('<p class="error">Error al actualizar el producto.</p>');
            }
        });
    });

    // Función para cargar los productos
    function loadProducts() {
        $.ajax({
            url: 'editar.php', // Archivo que contiene la lógica para listar los productos
            type: 'GET',
            success: function (data) {
                $('#search-form')[0].reset(); // Reiniciar el formulario
                $('#product-details').hide(); // Ocultar el formulario de actualización
                $('#search-form').show()//mostrar el de busqueda 
            },
            error: function () {
                $('#response-message').html('<p class="error">Error al cargar los productos.</p>');
            }
        });
    }
});
</script>