<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once BASE_PATH . '/controladores/CartaController.php';

// Verificar si el usuario está autenticado y tiene permisos de docente
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] != 1) {
    //header("Location: ../../index.php"); pendiente por corregir
    exit();
}

$message = "";

// Procesar el formulario al enviarlo
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Asegúrate de que todos los campos requeridos estén presentes
    if (isset($_POST['nombre'], $_POST['descripcion'], $_POST['valor'], $_POST['visibilidad'], $_POST['marco'], $_POST['fondo'], $_POST['imagen'])) {
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

        // Reiniciar el formulario después de guardar la carta
        if ($message == "Carta creada exitosamente.") {
            // Para asegurar que el formulario se reinicie, no guardamos los datos previos del formulario
            $_POST = [];
        }
    } else {
        $message = "Todos los campos son obligatorios.";
    }
}
?>
<link rel="stylesheet" href="styles/crearCarta.css">

<div id="crearCartaBody" class="crear-carta">
    <form id="formCartas" method="POST">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>

        <!-- Visualización previa de la carta -->
        <div class="marco-container">
            <div class="visualizacion-carta" id="preview-card">                      
                    <span id="card-name" class="nombre">Nombre de la Carta</span>                                   
                    <img id="card-frame" style="position:absolute; width:100%; height:100%;">
                    <img id="card-image" style="position:absolute; width:auto; height:50%; top:12%;">
                    <span class="descripcion" id="card-description">Descripción</span>                
                    <span class="valor" id="card-value">0</span>
                </div>
            </div><div id="sparkles" class="sparkles"></div>
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
                    <label for="marco">Marco</label>
                    <select id="marco" name="marco" required>
                        <option value="public/images/dashboard/Marco-Selector.png" selected disabled>-</option>
                        <option value="public/images/cartas/marcos/01.png">01</option>
                        <option value="public/images/cartas/marcos/02.png">02</option>
                        <option value="public/images/cartas/marcos/03.png">03</option>
                        <option value="public/images/cartas/marcos/04.png">04</option>
                        <option value="public/images/cartas/marcos/05.png">05</option>
                        <option value="public/images/cartas/marcos/06.png">06</option>
                        <option value="public/images/cartas/marcos/07.png">07</option>
                        <option value="public/images/cartas/marcos/08.png">08</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="fondo">Fondo</label>
                    <select id="fondo" name="fondo" required>
                        <option value="" selected disabled>-</option>
                        <option value="public/images/cartas/fondos/01.png">01</option>
                        <option value="public/images/cartas/fondos/02.png">02</option>
                        <option value="public/images/cartas/fondos/03.png">03</option>
                        <option value="public/images/cartas/fondos/04.png">04</option>
                        <option value="public/images/cartas/fondos/05.png">05</option>
                        <option value="public/images/cartas/fondos/06.png">06</option>
                        <option value="public/images/cartas/fondos/07.png">07</option>
                        <option value="public/images/cartas/fondos/08.png">08</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="imagen">Imagen</label>
                    <select id="imagen" name="imagen" required>
                        <option value="" selected disabled>-</option>
                        <option value="public/images/cartas/imagenes/1.png">01</option>
                        <option value="public/images/cartas/imagenes/2.png">02</option>
                        <option value="public/images/cartas/imagenes/3.png">03</option>
                        <option value="public/images/cartas/imagenes/4.png">04</option>
                        <option value="public/images/cartas/imagenes/5.png">05</option>
                        <option value="public/images/cartas/imagenes/6.png">06</option>
                        <option value="public/images/cartas/imagenes/7.png">07</option>
                        <option value="public/images/cartas/imagenes/8.png">08</option>
                        <option value="public/images/cartas/imagenes/9.png">09</option>
                        <option value="public/images/cartas/imagenes/10.png">10</option>
                        <option value="public/images/cartas/imagenes/11.png">11</option>
                        <option value="public/images/cartas/imagenes/12.png">12</option>
                        <option value="public/images/cartas/imagenes/13.png">13</option>
                        <option value="public/images/cartas/imagenes/14.png">14</option>
                        <option value="public/images/cartas/imagenes/15.png">15</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="visibilidad">Visibilidad</label>
                    <select id="visibilidad" name="visibilidad" required>
                        <option value="0">Personal (solo yo puedo verla)</option>
                        <option value="1">Pública (todos pueden verla)</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn-crear" id="crearCartaButton">Crear Carta</button>
        </div>
    </form>
    
</div>
<!-- Contenedor para la Modal -->
<div id="modal" class="modal">
<?php if (!empty($message)): ?>
    <p class="<?php echo strpos($message, 'Error') !== false ? 'error' : 'success'; ?>">
        <?php echo htmlspecialchars($message); ?>
    </p>
<?php endif; ?>
    <div class="modal-content">
        <span id="closeBtn" class="close-btn">&times;</span>
        <div class="visualizacion-carta" id="preview-card-modal">
            <!-- Carta generada se mostrará aquí -->
            <span id="modal-card-name" class="nombre">Nombre de la Carta</span> 
            <img id="modal-card-frame" style="position:absolute; width:100%; height:100%;">
            <img id="modal-card-image" style="position:absolute; width:auto; height:50%; top:12%;">
            <span class="descripcion" id="modal-card-description">Descripción</span>
            <span class="valor" id="modal-card-value">0</span>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
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

        if (cardName) {
            nombreInput.addEventListener('input', () => cardName.textContent = nombreInput.value);
        }
        if (cardDescription) {
            descripcionInput.addEventListener('input', () => cardDescription.textContent = descripcionInput.value);
        }
        if (cardValue) {
            valorInput.addEventListener('input', () => cardValue.textContent = valorInput.value);
        }

        marcoSelect.addEventListener('change', () => cardFrame.src = marcoSelect.value);
        fondoSelect.addEventListener('change', () => previewCard.style.backgroundImage = `url(${fondoSelect.value})`);
        imagenSelect.addEventListener('change', () => cardImage.src = imagenSelect.value);

        // Mostrar la Modal con la carta creada
        const crearCartaButton = document.getElementById('crearCartaButton');
        const sparklesContainer = document.getElementById('sparkles');
        const modal = document.getElementById('modal');
        const closeBtn = document.getElementById('closeBtn');        
        const form = document.getElementById('formCartas');

        // Muestra la modal con la carta generada
        crearCartaButton.addEventListener('click', async function (event) {
            // Muestra las partículas
            showSparkles();
            // Mostrar la modal con la carta
            showModal();
            // Actualiza la carta en la modal
            updateModalCard();
            await pausa();
        });

        // Mostrar la Modal
        function showModal() {
            modal.style.display = "block";
        }

        // Cerrar la Modal
        closeBtn.addEventListener('click', function () {
            modal.style.display = "none";
            form.reset();
        });

        // Mostrar partículas de chispa al hacer clic en "Crear Carta"
        function showSparkles() {
            for (let i = 0; i < 10; i++) {
                const spark = document.createElement('div');
                spark.classList.add('spark');

                spark.classList.add('spark-' + (i % 3 + 1));
                const x = Math.random() * 100 + '%';
                const y = Math.random() * 100 + '%';
                spark.style.left = x;
                spark.style.top = y;

                sparklesContainer.appendChild(spark);

                // Eliminar la chispa después de la animación
                setTimeout(() => spark.remove(), 1000);
            }
        }

        // Actualizar la carta mostrada en la modal
        function updateModalCard() {
            const nombre = document.getElementById('nombre').value;
            const descripcion = document.getElementById('descripcion').value;
            const valor = document.getElementById('valor').value;
            const marco = document.getElementById('marco').value;
            const fondo = document.getElementById('fondo').value;
            const imagen = document.getElementById('imagen').value;

            // Actualizar los elementos de la carta en la modal
            document.getElementById('modal-card-name').textContent = nombre;
            document.getElementById('modal-card-description').textContent = descripcion;
            document.getElementById('modal-card-value').textContent = valor;
            document.getElementById('modal-card-frame').src = marco;
            document.getElementById('preview-card-modal').style.backgroundImage = `url(${fondo})`;
            document.getElementById('modal-card-image').src = imagen;
        }

        function saveCard() {
            // Crear un objeto con los datos del formulario
            const formData = new FormData(form);

            // Usar fetch o AJAX para enviar los datos a PHP sin recargar la página
            fetch('crear_cartas.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                console.log('Carta guardada', data); // Aquí manejarías la respuesta del servidor
            })
            .catch(error => {
                console.error('Error al guardar la carta:', error);
            });
        }
        // Función para crear pequeñas chispas al cambiar la imagen, marco o fondo
        marcoSelect.addEventListener('change', showSmallSparks);
        fondoSelect.addEventListener('change', showSmallSparks);
        imagenSelect.addEventListener('change', showSmallSparks);

        function showSmallSparks() {
            const sparkContainer = document.createElement('div');
            sparkContainer.classList.add('small-spark');
            document.getElementById('preview-card').appendChild(sparkContainer);

            // Eliminar la chispa después de la animación
            setTimeout(() => sparkContainer.remove(), 500);
        }

        function pausa() {
            return new Promise(resolve => setTimeout(resolve, 10000));
        }
        async function realizarTareaConPausa() {
            console.log("Inicio de la tarea.");
            
            // Llama a la pausa y espera
            await pausa();  
            
            console.log("Tarea terminada después de 10 segundos.");
        }

    });
</script>



