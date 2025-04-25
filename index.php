<?php
  session_start();
  session_destroy();
  error_reporting(0);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Responsive</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="login-container">
    <div class="logo-container">
      <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a7/React-icon.svg/512px-React-icon.svg.png" alt="Logo" class="logo" />
    </div>
    <form method="POST" action="login.php" class="login-form">
      <h2>Iniciar sesión</h2>
      <input type="text" name="usuario" placeholder="Usuario" required />
      <input type="password" name="clave" placeholder="Contraseña" required />
      <button type="submit">Entrar</button>
      <button type="button" class="register-btn">Registrarse</button>
    </form>

  </div>
</body>
</html>
