<?php
require_once '../conexion.php';
require_once 'Alumno.php';

// Crear instancia de Materia y obtener todas las materias
$alumno = new Alumno($conn);
$alumnos = $alumno->getAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Materia</title>
    <!--<link rel="stylesheet" href="generales_alumno.css">-->
</head>
<body>
    <h1>Alta, Baja y Modificación de Alumno</h1>

    <form action="ABM_alumno.php" method="POST">
        <label for="nombre">Nombre del alumno:</label>
        <input type="text" name="nombre" id="nombre" required>
        <label for="apellido">Apellido del alumno:</label>
        <input type="text" name="apellido" id="apellido" required>
        <label for="dni">DNI del alumno:</label>
        <input type="text" name="dni" id="dni" required>
        <label for="fecha_nacimiento">Fecha de nacimiento del alumno:</label>
        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" required>

        <label for="dni_existente">Selecciona un alumno para actualizar o eliminar:</label>
        <select name="dni_existente" id="dni_existente">
            <option value="">-- Selecciona --</option>
            <?php foreach ($alumnos as $alm): ?>
                <option value="<?= $alm['dni'] ?>">
                    <?= $alm['dni'] . ' - ' . htmlspecialchars($alm['nombre']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit" name="action" value="create">Crear</button>
        <button type="submit" name="action" value="update">Actualizar</button>
        <button type="submit" name="action" value="delete">Eliminar</button>
    </form>
</body>
</html>