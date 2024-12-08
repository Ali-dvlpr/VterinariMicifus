<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veterinaria Micifús</title>
    <link rel="stylesheet" href="Css/estilosIndex.css">
    <link rel="stylesheet" href="Css/estilosQsomos.css">
    <link rel="stylesheet" href="Css/estilosRegistrar.css">
    <link rel="stylesheet" href="Css/estilosEliminar.css">
    <link rel="stylesheet" href="Css/estiloEditar.css">
    <link rel="stylesheet" href="Css/estilosEliminar.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery -->
</head>
<body>
    <div class="container">
        <!-- Primera fila: Título y logo -->
        <header class="header">
            <div class="logo">
                <img src="LogoMicifus.jpg" alt="Logo Veterinaria Micifús" class="logo-img">
            </div>
            <h1 class="title">Veterinaria Micifús</h1>
        </header>

        <!-- Segunda fila: Menú principal -->
        <nav class="menu">
            <ul class="menu-list">
                <li><a href="#" class="menu-link" data-page="inicio">Inicio</a></li>
                <li><a href="#" class="menu-link" data-page="qsomos">Quiénes Somos</a></li>
                <li><a href="#" class="menu-link" data-page="registrar">Registrar</a></li>
                <li><a href="#" class="menu-link" data-page="eliminar">Eliminar</a></li>
                <li><a href="#" class="menu-link" data-page="editar">Editar</a></li>
                <li><a href="#" class="menu-link" data-page="listar">Listar</a></li>
            </ul>
        </nav>

        <!-- Tercera fila: Sección de contenido dinámico -->
        <section class="content-section" id="dynamic-content">
            <h2 class="Bienvenido">Bienvenidos a la Veterinaria Micifús</h2>
            <p>Selecciona una opción del menú para continuar.</p>
        </section>

        <!-- Cuarta fila: Pie de página -->
        <footer class="footer">
            <p>© 2024 Veterinaria Micifús. Todos los derechos reservados.</p>
            <div class="social-media">
                <a href="https://facebook.com" target="_blank"><img src="facebook-icon.png" alt="Facebook"></a>
                <a href="https://twitter.com" target="_blank"><img src="twitter-icon.png" alt="Twitter"></a>
                <a href="https://instagram.com" target="_blank"><img src="instagram-icon.png" alt="Instagram"></a>
            </div>
        </footer>
    </div>

    <script>
        $(document).ready(function () {
            $('.menu-link').click(function (e) {
                e.preventDefault();
                const page = $(this).data('page'); // Obtener la página seleccionada

                // Cargar contenido dinámicamente con AJAX
                $('#dynamic-content').html('<p>Cargando...</p>'); // Indicador de carga
                $.ajax({
                    url: page + '.php', // Archivo PHP correspondiente
                    method: 'GET',
                    success: function (data) {
                        $('#dynamic-content').html(data); // Reemplazar contenido
                    },
                    error: function () {
                        $('#dynamic-content').html('<p class="error">Error al cargar el contenido.</p>');
                    }
                });
            });
        });
    </script>
</body>
</html>
