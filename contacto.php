<?php
include 'conexion.php';
$mensaje_confirmacion = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $mensaje = $_POST['mensaje'] ?? '';

    if (!empty($nombre) && !empty($email) && !empty($mensaje)) {
        $stmt = $conexion->prepare("INSERT INTO contactos (nombre, email, mensaje) VALUES (:nombre, :email, :mensaje)");
        $stmt->execute([
            ':nombre' => $nombre,
            ':email' => $email,
            ':mensaje' => $mensaje
        ]);
        $mensaje_confirmacion = "¡Mensaje guardado con éxito en la base de datos!";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Café Cósmico - Contacto</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <header>
        <h1>☕ Café Cósmico</h1>
        <nav>
            <a href="index.php">Inicio</a>
            <a href="menu.php">Menú</a>
            <a href="contacto.php">Contacto</a>
        </nav>
    </header>

    <div class="container">
        <h2 style="text-align: center; color: #c084fc; margin-bottom: 20px;">Contacto / Pedidos</h2>

        <?php if (!empty($mensaje_confirmacion)): ?>
            <div class="alerta"><?php echo $mensaje_confirmacion; ?></div>
        <?php endif; ?>

        <form action="contacto.php" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="email">Correo:</label>
            <input type="email" id="email" name="email" required>

            <label for="mensaje">Mensaje:</label>
            <textarea id="mensaje" name="mensaje" rows="4" required></textarea>

            <!-- Botón 3 -->
            <button type="submit" class="btn">Enviar Mensaje</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2026 Café Cósmico</p>
    </footer>

</body>
</html>