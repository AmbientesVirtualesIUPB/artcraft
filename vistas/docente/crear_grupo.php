<?php
// Verificar si la sesión ya está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ajustar la ruta de inclusión para GrupoClan.php
require_once BASE_PATH . '/controladores/GrupoClan.php';

// Verificar si el usuario está autenticado y tiene permisos de docente
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] !== 1) {
    header("Location: ../../index.php");
    exit();
}

$message = "";

// Procesar el formulario al enviarlo
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreGrupo = $_POST['nombre'];
    $docenteId = $_SESSION['usuario']['id']; // ID del docente desde la sesión

    // Crear una instancia de la clase y llamar al método crearGrupo
    $grupoClan = new GrupoClan();
    $message = $grupoClan->crearGrupo($nombreGrupo, $docenteId);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Grupo</title>
</head>
<body>
    <h2>Crear Grupo</h2>

    <form method="POST" action="">
        <label for="nombre">Nombre del Grupo:</label>
        <input type="text" id="nombre" name="nombre" required>
        <button type="submit">Crear Grupo</button>
    </form>

    <?php if (!empty($message)): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
</body>
</html>
