<?php
// Conexión a la base de datos (ajusta tus credenciales SI ES NECESARIO)
$host = 'localhost';
$dbname = 'mooncafe_db';
$user = 'root';
$db_password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}

// Recoger los términos de búsqueda
$nombre_busqueda = isset($_GET['nombre']) ? $_GET['nombre'] : '';
$categoria_busqueda = isset($_GET['categoria']) ? $_GET['categoria'] : '';

// Construir la consulta SQL dinámicamente
$sql = "SELECT * FROM productos WHERE 1=1";

if (!empty($nombre_busqueda)) {
    $sql .= " AND nombre LIKE :nombre";
}

if (!empty($categoria_busqueda)) {
    $sql .= " AND categoria = :categoria";
}

$stmt = $pdo->prepare($sql);

// Bindear los parámetros si existen
if (!empty($nombre_busqueda)) {
    $stmt->bindValue(':nombre', '%' . $nombre_busqueda . '%', PDO::PARAM_STR);
}

if (!empty($categoria_busqueda)) {
    $stmt->bindValue(':categoria', $categoria_busqueda, PDO::PARAM_STR);
}

$stmt->execute();
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de la Búsqueda - MoonCafe</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-5">
        <header class="text-center mb-4">
            <h1>Resultados de la Búsqueda</h1>
            <p><a href="menu.php">Volver al Menú</a></p>
        </header>
        <main class="shadow-sm p-4 rounded">
            <?php if (empty($resultados)): ?>
                <p>No se encontraron productos con los criterios de búsqueda.</p>
            <?php else: ?>
                <h2>Productos Encontrados:</h2>
                <ul class="list-group">
                    <?php foreach ($resultados as $producto): ?>
                        <li class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <?php if (!empty($producto['imagen'])): ?>
                                        <img src="images/<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>" class="img-thumbnail" style="max-width: 150px;">
                                    <?php else: ?>
                                        <p class="text-muted">Sin imagen</p>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-9">
                                    <h3><?php echo htmlspecialchars($producto['nombre']); ?></h3>
                                    <p class="precio">$<?php echo htmlspecialchars($producto['precio']); ?></p>
                                    <p class="descripcion"><?php echo htmlspecialchars($producto['descripcion']); ?></p>
                                    <?php if (!empty($producto['categoria'])): ?>
                                        <p class="text-muted">Categoría: <?php echo htmlspecialchars($producto['categoria']); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>