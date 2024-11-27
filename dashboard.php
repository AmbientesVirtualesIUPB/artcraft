<?php
session_start();
require_once 'config/config.php';
// Verificar si la sesión está activa y si existe el usuario
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

// Obtener el usuario y su tipo desde la sesión
$usuario = $_SESSION['usuario'];
$tipoUsuario = $usuario['tipo'];

// Procesar la acción de cerrar sesión
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

// Determinar la vista a cargar según el tipo de usuario
$vista = "";
switch ($tipoUsuario) {
    case 0:
        $vista = "vistas/estudiante_dashboard.php";
        break;
    case 1:
        $vista = "vistas/docente_dashboard.php";
        break;
    case 2:
        $vista = "vistas/administrador_dashboard.php";
        break;
    default:
        echo "Tipo de usuario no reconocido.";
        exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h1>  Bienvenido, <?php echo htmlspecialchars($usuario['usuario']); ?></h1>
    <a href="dashboard.php?action=logout">Cerrar Sesión</a>
    <hr>
    <?php include $vista; ?>
</body>
</html>
