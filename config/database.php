<?php
// Configuración de la conexión a la base de datos
class Database {
    private static $host = 'localhost';
    private static $dbName = 'artcraft';
    private static $username = 'root';
    private static $password = '';

    public static function conectar() {
        try {
            $conn = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$dbName, self::$username, self::$password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}
?>
