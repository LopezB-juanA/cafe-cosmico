<?php
$host = "127.0.0.1";
$port = "3308"; // Puerto donde corre tu MySQL de XAMPP
$user = "root";
$password = "";   // Déjalo vacío si es el root por defecto de XAMPP
$database = "cafe_cosmico";

try {
    // Conexión directa especificando el puerto 3308
    $conexion = new PDO("mysql:host=$host;port=$port;charset=utf8mb4", $user, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // 1. Crea la base de datos cafe_cosmico si no existe
    $conexion->exec("CREATE DATABASE IF NOT EXISTS `$database` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $conexion->exec("USE `$database`");
    
    // 2. Crea las 2 tablas automáticamente
    $conexion->exec("
        CREATE TABLE IF NOT EXISTS productos (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(100) NOT NULL,
            descripcion TEXT NOT NULL,
            precio DECIMAL(10,2) NOT NULL,
            imagen VARCHAR(255) NOT NULL
        );

        CREATE TABLE IF NOT EXISTS contactos (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL,
            mensaje TEXT NOT NULL,
            fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );
    ");

    // 3. Inserta los datos del menú si la tabla está vacía
    $check = $conexion->query("SELECT COUNT(*) FROM productos")->fetchColumn();
    if ($check == 0) {
        $conexion->exec("
            INSERT INTO productos (nombre, descripcion, precio, imagen) VALUES
            ('Espresso Galáctico', 'Café concentrado con chispas de cacao espacial y notas de avellana.', 3.50, 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?w=500'),
            ('Cappuccino Nebulosa', 'Mezcla suave de espresso con leche vaporizada y espuma aterciopelada.', 4.20, 'https://images.unsplash.com/photo-1534778101976-62847782c213?w=500'),
            ('Torta Supernova', 'Delicioso pastel de chocolate negro con núcleo cremoso de frutos rojos.', 5.00, 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=500');
        ");
    }

} catch (PDOException $e) {
    die("Error conectando a la base de datos: " . $e->getMessage());
}
?>