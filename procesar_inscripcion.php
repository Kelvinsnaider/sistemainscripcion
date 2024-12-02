<?php
$host = 'localhost';
$dbname = 'sistemainscripcion';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Sanitizar datos del formulario
        $nombre = htmlspecialchars($_POST['nombre']);
        $email = htmlspecialchars($_POST['email']);
        $telefono = htmlspecialchars($_POST['telefono']);
        $id_curso = intval($_POST['id_curso']);

        if (!empty($nombre) && !empty($email) && !empty($telefono) && !empty($id_curso)) {
            // Verificar que el curso existe
            $sql = "SELECT * FROM cursos WHERE id = :id_curso";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id_curso', $id_curso);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                // Insertar la inscripción en la base de datos
                $sql = "INSERT INTO inscripciones (nombre, email, telefono, id_curso) 
                        VALUES (:nombre, :email, :telefono, :id_curso)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':nombre', $nombre);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':telefono', $telefono);
                $stmt->bindParam(':id_curso', $id_curso);
                $stmt->execute();

                // Mensaje de éxito
                $title = "Inscripción Exitosa";
                $message = "Gracias, <strong>$nombre</strong>. Te has inscrito correctamente en el curso seleccionado.";
                $button = "<a href='index.html' class='btn'>Volver al Inicio</a>";
            } else {
                // Error: curso no existe
                $title = "Error";
                $message = "El curso seleccionado no existe. Por favor, selecciona un curso válido.";
                $button = "<a href='inscripcion.html' class='btn'>Volver al Formulario</a>";
            }
        } else {
            // Error: campos obligatorios
            $title = "Error";
            $message = "Todos los campos son obligatorios. Por favor, verifica tu información.";
            $button = "<a href='inscripcion.html' class='btn'>Volver al Formulario</a>";
        }
    } else {
        // Error: formulario no enviado correctamente
        $title = "Error";
        $message = "El formulario no fue enviado correctamente.";
        $button = "<a href='inscripcion.html' class='btn'>Volver al Formulario</a>";
    }
} catch (PDOException $e) {
    // Error de conexión
    $title = "Error en la Conexión";
    $message = "No se pudo conectar a la base de datos: " . $e->getMessage();
    $button = "<a href='index.html' class='btn'>Volver al Inicio</a>";
}

// Generar salida HTML
echo "
<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='styles.css'>
    <title>$title</title>
</head>
<body>
    <div class='message-box'>
        <h1>$title</h1>
        <p>$message</p>
        $button
    </div>
</body>
</html>";
?>
