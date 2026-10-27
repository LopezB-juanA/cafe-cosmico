<?php
include 'conexion.php';
$query = $conexion->query("SELECT * FROM productos");
$productos = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Café Cósmico - Menú</title>
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
        <h2 style="text-align: center; color: #c084fc;">Menú Desde Base de Datos</h2>
        
        <div class="grid">
            <?php foreach ($productos as $producto): ?>
                <div class="card">
                    <img src="<?php echo htmlspecialchars($producto['imagen']); ?>" alt="Producto">
                    <h3><?php echo htmlspecialchars($producto['nombre']); ?></h3>
                    <p><?php echo htmlspecialchars($producto['descripcion']); ?></p>
                    <div class="precio">$<?php echo number_format($producto['precio'], 2); ?></div>
                    <!-- Botón 2 -->
                    <a href="contacto.php" class="btn">Pedir Producto</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <footer>
        <p>&copy; 2026 Café Cósmico</p>
    </footer>

</body>
</html>