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
        <link rel="stylesheet" href="Styles/misCartas.css">
    </head>
    <div id="misCartasBody">
            <?php if (!empty($cartas)): ?>
                <ul class="cartas-lista">
                    <?php foreach ($cartas as $carta): ?>
                        <li class="carta-item">
                            <div class="carta-nombre">
                                <strong><?php echo htmlspecialchars($carta['nombre']); ?></strong>
                            </div>
                            <div class="carta-descripcion">
                                <?php echo htmlspecialchars($carta['descripcion']); ?>
                            </div>
                            <div class="carta-valor">
                                Valor: <span><?php echo htmlspecialchars($carta['valor']); ?></span>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No tienes cartas creadas.</p>
            <?php endif; ?>
        </div>
</html>
