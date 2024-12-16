<?php
require_once '../controladores/UsuarioClan.php';

 
$estudianteId = $_GET['id'];
$usuarioClan = new UsuarioClan();
$clanes = $usuarioClan->obtenerClanesPorEstudiante($estudianteId);
?>

<?php if (!empty($clanes)): ?>
    <ul>
        <?php foreach ($clanes as $clan): ?>
            <li>
                <?php echo htmlspecialchars($clan['nombre_clan']); ?> 
                (<?php echo htmlspecialchars($clan['nombre_grupo']); ?>)
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No estás inscrito en ningún clan.</p>
<?php endif; ?>
