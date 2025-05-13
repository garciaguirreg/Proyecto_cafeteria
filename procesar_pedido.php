<?php
    header('Content-Type: application/json');

    $host = 'localhost';
    $dbname = 'mooncafe_db';
    $user = 'root';
    $db_password = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error de conexión a la base de datos: ' . $e->getMessage()]);
        exit();
    }

    if (isset($_GET['termino']) && !empty($_GET['termino'])) {
        $termino = htmlspecialchars($_GET['termino']);
        $termino_con_wildcard = '%' . $termino . '%';

        $stmt = $pdo->prepare("SELECT id, nombre, descripcion, precio FROM productos WHERE nombre LIKE :termino OR descripcion LIKE :termino");
        $stmt->bindParam(':termino', $termino_con_wildcard, PDO::PARAM_STR);
        $stmt->execute();
        $resultados = $stmt->fetchAll();

        echo json_encode($resultados);
    } else {
        echo json_encode([]); // Si no hay término de búsqueda, devuelve un array vacío
    }
?><?php
    header('Content-Type: application/json');

    $host = 'localhost';
    $dbname = 'mooncafe_db';
    $user = 'root';
    $db_password = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => 'Error de conexión a la base de datos: ' . $e->getMessage()]);
        exit();
    }

    $json_data = file_get_contents('php://input');
    $pedido = json_decode($json_data, true);

    if ($pedido && is_array($pedido) && !empty($pedido)) {
        $fecha_pedido = date('Y-m-d H:i:s');

        foreach ($pedido as $item) {
            $nombre_producto = $item['nombre'];
            $cantidad = $item['cantidad'];

            // **TODO: Aquí deberías tener una tabla 'pedidos' y posiblemente una tabla 'detalles_pedido'**
            // Por simplicidad, vamos a insertar solo en una tabla 'pedidos' con los detalles del item.
            // En una aplicación real, sería mejor normalizar esto.

            $stmt = $pdo->prepare("INSERT INTO pedidos (fecha_pedido, nombre_producto, cantidad) VALUES (:fecha, :nombre, :cantidad)");
            $stmt->bindParam(':fecha', $fecha_pedido);
            $stmt->bindParam(':nombre', $nombre_producto);
            $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);

            if (!$stmt->execute()) {
                echo json_encode(['success' => false, 'error' => 'Error al guardar el pedido: ' . $stmt->errorInfo()[2]]);
                exit();
            }
        }

        echo json_encode(['success' => true, 'message' => 'Pedido guardado correctamente.']);
    } else {
        echo json_encode(['success' => false, 'error' => 'No se recibieron items en el pedido.']);
    }
?>