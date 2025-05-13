<?php

// Conectar a la base de datos
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

if (isset($_GET['termino_busqueda']) && !empty($_GET['termino_busqueda'])) {
    $termino = $_GET['termino_busqueda'];
    // **TODO:** Escapar el término de búsqueda para prevenir inyección SQL
    $termino = htmlspecialchars($termino);

    // Consulta a la base de datos (ejemplo buscando en el nombre y descripción)
    $stmt = $pdo->prepare("SELECT * FROM productos WHERE nombre LIKE :termino OR descripcion LIKE :termino");
    $stmt->bindValue(':termino', '%' . $termino . '%');
    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // **TODO:** Mostrar los resultados en un formato HTML adecuado
    echo "<h2>Resultados de la búsqueda para: " . htmlspecialchars($termino) . "</h2>";
    if ($resultados) {
        echo "<ul>";
        foreach ($resultados as $producto) {
            echo "<li>" . htmlspecialchars($producto['nombre']) . " - $" . htmlspecialchars($producto['precio']) . "</li>";
            // Puedes mostrar más detalles aquí
        }
        echo "</ul>";
    } else {
        echo "<p>No se encontraron productos que coincidan con tu búsqueda.</p>";
    }
} else {
    echo "<p>Por favor, introduce un término de búsqueda.</p>";
}

?>