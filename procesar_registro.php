<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // **TODO:** Realizar validaciones más robustas aquí

    // **TODO:** Conectar a la base de datos MySQL con PDO
    $host = 'localhost'; // Reemplaza con tu host
    $dbname = 'mooncafe_db'; // Reemplaza con el nombre de tu base de datos
    $user = 'tu_usuario'; // Reemplaza con tu usuario de la base de datos
    $db_password = 'tu_contraseña'; // Reemplaza con tu contraseña de la base de datos

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // **TODO:** Hashear la contraseña de forma segura antes de guardarla
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (:nombre, :email, :password)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);

        if ($stmt->execute()) {
            echo "<div class='container mt-5'><div class='alert alert-success text-center' role='alert'>Cuenta creada exitosamente. <a href='login.html' class='alert-link'>Iniciar sesión</a></div></div>";
        } else {
            echo "<div class='container mt-5'><div class='alert alert-danger text-center' role='alert'>Error al crear la cuenta. Inténtalo de nuevo.</div></div>";
        }

    } catch (PDOException $e) {
        echo "<div class='container mt-5'><div class='alert alert-danger text-center' role='alert'>Error de conexión a la base de datos: " . $e->getMessage() . "</div></div>";
    }
} else {
    header("Location: crear_cuenta.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesando Registro - MoonCafe</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    </body>
</html>