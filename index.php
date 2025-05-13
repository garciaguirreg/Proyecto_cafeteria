<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoonCafe</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQmQa7KBw0YJ/yJU5WC1cAZnAAlh/VFEGxqg5lnJ1yrn1iqFxCvKBCVcxyf6iYmIVLZznmQmBaRxSA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            color: #333;
        }
        header h1 {
            color: #000;
        }
        header .navbar .nav-link {
            color: #000 !important;
        }
        header .navbar .nav-link:hover {
            color: #555 !important;
        }
        .hero {
            background-image: url('images/cafe_portada.jpg');
            background-size: cover;
            background-position: center;
            color: black;
            text-align: center;
            padding: 100px 0;
            margin-bottom: 30px;
        }
        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .features {
            padding: 40px 0;
            text-align: center;
        }
        .feature-item {
            margin-bottom: 30px;
        }
        .feature-item i {
            font-size: 2rem;
            color: #a0522d;
            margin-bottom: 15px;
        }
        .feature-item h3 {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <header class="bg-light p-3 text-center">
        <h1>Bienvenido a MoonCafe</h1>
        <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
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

    <main>
        <section class="hero">
            <div class="container">
                
            </div>
        </section>

         <div class="container">
                <h3>El Mejor Café de El Salvador</h3>
        <p class="mt-3">Descubre una experiencia única con nuestros granos selectos y métodos de preparación artesanales.</p> 
            </div>
       

        <section class="container features">
            <div class="row">
                <div class="col-md-4 feature-item">
                    <i class="fas fa-coffee"></i> <h3>Café de Origen</h3>
                    <p>Selección exclusiva de granos de las mejores regiones de El Salvador.</p>
                </div>
                <div class="col-md-4 feature-item">
                    <i class="fas fa-utensils"></i> <h3>Deliciosos Acompañamientos</h3>
                    <p>Disfruta de nuestros postres, sándwiches y otras delicias.</p>
                </div>
                <div class="col-md-4 feature-item">
                    <i class="fas fa-users"></i> <h3>Ambiente Acogedor</h3>
                    <p>Un espacio perfecto para relajarte y disfrutar de tu café.</p>
                </div>
            </div>
        </section>
        <section class="cafe-images">
    <div class="container">
        <h2 class="mb-4">Nuestra Pasión por el Café</h2>
        <div class="row">
            <div class="col-md-6 cafe-image-item">
                <img src="images/cafe_preparacion.jpg" alt="Preparación de Café" class="img-fluid">
                <p class="text-center mt-2 text-muted">Preparación</p>
            </div>
            <div class="col-md-6 cafe-image-item">
                <img src="images/granos_cafe.jpg" alt="Granos de Café" class="img-fluid">
                <p class="text-center mt-2 text-muted">Granos Selectos</p>
            </div>
            <div class="col-md-6 cafe-image-item">
                <img src="images/taza_cafe.jpg" alt="Taza de Café" class="img-fluid">
                <p class="text-center mt-2 text-muted">Disfruta Cada Sorbo</p>
            </div>
            <div class="col-md-6 cafe-image-item">
                <img src="images/ambiente_cafe.jpg" alt="Ambiente del Café" class="img-fluid">
                <p class="text-center mt-2 text-muted">Un Lugar para Compartir</p>
            </div>
        </div>
    </div>
</section>

        <div class="container mt-4">
            <?php
            if (isset($_SESSION['user_id'])) {
                echo '<p class="lead">¡Disfruta de tu visita a MoonCafe, ' . htmlspecialchars($_SESSION['user_name']) . '!</p>';
            } else {
                echo '<p class="lead">Tu lugar ideal para disfrutar del mejor café.</p>';
                echo '<p>Descubre nuestra selección de cafés artesanales, deliciosos postres y un ambiente acogedor.</p>';
            }
            ?>
        </div>
    </main>

    <footer class="bg-light p-3 text-center mt-4">
        <p>&copy; 2025 MoonCafe. Todos los derechos reservados.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/your_fontawesome_kit.js" crossorigin="anonymous"></script>
</body>
</html>