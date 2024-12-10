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
.container {
            max-width: 800px;
            margin: 0 auto;
            background: #212330;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .title {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        .btn-add {
            display: block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            font-size: 16px;
            text-decoration: none;
        }

        .btn-add:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th, table td {
            text-align: left;
            padding: 10px;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #007bff;
            color: #fff;
        }

        .btn-edit, .btn-delete {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: #fff;
            font-size: 14px;
        }

        .btn-edit {
            background-color: #28a745;
        }

        .btn-edit:hover {
            background-color: #218838;
        }

        .btn-delete {
            background-color: #dc3545;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }
    </style>
    <head><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"></head>
<h2>Notas</h2>
<div class="container">
        <h1 class="title">Evaluaciones</h1>
        <a href="#" class="btn-add" data-bs-toggle="modal" data-bs-target="#noteModal">Crear nueva evaluación</a>
        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Porcentaje</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="notesTable">
                <?php if (!empty($notas)): ?>
                <tr>
                    <?php foreach ($notas as $nota): ?>                
                        <td><?php echo htmlspecialchars($nota['id']); ?></td>
                        <td><?php echo htmlspecialchars($nota['descripcion']); ?></td>
                        <td><?php echo htmlspecialchars($nota['valor']); ?> '%'</td>
                        <td>
                                <button class="btn-edit" onclick="editNote(1)">Editar</button>
                                <button class="btn-delete" onclick="deleteNote(1)">Eliminar</button>
                        </td>
                    <?php endforeach; ?>
                </tr>        
                <?php else: ?>
                    <p>No tienes notas creadas.</p>
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
                            <button type="submit" class="btn btn-primary">Crear</button>
                        </form>
                    </div>
                </div>
            </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
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