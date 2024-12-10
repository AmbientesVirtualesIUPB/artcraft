<?php
session_start();

// Si ya hay una sesión activa, redirigir al dashboard
if (isset($_SESSION['usuario'])) {
    header("Location: dashboard.php");
    exit();
}

// Manejar mensajes de error
$message = isset($_GET['error']) ? $_GET['error'] : "";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="styles/login.css">
</head>
<body>
    <div class="login-container">
        <h2>Inicio de Sesión</h2>
        <form method="POST" action="controladores/login.php">
            <label for="usuario">Nombre de Usuario:</label>
            <input type="text" id="usuario" name="usuario" placeholder="Ingrese su nombre" required>
            <button type="submit">Iniciar Sesión</button>
        </form>
        <?php if (!empty($message)): ?>
            <p><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
    </div>
</body>
</html>