<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once BASE_PATH . '/controladores/CartaController.php';

// Verificar si el usuario está autenticado y tiene permisos de docente
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] !== 1) {
    header("Location: ../../index.php");
    exit();
}

// Obtener las cartas creadas por el usuario
$idCreador = $_SESSION['usuario']['id'];
$cartaController = new CartaController();
$cartas = $cartaController->obtenerCartasPorCreador($idCreador);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Cartas</title>
</head>
<body>
    <h2>Mis Cartas</h2>

    <?php if (!empty($cartas)): ?>
        <ul>
            <?php foreach ($cartas as $carta): ?>
                <li>
                    <strong><?php echo htmlspecialchars($carta['nombre']); ?></strong>:
                    <?php echo htmlspecialchars($carta['descripcion']); ?>
                    (Valor: <?php echo htmlspecialchars($carta['valor']); ?>)
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No tienes cartas creadas.</p>
    <?php endif; ?>
</body>
</html>
