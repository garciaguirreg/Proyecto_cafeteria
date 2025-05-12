<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $id = $_POST["id"];
    $host = 'localhost'; 
    $dbname = 'mooncafe_db'; 
    $user = 'root'; 
    $db_password = ''; 

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // **TODO:** Hashear la contraseña de forma segura antes de guardarla
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO usuarios (id, nombre, email, password) VALUES (:id, :nombre, :email, :password)");
        $stmt->bindParam(':id', $id);
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