<?php
session_start();
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];

    // Conectar a la base de datos
    $db = Database::conectar();

    // Verificar si el usuario existe
    $sql = "SELECT * FROM usuarios WHERE usuario = :usuario";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Usuario encontrado, iniciar sesión
        $_SESSION['usuario'] = $user;
        header("Location: ../dashboard.php");
        exit();
    } else {
        // Usuario no encontrado, redirigir con un mensaje de error
        header("Location: ../index.php?error=Usuario no encontrado");
        exit();
    }
} else {
    // Si se intenta acceder al archivo directamente, redirigir al index
    header("Location: ../index.php");
    exit();
}
?>
