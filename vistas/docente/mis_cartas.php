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

// Obtener las cartas creadas por el usuario
$idCreador = $_SESSION['usuario']['id'];
$cartaController = new CartaController();
$cartas = $cartaController->obtenerCartasPorCreador($idCreador);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Cartas</title>
    <link rel="stylesheet" href="Styles/misCartas.css">
</head>
<body>

<div id="misCartasBody">
    <?php if (!empty($cartas)): ?>
        <ul class="cartas-lista">
            <?php foreach ($cartas as $carta): ?>
                <li class="carta-item"               
                    data-nombre="<?php echo htmlspecialchars($carta['nombre']); ?>" 
                    data-descripcion="<?php echo htmlspecialchars($carta['descripcion']); ?>"
                    data-valor="<?php echo htmlspecialchars($carta['valor']); ?>"
                    data-marco="<?php echo htmlspecialchars($carta['marco']); ?>"
                    data-fondo="<?php echo htmlspecialchars($carta['fondo']); ?>"
                    data-imagen="<?php echo htmlspecialchars($carta['imagen']); ?>">                    
                    <strong><?php echo htmlspecialchars($carta['nombre']); ?></strong>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No tienes cartas creadas.</p>
    <?php endif; ?>
</div>

<!-- Modal para mostrar la carta -->
<div id="modalCarta" class="modal">
    <div class="modal-content">
        <span class="close-btn" id="closeModal">&times;</span>
        <h2 id="modalNombre"></h2>
        <img id="modalMarco" src="" alt="Marco de la carta" >
        <img id="modalImagen" src="" alt="Imagen de la carta" >
        <p id="modalDescripcion"></p>
        <p><strong>Valor:</strong> <span id="modalValor"></span></p>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const cartas = document.querySelectorAll('.carta-item');
    const modal = document.getElementById('modalCarta');
    const closeModal = document.getElementById('closeModal');
    
    // Elementos dentro de la modal
    const modalNombre = document.getElementById('modalNombre');
    const modalDescripcion = document.getElementById('modalDescripcion');
    const modalValor = document.getElementById('modalValor');
    const modalMarco = document.getElementById('modalMarco');
    const modalImagen = document.getElementById('modalImagen');

    // Función para abrir la modal con los datos de la carta
    cartas.forEach(carta => {
        carta.addEventListener('click', function () {
            modalNombre.textContent = this.getAttribute('data-nombre');
            modalDescripcion.textContent = this.getAttribute('data-descripcion');
            modalValor.textContent = this.getAttribute('data-valor');
            modalMarco.src = this.getAttribute('data-marco');
            modalImagen.src = this.getAttribute('data-imagen');

            modal.style.display = "flex"; // Mostrar la modal
        });
    });

    // Cerrar la modal
    closeModal.addEventListener('click', function () {
        modal.style.display = "none";
    });

    // Cerrar la modal si se hace clic fuera de ella
    window.addEventListener('click', function (e) {
        if (e.target === modal) {
            modal.style.display = "none";
        }
    });
});
</script>

</body>
</html>
