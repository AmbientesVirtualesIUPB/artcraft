<?php
require_once BASE_PATH . '/config/database.php';

class GrupoClan {
    private $conn;

    public function __construct() {
        $this->conn = Database::conectar();
    }

    /**
     * Crear un nuevo grupo
     * @param string $nombre Nombre del grupo
     * @param int $docenteId ID del docente que crea el grupo
     * @return string Mensaje de éxito o error
     */
    public function CrearGrupo($nombre, $docenteId) {
        try {
            $sql = "INSERT INTO grupos (nombre, docente_id) VALUES (:nombre, :docente_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':docente_id', $docenteId);

            if ($stmt->execute()) {
                return "Grupo creado exitosamente.";
            } else {
                return "Error al crear el grupo.";
            }
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    /**
     * Obtener grupos por ID de docente
     * @param int $docenteId ID del docente
     * @return array Lista de grupos
     */
    public function obtenerGruposPorDocente($docenteId) {
        try {
            $sql = "SELECT id, nombre FROM grupos WHERE docente_id = :docente_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':docente_id', $docenteId);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

    /**
     * Agregar una carta a un grupo
     * @param int $grupoId ID del grupo
     * @param int $cartaId ID de la carta
     * @return string Mensaje de éxito o error
     */
    public function agregarCartaAlGrupo($grupoId, $cartaId) {
        try {
            $sql = "INSERT INTO cartas_grupo (id_grupo, id_carta) VALUES (:id_grupo, :id_carta)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_grupo', $grupoId);
            $stmt->bindParam(':id_carta', $cartaId);

            if ($stmt->execute()) {
                return "Carta agregada exitosamente al grupo.";
            } else {
                return "Error al agregar la carta al grupo.";
            }
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    /**
     * Crear un nuevo clan en un grupo
     * @param int $grupoId ID del grupo
     * @param string $nombre Nombre del clan
     * @return string Mensaje de éxito o error
     */
    public function crearClanEnGrupo($grupoId, $nombre) {
        try {
            $sql = "INSERT INTO clanes (nombre, oro, grupo) VALUES (:nombre, 0, :grupo)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':grupo', $grupoId);

            if ($stmt->execute()) {
                return "Clan creado exitosamente en el grupo.";
            } else {
                return "Error al crear el clan.";
            }
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    /**
    * Obtener clanes por ID de grupo
    * @param int $grupoId ID del grupo
    * @return array Lista de clanes
    */
    public function obtenerClanesPorGrupo($grupoId) {
        try {
            $sql = "SELECT id, nombre, oro FROM clanes WHERE grupo = :grupo";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':grupo', $grupoId);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

}
?>
