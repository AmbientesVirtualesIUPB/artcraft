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
        <div class="estuche" id="resize-box">
            <div class="carta">
                <div class="fondo" ></div>
                <img id="modalImagen" class="dise_imagen" >
                <div id="modalMarco" class="marco" ></div>
                <div class="info" ></div>
                <div class="titulo" id="modalNombre"></div>                
                <div id="modalDescripcion" class="descripcion"></div>
                <div id="modalValor" class="valor"></div>
            </div>
            <span class="close-btn" id="closeModal">&times;</span>
        </div>
</div>

<script>
    const resizeBox = document.getElementById('resize-box');

document.addEventListener('DOMContentLoaded', function () {
    const cartas = document.querySelectorAll('.carta-item');
    const modal = document.getElementById('modalCarta');
    const closeModal = document.getElementById('closeModal');
    
    // Elementos dentro de la modal
    const modalFondo = document.querySelector('.fondo'); 
    const modalInfo = document.querySelector('.info');
    const modalMarco = document.getElementById('modalMarco');
    const modalImagen = document.getElementById('modalImagen');
    const modalNombre = document.getElementById('modalNombre');
    const modalDescripcion = document.getElementById('modalDescripcion');
    const modalValor = document.getElementById('modalValor');

    // Función para abrir la modal con los datos de la carta
    cartas.forEach(carta => {
        carta.addEventListener('click', function () {
            modalNombre.textContent = this.getAttribute('data-nombre');
            modalDescripcion.textContent = this.getAttribute('data-descripcion');
            modalValor.textContent = this.getAttribute('data-valor');

            modalFondo.style.backgroundImage = 'url(' + this.getAttribute('data-fondo') + ')';
            modalMarco.style.backgroundImage = 'url(' + this.getAttribute('data-marco') + ')';
            modalInfo.style.backgroundImage = 'url("public/images/cartas/Elementos/informacion.png")';
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
function updateDimensions(newWidth) {
        // Cambiar las dimensiones del contenedor
        resizeBox.style.width = (newWidth*0.689) + 'px';
        resizeBox.style.height = newWidth + 'px';

        // Calcular un nuevo tamaño de fuente proporcional al ancho del contenedor
        const fontSize = newWidth / 20; // Ajusta este factor según lo que prefieras

        // Actualizar el tamaño de la fuente de los elementos
        document.querySelectorAll('.titulo, .descripcion, .valor').forEach(element => {
            element.style.fontSize = fontSize + 'px';
        });
    }
    updateDimensions(window.innerHeight*0.6);
</script>

</body>
</html>
