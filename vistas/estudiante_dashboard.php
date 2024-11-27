<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once BASE_PATH . '/controladores/UsuarioClan.php';

// Verificar si el usuario está autenticado y es estudiante
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] !== 0) {
    header("Location: ../../index.php");
    exit();
}

$estudianteId = $_SESSION['usuario']['id'];
$usuarioClan = new UsuarioClan();
$clanes = $usuarioClan->obtenerClanesPorEstudiante($estudianteId);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard del Estudiante</title>
</head>
<body>
    <h2>Mis Clanes</h2>

    <?php if (!empty($clanes)): ?>
        <ul>
            <?php foreach ($clanes as $clan): ?>
                <li>
                    <?php echo htmlspecialchars($clan['nombre_clan']); ?> 
                    (<?php echo htmlspecialchars($clan['nombre_grupo']); ?>)
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No estás inscrito en ningún clan.</p>
    <?php endif; ?>
</body>
</html>
