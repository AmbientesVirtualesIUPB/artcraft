<?php

require_once BASE_PATH . '/config/database.php';

class NotaController {
    private $conn;

    public function __construct() {
        $this->conn = Database::conectar();
    }

    /**
     * Crear una nueva nota
     * @param int $profesorId ID del profesor
     * @param string $descripcion Descripción de la nota
     * @param float $valor Valor de la nota
     * @return string Mensaje de éxito o error
     */
    public function crearNota($profesorId, $descripcion, $valor) {
        try {
            $sql = "INSERT INTO notas (profesor_id, descripcion, valor)
                    VALUES (:profesor_id, :descripcion, :valor)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':profesor_id', $profesorId);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':valor', $valor);
    
            if ($stmt->execute()) {
                // Devuelve el ID generado
                return ['success' => true, 'id' => $this->conn->lastInsertId()];
            } else {
                return ['success' => false, 'message' => 'Error al crear la nota.'];
            }
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    /**
     * Obtener las notas
     * @param int $profesorId
     * @return array Lista de notas
     */
    public function obtenerNotasPorGrupo($profesorId) {
        try {
            $sql = "SELECT n.id, n.descripcion, n.valor
                    FROM notas n
                    WHERE n.profesor_id = :profesor_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':profesor_id', $profesorId);
            $stmt->execute();
    
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }
}
?>