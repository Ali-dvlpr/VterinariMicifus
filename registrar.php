<h2>Registrar Producto</h2>
<form id="ajax-register-form" class="form-register">

    <label for="nombre">Nombre del Producto:</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="descripcion">Descripción:</label>
    <input type="text" id="descripcion" name="descripcion" required>

    <label for="precio">Precio:</label>
    <input type="number" step="0.01" id="precio" name="precio" required>

    <button type="button" id="submit-btn">Registrar</button>
</form>

<div id="response-message"></div>

<script>
    $(document).ready(function () {
        $('#submit-btn').click(function () {
            const nombre = $('#nombre').val();
            const descripcion = $('#descripcion').val();
            const precio = $('#precio').val();

            if (!nombre || !descripcion || !precio) {
                $('#response-message').html('<p class="error">Todos los campos son obligatorios.</p>');
                return;
            }

            $.ajax({
                url: 'process-register.php',
                type: 'POST',
                data: { nombre, descripcion, precio },
                success: function (response) {
                    $('#response-message').html('<p class="success">' + response + '</p>');
                    $('#ajax-register-form')[0].reset();
                },
                error: function () {
                    $('#response-message').html('<p class="error">Error al registrar el producto.</p>');
                }
            });
        });
    });
</script>
