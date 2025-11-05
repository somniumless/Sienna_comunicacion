<?php
include('conexion.php'); // Conectamos a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtenemos los datos del formulario
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $contraseña = password_hash($_POST['contraseña'] ?? '', PASSWORD_DEFAULT);

    if (empty($nombre) || empty($email) || empty($_POST['contraseña'])) {
        die("Por favor completa todos los campos.");
    }

    $check = $conn->prepare("SELECT * FROM usuarios WHERE nombre = ? OR email = ?");
    $check->bind_param("ss", $nombre, $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo "El usuario o el correo ya están registrados.";
    } else {
        // Insertar nuevo usuario
        $sql = $conn->prepare("INSERT INTO usuarios (nombre, email, contraseña, tipo_usuario) VALUES (?, ?, ?, 'usuario')");
        $sql->bind_param("sss", $nombre, $email, $contraseña);

        if ($sql->execute()) {
            echo "Registro exitoso. Ahora puedes iniciar sesión.";
        } else {
            echo "Error al registrar: " . $conn->error;
        }

        $sql->close();
    }

    $check->close();
    $conn->close();
} else {
    echo "Acceso no permitido.";
}
?>
