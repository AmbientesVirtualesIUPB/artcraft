<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once BASE_PATH . '/controladores/GrupoClan.php';
require_once BASE_PATH . '/controladores/UsuarioClan.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] !== 1) {
    header("Location: ../../index.php");
    exit();
}

$grupoId = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($grupoId <= 0) {
    echo "<p>ID de grupo inválido.</p>";
    exit();
}

$message = "";

// Procesar formularios
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'add_carta') {
        // Agregar carta al grupo
        $idCarta = intval($_POST['id_carta']);
        $grupoClan = new GrupoClan();
        $message = $grupoClan->agregarCartaAlGrupo($grupoId, $idCarta);
    } elseif ($action === 'add_clan') {
        // Crear clan en el grupo
        $nombreClan = $_POST['nombre_clan'];
        $grupoClan = new GrupoClan();
        $message = $grupoClan->crearClanEnGrupo($grupoId, $nombreClan);
    } elseif ($action === 'add_student') {
        // Agregar estudiante a un clan
        $idUsuario = intval($_POST['id_usuario']);
        $idClan = intval($_POST['id_clan']);
        $usuarioClan = new UsuarioClan();
        $message = $usuarioClan->agregarUsuarioAClan($idUsuario, $idClan);
    }
}

// Obtener los clanes del grupo
$grupoClan = new GrupoClan();
$clanes = $grupoClan->obtenerClanesPorGrupo($grupoId);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Grupo</title>
    <link rel="stylesheet" href="Styles/gestionarGrupo.css">
</head>
    <div id="gestionarGrupo">
        <h2>Gestionar Grupo: <?php echo $grupoId; ?></h2>

        <h3>Agregar Carta al Grupo</h3>
        <form method="POST" action="">
            <input type="hidden" name="action" value="add_carta">
            <label for="id_carta">ID de la Carta:</label>
            <input type="number" id="id_carta" name="id_carta" required>
            <button type="submit">Agregar Carta</button>
        </form>

        <h3>Crear Clan en el Grupo</h3>
        <form method="POST" action="">
            <input type="hidden" name="action" value="add_clan">
            <label for="nombre_clan">Nombre del Clan:</label>
            <input type="text" id="nombre_clan" name="nombre_clan" required>
            <button type="submit">Crear Clan</button>
        </form>

        <h3>Clanes del Grupo</h3>
        <?php if (!empty($clanes)): ?>
            <ul class="cartas-lista">
                <?php foreach ($clanes as $clan): ?>
                    <li class="carta-item">
                        <strong><?php echo htmlspecialchars($clan['nombre']); ?></strong> 
                        (ID: <?php echo $clan['id']; ?>, Oro: <?php echo $clan['oro']; ?>)
                        <a href="?view=gestionar_clan&id=<?php echo $clan['id']; ?>">Gestionar Clan</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No hay clanes asociados a este grupo.</p>
        <?php endif; ?>

        <?php if (!empty($message)): ?>
            <p><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
    </div>
</html>
