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
<?php if (!empty($message)): ?>
    <p class="<?php echo strpos($message, 'Error') !== false ? 'error' : 'success'; ?>">
        <?php echo htmlspecialchars($message); ?>
    </p>
<?php endif; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">    
    <link rel="stylesheet" href="styles/crearCarta.css">
</head>

<div class="crear-carta">
    <h2 class="titulo-carta">Crear Carta</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>

        <!-- Visualización previa de la carta -->
        <div class="visualizacion-carta" id="preview-card">
            <span class="nombre" id="card-name">Nombre</span>
            <span class="valor" id="card-value">0</span>
            <img id="card-frame" style="position:absolute; width:100%; height:100%;">
            <img id="card-image" style="position:absolute; width:60%; height:60%; top:20%; left:20%;">
            <span class="descripcion" id="card-description">Descripción</span>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required></textarea>
        </div>

        <div class="form-group">
            <label for="valor">Valor:</label>
            <input type="number" id="valor" name="valor" required>
        </div>

        <div class="horizontal-group">
            <div class="form-group">
                <label for="marco">Marco:</label>
                <select id="marco" name="marco" required>
                    <option value="public/images/cartas/marcos/01.png">01</option>
                    <option value="public/images/cartas/marcos/02.png">02</option>
                    <option value="public/images/cartas/marcos/03.png">03</option>
                    <option value="public/images/cartas/marcos/04.png">04</option>
                </select>
            </div>

            <div class="form-group">
                <label for="fondo">Fondo:</label>
                <select id="fondo" name="fondo" required>
                    <option value="public/images/cartas/fondos/01.png">01</option>
                    <option value="public/images/cartas/fondos/02.png">02</option>
                    <option value="public/images/cartas/fondos/03.png">03</option>
                    <option value="public/images/cartas/fondos/04.png">04</option>
                    <option value="public/images/cartas/fondos/05.png">05</option>
                </select>
            </div>

            <div class="form-group">
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
                </select>
            </div>
            <div class="form-group">
            <label for="visibilidad">Visibilidad:</label>
            <select id="visibilidad" name="visibilidad" required>
                <option value="0">Personal (solo yo puedo verla)</option>
                <option value="1">Pública (todos pueden verla)</option>
            </select>
        </div>
        </div>

        <button type="submit" class="btn-crear">Crear Carta</button>
    </form>
</div>
<script>
    // Actualizar vista previa de la carta
    const nombreInput = document.getElementById('nombre');
    const descripcionInput = document.getElementById('descripcion');
    const valorInput = document.getElementById('valor');
    const marcoSelect = document.getElementById('marco');
    const fondoSelect = document.getElementById('fondo');
    const imagenSelect = document.getElementById('imagen');

    const previewCard = document.getElementById('preview-card');
    const cardName = document.getElementById('card-name');
    const cardValue = document.getElementById('card-value');
    const cardFrame = document.getElementById('card-frame');
    const cardImage = document.getElementById('card-image');
    const cardDescription = document.getElementById('card-description');

    nombreInput.addEventListener('input', () => cardName.textContent = nombreInput.value);
    descripcionInput.addEventListener('input', () => cardDescription.textContent = descripcionInput.value);
    valorInput.addEventListener('input', () => cardValue.textContent = valorInput.value);
    marcoSelect.addEventListener('change', () => cardFrame.src = marcoSelect.value);
    fondoSelect.addEventListener('change', () => previewCard.style.backgroundImage = `url(${fondoSelect.value})`);
    imagenSelect.addEventListener('change', () => cardImage.src = imagenSelect.value);
</script>


