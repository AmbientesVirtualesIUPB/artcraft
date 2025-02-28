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

    // Seleccionar una carpeta al azar (1, 2 o 3)
    $carpetas = ['1', '2', '3'];
    $carpetaSeleccionada = $carpetas[array_rand($carpetas)];

    // Cargar las imágenes de la carpeta seleccionada
    $image1 = "public/images/arte/parallax/$carpetaSeleccionada/1.png";
    $image2 = "public/images/arte/parallax/$carpetaSeleccionada/2.png";
    $image3 = "public/images/arte/parallax/$carpetaSeleccionada/3.png";

    $carpetaIzquierda = $carpetas[array_rand($carpetas)];
    while ($carpetaIzquierda == $carpetaSeleccionada) {
        $carpetaIzquierda = $carpetas[array_rand($carpetas)]; // Asegurarse de que la carpeta izquierda no sea la misma que la derecha
    }

    $image12 = "public/images/arte/parallax/$carpetaIzquierda/1.png";
    $image22 = "public/images/arte/parallax/$carpetaIzquierda/2.png";
    $image32 = "public/images/arte/parallax/$carpetaIzquierda/3.png";
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
        <div class="parallax-container">
            <img class="imgDerParallax parallaxC1" src="<?php echo $image1; ?>" data-speed="0.5">
            <img class="imgDerParallax parallaxC2 " src="<?php echo $image2; ?>" data-speed="2">
            <img class="imgDerParallax parallaxC3 " src="<?php echo $image3; ?>" data-speed="2">
        </div>        
        <div class="parallax-container">
            <img class="imgIzqParallax parallaxC1" src="<?php echo $image12; ?>" data-speed="0.5">
            <img class="imgIzqParallax parallaxC2 " src="<?php echo $image22; ?>" data-speed="1">
            <img class="imgIzqParallax parallaxC3 " src="<?php echo $image32; ?>" data-speed="2">
        </div>        
        

        <div class="vista">
            <script src="Javascript/Dashboard.js"></script>
            <?php include $vista; ?>
        </div>        
    </div>
</body>
</html>