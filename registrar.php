<?php
$conexion = new mysqli("localhost", "root", "", "gruposion");

if (isset($_POST['accion'])) {
    $accion = $_POST['accion'];

    if ($accion == 'registrar') {
        $nombre = $_POST['cli_nombre'];
        $direccion = $_POST['cli_direccion'];
        $telefono = $_POST['cli_telefono'];
        $usuario = $_POST['cli_usuario'];
        $clave = $_POST['cli_clave'];
        $cedula = $_POST['cli_cedula'];

        // Verificar si ya existe un cliente con la misma cédula o celular
        $query_telefono = $conexion->query("SELECT * FROM cliente WHERE cli_telefono = '$telefono'");
        $query_cedula = $conexion->query("SELECT * FROM cliente WHERE cli_cedula = '$cedula'");

        if ($query_telefono->num_rows > 0) {
            echo "Error: El teléfono ya está registrado.";
        } elseif ($query_cedula->num_rows > 0) {
            echo "Error: La cédula ya está registrada.";
        } else {
            // Si no existe duplicado, insertar el nuevo cliente
            $conexion->query("INSERT INTO cliente (cli_nombre, cli_direccion, cli_telefono, cli_usuario, cli_clave, cli_cedula) 
                              VALUES ('$nombre', '$direccion', '$telefono', '$usuario', '$clave', '$cedula')");
            echo "Cliente registrado exitosamente.";
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head><title>Registro de Cliente</title></head>
<body>
<h1>Registro de Cliente</h1>
<form method="POST">
    <input type="hidden" name="accion" value="registrar">
    <input type="text" name="cli_nombre" placeholder="Nombre" required>
    <input type="text" name="cli_direccion" placeholder="Dirección" required>
    <input type="text" name="cli_telefono" placeholder="Teléfono" required>
    <input type="text" name="cli_cedula" placeholder="Cédula" required>
    <input type="text" name="cli_usuario" placeholder="Usuario" required>
    <input type="password" name="cli_clave" placeholder="Contraseña" required>
    <button type="submit">Registrar</button>
</form>
</body>
</html>
