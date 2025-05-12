<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú - MoonCafe</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .menu-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .menu-item-details {
            flex-grow: 1;
        }
        .order-controls {
            display: flex;
            align-items: center;
        }
        .quantity-input {
            width: 60px;
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <header class="text-center mb-4">
            <h1>Menú de MoonCafe</h1>
            <nav class="mt-2">
                <a href="index.html" class="btn btn-link">Inicio</a>
                <a href="menu.php" class="btn btn-link">Menú</a>
                <a href="crear_cuenta.html" class="btn btn-link">Crear Cuenta</a>
                <a href="novedades.html" class="btn btn-link">Novedades</a>
                <a href="contacto.html" class="btn btn-link">Contacto</a>
            </nav>
        </header>

        <main class="shadow-sm p-4 rounded">
            <form class="mb-3">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Buscar producto...">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                    </div>
                </div>
            </form>

            <section id="cafes" class="mb-4">
                <h2>Nuestros Cafés</h2>
                <div class="menu-item">
                    <div class="menu-item-details">
                        <h3>Espresso</h3>
                        <p class="precio">$2.50</p>
                        <p class="descripcion">Un shot de café concentrado y aromático.</p>
                    </div>
                    <div class="order-controls">
                        <label for="espresso_qty">Cantidad:</label>
                        <input type="number" id="espresso_qty" name="espresso_qty" class="quantity-input" value="0" min="0">
                        <button class="btn btn-success btn-sm">Añadir</button>
                    </div>
                </div>
                </section>

            <section id="bebidas-frias" class="mb-4">
                <h2>Bebidas Frías</h2>
                </section>

            <section id="comida">
                <h2>Nuestra Comida</h2>
                </section>

            <button class="btn btn-primary btn-block mt-3">Ver Pedido</button>
        </main>
    </div>
</body>
</html>