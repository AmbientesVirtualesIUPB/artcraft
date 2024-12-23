<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once BASE_PATH . '/controladores/notasController.php';

// Verificar si el usuario está autenticado y tiene permisos de docente
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] !== 1) {
    header("Location: ../../index.php");
    exit();
}
$message = "";

// Procesar el formulario al enviarlo
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $profesorId = $_SESSION['usuario']['id']; // ID del creador desde la sesión
    $descripcion = $_POST['descripcion'];
    $valor = $_POST['valor'];

    // Crear una instancia de la clase y llamar al método crearNota
    $notasController = new notasController();
    $message = $notasController->crearNota($profesorId, $descripcion, $valor);
    if ($resultado['success']) {
        // Devuelve un JSON con el ID generado
        echo json_encode(['success' => true, 'id' => $resultado['id']]);
    } else {
        // Devuelve un JSON con el mensaje de error
        echo json_encode(['success' => false, 'message' => $resultado['message']]);
    }
}
?>
<?php if (!empty($message)): ?>
    <p class="<?php echo strpos($message, 'Error') !== false ? 'error' : 'success'; ?>">
        <?php echo htmlspecialchars($message); ?>
    </p>
<?php endif; ?>

<style>
    </style>
    <head>
        <link rel="stylesheet" href="Styles/notas.css">
    </head>
    <div id="notasBody">
        <h1 class="title">Evaluaciones</h1>
        <a href="#" class="btn-crear" data-bs-toggle="modal" data-bs-target="#noteModal">Crear nueva evaluación</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Porcentaje</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="notesTable">
                <?php if (!empty($notas)): ?>
                    <?php foreach ($notas as $nota): ?>                
                        <tr>
                            <td><?php echo htmlspecialchars($nota['id']); ?></td>
                            <td><?php echo htmlspecialchars($nota['descripcion']); ?></td>
                            <td><?php echo htmlspecialchars($nota['valor']); ?> %</td>
                            <td>
                                <button class="btn-edit" onclick="editNote(<?php echo $nota['id']; ?>)">Editar</button>
                                <button class="btn-delete" onclick="deleteNote(<?php echo $nota['id']; ?>)">Eliminar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No tienes notas creadas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <!-- Modal -->
    
    <div class="modal fade" id="noteModal" tabindex="-1" aria-labelledby="noteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="noteModalLabel">Nueva Evaluación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="noteForm">
                    <div class="mb-3">
                        <label for="noteName" class="form-label">Nombre de la evaluación</label>
                        <input type="text" class="form-control" id="noteName" placeholder="Nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="notePercentage" class="form-label">Porcentaje</label>
                        <input type="number" class="form-control" id="notePercentage" placeholder="Porcentaje" required>
                    </div>
                    <button type="submit" class="btn-crear">Crear</button>
                </form>
            </div>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
    const modal = new bootstrap.Modal(document.getElementById('noteModal')); // Inicializa la modal
    const createButton = document.querySelector(".btn-crear");

    createButton.addEventListener("click", (e) => {
        e.preventDefault(); // Evita cualquier comportamiento por defecto del enlace
        modal.show(); // Muestra la modal
    });
});
        const notesTable = document.getElementById('notesTable');
        const noteForm = document.getElementById('noteForm');

        // Función para agregar una nueva evaluación
        noteForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    const noteName = document.getElementById('noteName').value;
    const notePercentage = document.getElementById('notePercentage').value;

    try {
        const response = await fetch('ruta_al_backend.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ descripcion: noteName, valor: notePercentage }),
        });
        const textResponse = await response.text(); // Obtén la respuesta como texto para inspeccionarla
        console.log('Respuesta del servidor:', textResponse);
        const result = await response.json();

        if (result.success) {
            // Agregar la nueva fila con el ID generado
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>${result.id}</td>
                <td>${noteName}</td>
                <td>${notePercentage}%</td>
                <td>
                    <button class="btn-edit" onclick="editNote(${result.id})">Editar</button>
                    <button class="btn-delete" onclick="deleteNote(${result.id})">Eliminar</button>
                </td>
            `;
            notesTable.appendChild(newRow);

            // Cerrar modal y limpiar formulario
            const modal = bootstrap.Modal.getInstance(document.getElementById('noteModal'));
            modal.hide();
            noteForm.reset();
        } else {
            alert('Error: ' + result.message);
        }
    } catch (error) {
        console.error('Error:', error);
            alert('Hubo un problema al crear la nota.');
        }
    });

        function editNote(id) {
            alert(`Editar nota con ID: ${id}`);
        }

        function deleteNote(id) {
            alert(`Eliminar nota con ID: ${id}`);
        }
    </script>