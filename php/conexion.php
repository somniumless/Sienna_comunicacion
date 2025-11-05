<?php
$host = "localhost";     
$usuario = "root";       
$contraseña = "";        
$base_datos = "sienna_db";  

// Crear conexión
$conn = new mysqli($host, $usuario, $contraseña, $base_datos);

// Verificar conexión
if ($conn->connect_error) {
    die("Error al conectar con la base de datos: " . $conn->connect_error);
}

// Opcional: establecer codificación UTF-8
$conn->set_charset("utf8mb4");
?>
