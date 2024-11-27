<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once BASE_PATH . '/controladores/GrupoClan.php';

// Verificar si el usuario está autenticado y tiene permisos de docente
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] !== 1) {
    header("Location: ../../index.php");
    exit();
}

// Obtener los grupos del docente
$docenteId = $_SESSION['usuario']['id'];
$grupoClan = new GrupoClan();
$grupos = $grupoClan->obtenerGruposPorDocente($docenteId);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Grupos</title>
</head>
<body>
    <h2>Mis Grupos</h2>

    <?php if (!empty($grupos)): ?>
        <ul>
            <?php foreach ($grupos as $grupo): ?>
                <li>
                    <strong><?php echo htmlspecialchars($grupo['nombre']); ?></strong>
                    <a href="?view=gestionar_grupo&id=<?php echo $grupo['id']; ?>">Gestionar</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No tienes grupos creados.</p>
    <?php endif; ?>
</body>
</html>
