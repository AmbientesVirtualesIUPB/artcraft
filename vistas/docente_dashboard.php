<?php 
    // Obtener el usuario
    $usuario = $_SESSION['usuario'];
?>

<head>    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/docenteDashboard.css">
</head>
    <div class="dashboard-docente">
        <div class="Docente">
            <img src="public/images/dashboard/user.png" alt="iconoUser"> <p class="tipoPerfil"><?php echo htmlspecialchars($usuario['usuario']); ?></p>
        </div>
        <div class="messaje">
            <img src="public/images/dashboard/Icono.png" alt="iconoUser">
            <p>Selecciona una opción del menu para gestionar tu contenido:</p>
        </div>        

        <div class="menu-opciones"> <!-- Contenedor principal -->        
        <!-- Columna 2 fila 1: Botones con grids anidados -->       
            <div class="btn1" role="button" onclick="window.location.href='?view=crear_grupo';" style="cursor: pointer;">
                <div class="btn1-2 b1"></div>
                <div class="btn1-2 b2"></div>
                <div class="btn1-2 b3"></div>
                <div class="btn1-2 b4"></div>
                <div class="btn1-2 b5">Crear Grupo</div>
                <div class="btn1-2 b6"></div>
                <div class="btn1-2 b7"></div>
                <div class="btn1-2 b8"></div>
                <div class="btn1-2 b9"></div>                
            </div>      
        <!-- Columna 2 fila 2: Botones con grids anidados -->      
            <div class="btn2" role="button" onclick="window.location.href='?view=crear_cartas';" style="cursor: pointer;">
                <div class="btn2-2 b1"></div>
                <div class="btn2-2 b2"></div>
                <div class="btn2-2 b3"></div>
                <div class="btn2-2 b4"></div>
                <div class="btn2-2 b5">Crear Cartas</div>
                <div class="btn2-2 b6"></div>
                <div class="btn2-2 b7"></div>
                <div class="btn2-2 b8"></div>
                <div class="btn2-2 b9"></div>
            </div>        
        <!-- Columna 2 fila 3: Botones con grids anidados -->
            <div class="btn3" role="button" onclick="window.location.href='?view=mis_grupos';" style="cursor: pointer;">
                <div class="btn3-2 b1"></div>
                <div class="btn3-2 b2"></div>
                <div class="btn3-2 b3"></div>
                <div class="btn3-2 b4"></div>
                <div class="btn3-2 b5">Mis Grupos</div>
                <div class="btn3-2 b6"></div>
                <div class="btn3-2 b7"></div>
                <div class="btn3-2 b8"></div>
                <div class="btn3-2 b9"></div>
            </div>
        <!-- Columna 3 fila 1: Botones con grids anidados --> 
            <div class="btn4" role="button" onclick="window.location.href='?view=mis_cartas';" style="cursor: pointer;">
                <div class="btn4-2 b1"></div>
                <div class="btn4-2 b2"></div>
                <div class="btn4-2 b3"></div>
                <div class="btn4-2 b4"></div>
                <div class="btn4-2 b5">Mis Cartas</div>
                <div class="btn4-2 b6"></div>
                <div class="btn4-2 b7"></div>
                <div class="btn4-2 b8"></div>
                <div class="btn4-2 b9"></div>
            </div>
        <!-- Columna 3 fila 2: Botones con grids anidados -->
            <div class="btn5" role="button" onclick="window.location.href='?view=reportes';" style="cursor: pointer;">
                <div class="btn5-2 b1"></div>
                <div class="btn5-2 b2"></div>
                <div class="btn5-2 b3"></div>
                <div class="btn5-2 b4"></div>
                <div class="btn5-2 b5">Reportes</div>
                <div class="btn5-2 b6"></div>
                <div class="btn5-2 b7"></div>
                <div class="btn5-2 b8"></div>
                <div class="btn5-2 b9"></div>
            </div>  
        <!-- Columna 3 fila 3: Botones con grids anidados -->
            <div class="btn6" role="button" onclick="window.location.href='?view=notas';" style="cursor: pointer;">
                <div class="btn6-2 b1"></div>
                <div class="btn6-2 b2"></div>
                <div class="btn6-2 b3"></div>
                <div class="btn6-2 b4"></div>
                <div class="btn6-2 b5">Notas</div>
                <div class="btn6-2 b6"></div>
                <div class="btn6-2 b7"></div>
                <div class="btn6-2 b8"></div>
                <div class="btn6-2 b9"></div>
            </div>
        </div>
        <div class="separador">
            <img src="public/images/dashboard/Separador.png" alt="Separador">
        </div>
    </div>
<?php

// Determinar la vista seleccionada
$view = isset($_GET['view']) ? $_GET['view'] : 'default';

switch ($view) {
    case 'crear_grupo':
        include 'vistas/docente/crear_grupo.php';
        break;
    case 'crear_cartas':
        include 'vistas/docente/crear_cartas.php';
        break;
    case 'mis_grupos':
        include 'vistas/docente/mis_grupos.php';
        break;
    case 'mis_cartas':
        include 'vistas/docente/mis_cartas.php';
        break;
    case 'gestionar_grupo':
        include 'vistas/docente/gestionar_grupo.php';
        break;
    case 'gestionar_clan': // Nueva vista para gestionar un clan
        include 'vistas/docente/gestionar_clan.php';
        break;
    case 'reportes':
        include 'vistas/docente/reportes.php';
        break;
    case 'notas':
        include 'vistas/docente/notas.php';
        break;
    default:
        echo "<p>Selecciona una opción del menú para empezar.</p>";
        break;
}
?>
