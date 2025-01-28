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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="Styles/dashboard.css">
</head>
<body>
    <div class="main-content">
        <div class="header">
            <div class="logo-section">
                <img src="public/images/dashboard/LOGO-PASCUAL-BRAVO.png" alt="Logo Pascual Bravo">
                <img src="public/images/dashboard/Logo-ArtCraft.png" alt="Logo ArtCraft">
            </div>
            <a href="dashboard.php?action=logout">Cerrar Sesión</a>
        </div>
        <img class="imgDerParallax parallaxC1" src="public/images/arte/parallax/1/1.png">
        <img class="imgDerParallax parallaxC2" src="public/images/arte/parallax/1/2.png">
        <div class="vista">
            <?php include $vista; ?>
        </div>        
    </div>
</body>
</html>