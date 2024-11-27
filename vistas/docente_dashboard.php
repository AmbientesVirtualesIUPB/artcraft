<h2>Dashboard del Docente</h2>
<p>Selecciona una opción para gestionar tu contenido:</p>

<ul>
    <li><a href="?view=crear_grupo">Crear Grupo</a></li>
    <li><a href="?view=crear_cartas">Crear Cartas</a></li>
    <li><a href="?view=mis_grupos">Mis Grupos</a></li>
    <li><a href="?view=mis_cartas">Mis Cartas</a></li>
    <li><a href="?view=reportes">Reportes</a></li>
    <li><a href="?view=notas">Notas</a></li>
</ul>

<hr>

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
