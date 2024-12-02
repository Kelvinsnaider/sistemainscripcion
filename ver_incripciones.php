<?php
// Configuración de la conexión a la base de datos
$host = 'localhost';
$dbname = 'sistemainscripcion';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para obtener los registros agrupados por curso
    $sql = "
        SELECT 
            cursos.nombre AS curso,
            inscripciones.nombre AS nombre,
            inscripciones.email,
            inscripciones.telefono,
            cursos.fecha_inicio
        FROM 
            inscripciones
        INNER JOIN 
            cursos 
        ON 
            inscripciones.id_curso = cursos.id
        ORDER BY 
            cursos.nombre, inscripciones.nombre
    ";
    $stmt = $pdo->query($sql);
    $inscripciones = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Organizar inscripciones por curso
    $cursos = [];
    foreach ($inscripciones as $inscripcion) {
        $curso = $inscripcion['curso'];
        if (!isset($cursos[$curso])) {
            $cursos[$curso] = [];
        }
        $cursos[$curso][] = $inscripcion;
    }
} catch (PDOException $e) {
    die("Error en la conexión a la base de datos: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Inscripciones por Curso</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        h2 {
            text-align: left;
            color: #333;
            margin-top: 40px;
            margin-bottom: 10px;
            font-size: 1.5em;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
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
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .btn {
            display: inline-block;
            margin: 20px auto 0;
            padding: 10px 15px;
            color: #fff;
            background-color: #007bff;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .course-section {
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Lista de Inscripciones por Curso</h1>
        <?php if (!empty($cursos)): ?>
            <?php foreach ($cursos as $curso => $inscripciones): ?>
                <div class="course-section">
                    <h2><?= htmlspecialchars($curso); ?></h2>
                    <?php if (!empty($inscripciones)): ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>N</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Teléfono</th>
                                    <th>Fecha de Inicio</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $contador = 1; // Inicia el contador para este curso
                                foreach ($inscripciones as $inscripcion): ?>
                                    <tr>
                                        <td><?= $contador++; ?></td>
                                        <td><?= htmlspecialchars($inscripcion['nombre']); ?></td>
                                        <td><?= htmlspecialchars($inscripcion['email']); ?></td>
                                        <td><?= htmlspecialchars($inscripcion['telefono']); ?></td>
                                        <td><?= htmlspecialchars($inscripcion['fecha_inicio']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>No hay inscripciones en este curso.</p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center;">No hay inscripciones disponibles.</p>
        <?php endif; ?>
        <a href="index.html" class="btn">Volver al Inicio</a>
    </div>
</body>
</html>
