<?php
require_once BASE_PATH . '/config/database.php';

class UsuarioClan {
    private $conn;

    public function __construct() {
        $this->conn = Database::conectar();
    }

    /**
     * Agregar un usuario a un clan
     * @param int $idUsuario ID del usuario
     * @param int $idClan ID del clan
     * @return string Mensaje de éxito o error
     */
    public function agregarUsuarioAClan($idUsuario, $idClan) {
        try {
            // Verificar si el usuario ya está en el clan
            $sqlCheck = "SELECT COUNT(*) FROM usuario_clan WHERE id_usuario = :id_usuario AND id_clan = :id_clan";
            $stmtCheck = $this->conn->prepare($sqlCheck);
            $stmtCheck->bindParam(':id_usuario', $idUsuario);
            $stmtCheck->bindParam(':id_clan', $idClan);
            $stmtCheck->execute();

            if ($stmtCheck->fetchColumn() > 0) {
                return "El estudiante ya pertenece a este clan.";
            }

            // Insertar el usuario en el clan si no existe
            $sqlInsert = "INSERT INTO usuario_clan (id_usuario, id_clan) VALUES (:id_usuario, :id_clan)";
            $stmtInsert = $this->conn->prepare($sqlInsert);
            $stmtInsert->bindParam(':id_usuario', $idUsuario);
            $stmtInsert->bindParam(':id_clan', $idClan);

            if ($stmtInsert->execute()) {
                return "Estudiante agregado exitosamente al clan.";
            } else {
                return "Error al agregar el estudiante al clan.";
            }
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }


    /**
     * Obtener miembros de un clan
     * @param int $clanId ID del clan
     * @return array Lista de miembros
     */
    public function obtenerMiembrosPorClan($clanId) {
        try {
            $sql = "SELECT u.id, u.nombre FROM usuario_clan uc
                    JOIN usuarios u ON uc.id_usuario = u.id
                    WHERE uc.id_clan = :id_clan";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_clan', $clanId);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

    /**
     * Eliminar un usuario de un clan
     * @param int $idUsuario ID del usuario
     * @param int $idClan ID del clan
     * @return string Mensaje de éxito o error
     */
    public function eliminarUsuarioDeClan($idUsuario, $idClan) {
        try {
            $sql = "DELETE FROM usuario_clan WHERE id_usuario = :id_usuario AND id_clan = :id_clan";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_usuario', $idUsuario);
            $stmt->bindParam(':id_clan', $idClan);

            if ($stmt->execute()) {
                return "Estudiante eliminado exitosamente del clan.";
            } else {
                return "Error al eliminar el estudiante del clan.";
            }
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    /**
     * Obtener clanes y grupos por estudiante
     * @param int $estudianteId ID del estudiante
     * @return array Lista de clanes con sus grupos
     */
    public function obtenerClanesPorEstudiante($estudianteId) {
        try {
            $sql = "
                SELECT c.nombre AS nombre_clan, g.nombre AS nombre_grupo
                FROM usuario_clan uc
                JOIN clanes c ON uc.id_clan = c.id
                JOIN grupos g ON c.grupo = g.id
                WHERE uc.id_usuario = :id_usuario
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_usuario', $estudianteId);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }





}
?>
