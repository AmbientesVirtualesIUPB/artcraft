<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once BASE_PATH . '/controladores/UsuarioClan.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] !== 1) {
    header("Location: ../../index.php");
    exit();
}

$clanId = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($clanId <= 0) {
    echo "<p>ID de clan inválido.</p>";
    exit();
}

$message = "";
$usuarioClan = new UsuarioClan();

// Procesar formularios
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'add_student') {
        // Agregar estudiante al clan
        $idUsuario = intval($_POST['id_usuario']);
        $message = $usuarioClan->agregarUsuarioAClan($idUsuario, $clanId);
    } elseif ($action === 'remove_student') {
        // Eliminar estudiante del clan
        $idUsuario = intval($_POST['id_usuario']);
        $message = $usuarioClan->eliminarUsuarioDeClan($idUsuario, $clanId);
    }
}

// Obtener miembros del clan
$miembros = $usuarioClan->obtenerMiembrosPorClan($clanId);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Clan</title>
    <link rel="stylesheet" href="Styles/gestionarClan.css">
</head>
<div id="gestionClanBody">
    <h2>Gestionar Clan: <?php echo $clanId; ?></h2>

    <h3>Miembros del Clan</h3>
    <?php if (!empty($miembros)): ?>
        <ul>
            <?php foreach ($miembros as $miembro): ?>
                <li>
                    <?php echo htmlspecialchars($miembro['nombre']); ?> (ID: <?php echo $miembro['id']; ?>)
                    <form method="POST" action="" style="display:inline;">
                        <input type="hidden" name="action" value="remove_student">
                        <input type="hidden" name="id_usuario" value="<?php echo $miembro['id']; ?>">
                        <button type="submit">Eliminar</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No hay miembros en este clan.</p>
    <?php endif; ?>

    <h3>Agregar Estudiante al Clan</h3>
    <form method="POST" action="">
        <input type="hidden" name="action" value="add_student">
        <label for="id_usuario">ID Estudiante:</label>
        <input type="number" id="id_usuario" name="id_usuario" required>
        <button type="submit">Agregar</button>
    </form>

    <?php if (!empty($message)): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    </div>
</html>
