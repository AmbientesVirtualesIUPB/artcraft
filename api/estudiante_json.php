<?php
require_once '../config/config.php';
require_once '../controladores/UsuarioClan.php';

 
$estudianteId = $_GET['id'];
$usuarioClan = new UsuarioClan();
$clanes = $usuarioClan->obtenerClanesPorEstudiante($estudianteId);
?>

<?php 
if (!empty($clanes)):
    echo (json_encode($clanes));
    /*
    foreach ($clanes as $clan):
        echo htmlspecialchars($clan['nombre_clan']);
        echo htmlspecialchars($clan['nombre_grupo']); 
    endforeach; */
else: ?>
    <p>No estás inscrito en ningún clan.</p>
<?php 
endif
?>
