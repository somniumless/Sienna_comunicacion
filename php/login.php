<?php
include('conexion.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $contraseña = trim($_POST['contraseña']);

    $sql = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $sql->bind_param("s", $email);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows === 1) {
        $usuario = $result->fetch_assoc();

        // Comprobamos la contraseña
        if (password_verify($contraseña, $usuario['contraseña'])) {
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nombre'] = $usuario['nombre'];
            $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];

            if ($usuario['tipo_usuario'] === 'admin') {
                header("Location: ../admin.php");
            } else {
                header("Location: ../index.html");
            }
            exit;
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "No se encontró ninguna cuenta con ese correo.";
    }

    $sql->close();
    $conn->close();
} else {
    echo "Acceso no permitido.";
}
?>
