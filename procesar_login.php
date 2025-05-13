<?php
session_start(); // Iniciamos la sesión (necesario para mantener al usuario logueado)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // **TODO:** Realizar validaciones básicas de los datos recibidos

    // **Conectar a la base de datos
    $host = 'localhost'; // Reemplaza con tu host
    $dbname = 'mooncafe_db'; // Reemplaza con el nombre de tu base de datos
    $user = 'root'; // Reemplaza con tu usuario de la base de datos
    $db_password = ''; // Reemplaza con tu contraseña de la base de datos

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Buscar al usuario por su email
        $stmt = $pdo->prepare("SELECT id, nombre, password FROM usuarios WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Verificar la contraseña hasheada
            if (password_verify($password, $user['password'])) {
                // Contraseña correcta, iniciar sesión
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['nombre'];
                header("Location: index.html"); // Redirigir a la página principal
                exit();
            } else {
                $error_message = "Contraseña incorrecta.";
            }
        } else {
            $error_message = "No se encontró ningún usuario con ese email.";
        }

    } catch (PDOException $e) {
        $error_message = "Error de conexión a la base de datos: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error al Iniciar Sesión - MoonCafe</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-5">
        <header class="text-center mb-4">
            <h1>Error al Iniciar Sesión</h1>
        </header>
        <main class="col-md-6 offset-md-3">
            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger text-center" role="alert">
                    <?php echo htmlspecialchars($error_message); ?>
                    <p class="mt-2"><a href="login.html" class="alert-link">Volver a intentar iniciar sesión</a></p>
                </div>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>