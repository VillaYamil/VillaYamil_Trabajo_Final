<?php

session_start();
require 'conexion.php';

function clean_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $usuario = clean_input($_POST["nombre"]);
    $password = clean_input($_POST["password"]);

    try {
        $stmt = $conn->prepare("SELECT * FROM profesor WHERE nombre = :nombre");
        $stmt->bindParam(':nombre', $usuario);
        $stmt->execute();

        $usuario_db = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$usuario_db) {
            die("Usuario no encontrado");
        }

        // Login del admin
        if ($usuario_db['password'] == $password && $usuario_db['nombre'] == 'Yamil') {
            $_SESSION["usuario"] = $usuario_db['nombre'];
            header("Location: opciones.php");
            exit();
        }

        // Login profesor
        if ($usuario_db['password'] == $password) {
            $_SESSION["usuario"] = $usuario_db['nombre'];
            header("Location: opciones.php");
            exit();
        }

        die("Contraseña incorrecta");

    } catch(PDOException $e) {
        die("Error en la consulta: " . $e->getMessage());
    }

} else {
    die("No se recibió el POST correctamente");
}
