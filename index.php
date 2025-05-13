<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoonCafe</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="bg-light p-3 text-center">
        <h1>Bienvenido a MoonCafe</h1>
        <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="index.html">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="menu.php">Menú</a></li>
                <li class="nav-item"><a class="nav-link" href="crear_cuenta.html">Crear Cuenta</a></li>
                <li class="nav-item"><a class="nav-link" href="novedades.html">Novedades</a></li>
                <li class="nav-item"><a class="nav-link" href="contacto.html">Contacto</a></li>
                <?php
                session_start();
                if (isset($_SESSION['user_id'])) {
                    echo '<li class="nav-item"><span class="nav-link">Bienvenido, ' . htmlspecialchars($_SESSION['user_name']) . '</span></li>';
                    echo '<li class="nav-item"><a class="nav-link" href="logout.php">Cerrar Sesión</a></li>';
                } else {
                    echo '<li class="nav-item"><a class="nav-link" href="login.html">Iniciar Sesión</a></li>';
                }
                ?>
            </ul>
        </nav>
    </header>
    <main class="container mt-4">
        <?php
        if (isset($_SESSION['user_id'])) {
            echo '<p class="lead">¡Disfruta de tu visita a MoonCafe, ' . htmlspecialchars($_SESSION['user_name']) . '!</p>';
        } else {
            echo '<p class="lead">Tu lugar ideal para disfrutar del mejor café.</p>';
            echo '<p>Descubre nuestra selección de cafés artesanales, deliciosos postres y un ambiente acogedor.</p>';
            echo '<p><a href="menu.php" class="btn btn-primary">Ver nuestro menú</a></p>';
        }
        ?>
    </main>
    <footer class="bg-light p-3 text-center mt-4">
        <p>&copy; 2025 MoonCafe. Todos los derechos reservados.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>