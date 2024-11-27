<?php
require_once BASE_PATH . '/config/database.php';

class CartaController {
    private $conn;

    public function __construct() {
        $this->conn = Database::conectar();
    }

    /**
     * Crear una nueva carta
     * @param int $idCreador ID del creador de la carta
     * @param string $nombre Nombre de la carta
     * @param string $descripcion Descripción de la carta
     * @param int $valor Valor de la carta
     * @param int $visibilidad Visibilidad de la carta
     * @param string $marco Estilo del marco de la carta
     * @param string $fondo Estilo del fondo de la carta
     * @param string $imagen Ruta de la imagen de la carta
     * @return string Mensaje de éxito o error
     */
    public function crearCarta($idCreador, $nombre, $descripcion, $valor, $visibilidad, $marco, $fondo, $imagen) {
        try {
            $sql = "INSERT INTO cartas (id_creador, nombre, descripcion, valor, visibilidad, marco, fondo, imagen)
                    VALUES (:id_creador, :nombre, :descripcion, :valor, :visibilidad, :marco, :fondo, :imagen)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_creador', $idCreador);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':valor', $valor);
            $stmt->bindParam(':visibilidad', $visibilidad);
            $stmt->bindParam(':marco', $marco);
            $stmt->bindParam(':fondo', $fondo);
            $stmt->bindParam(':imagen', $imagen);

            if ($stmt->execute()) {
                return "Carta creada exitosamente.";
            } else {
                return "Error al crear la carta.";
            }
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    /**
    * Obtener cartas por ID del creador
    * @param int $idCreador ID del creador
    * @return array Lista de cartas
    */
    public function obtenerCartasPorCreador($idCreador) {
        try {
            $sql = "SELECT id, nombre, descripcion, valor FROM cartas WHERE id_creador = :id_creador";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_creador', $idCreador);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

}
?>
