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

$message = "";

// Procesar el formulario al enviarlo
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idCreador = $_SESSION['usuario']['id']; // ID del creador desde la sesión
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $valor = $_POST['valor'];
    $visibilidad = $_POST['visibilidad'];
    $marco = $_POST['marco'];
    $fondo = $_POST['fondo'];
    $imagen = $_POST['imagen'];

    // Crear una instancia de la clase y llamar al método crearCarta
    $cartaController = new CartaController();
    $message = $cartaController->crearCarta($idCreador, $nombre, $descripcion, $valor, $visibilidad, $marco, $fondo, $imagen);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Carta</title>
</head>
<body>
    <h2>Crear Carta</h2>

    <form method="POST" action="">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required></textarea><br>

        <label for="valor">Valor:</label>
        <input type="number" id="valor" name="valor" required><br>

        <label for="visibilidad">Visibilidad:</label>
        <select id="visibilidad" name="visibilidad" required>
		    <option value="0">Personal (solo yo puedo verla)</option>
		    <option value="1">Pública (todos pueden verla)</option>
		</select><br>

        <label for="marco">Marco:</label>
        <select id="marco" name="marco" required>
		    <option value="public/images/marcos/marcos/01.png">01</option>
		    <option value="public/images/marcos/marcos/02.png">02</option>
		    <option value="public/images/marcos/marcos/03.png">03</option>
		    <option value="public/images/marcos/marcos/04.png">04</option>
		</select><br>

        <label for="fondo">Fondo:</label>
        <select id="fondo" name="fondo" required>
		    <option value="public/images/cartas/fondos/01.png">01</option>
		    <option value="public/images/cartas/fondos/02.png">02</option>
		    <option value="public/images/cartas/fondos/03.png">03</option>
		    <option value="public/images/cartas/fondos/04.png">04</option>
		    <option value="public/images/cartas/fondos/05.png">05</option>
		</select><br>

		<label for="imagen">Imagen:</label>
		<select id="imagen" name="imagen" required>
		    <option value="public/images/cartas/imagenes/01.png">01</option>
		    <option value="public/images/cartas/imagenes/02.png">02</option>
		    <option value="public/images/cartas/imagenes/03.png">03</option>
		    <option value="public/images/cartas/imagenes/04.png">04</option>
		    <option value="public/images/cartas/imagenes/05.png">05</option>
		    <option value="public/images/cartas/imagenes/06.png">06</option>
		    <option value="public/images/cartas/imagenes/07.png">07</option>
		    <option value="public/images/cartas/imagenes/08.png">08</option>
		</select><br>

        <button type="submit">Crear Carta</button>
    </form>

    <?php if (!empty($message)): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
</body>
</html>
