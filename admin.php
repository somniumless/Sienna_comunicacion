<?php
session_start();

// Si no hay sesión iniciada o no es admin, redirigir al login
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] !== 'admin') {
    header("Location: login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de Administración - Sienna</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Arial', sans-serif;
      background-color: #f8f8f8;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      min-height: 100vh;
    }

    header {
      width: 100%;
      background-color: #b38b6d;
      color: white;
      padding: 15px;
      text-align: center;
      font-family: 'Playfair Display', serif;
    }

    main {
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      padding: 20px;
    }

    h1 {
      color: #333;
      margin-bottom: 10px;
    }

    p {
      color: #555;
      margin-bottom: 20px;
    }

    a {
      display: inline-block;
      padding: 10px 20px;
      background-color: #b38b6d;
      color: white;
      text-decoration: none;
      border-radius: 8px;
      transition: background-color 0.3s;
    }

    a:hover {
      background-color: #a17758;
    }
  </style>
</head>
<body>
  <header>
    <h2>Panel de Administración</h2>
  </header>

  <main>
    <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre']); ?> 👋</h1>
    <p>Tipo de usuario: <strong><?php echo $_SESSION['tipo_usuario']; ?></strong></p>
    <a href="php/Logout.php">Cerrar sesión</a>
  </main>
</body>
</html>
