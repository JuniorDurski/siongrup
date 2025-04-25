<?php
session_start();

$conexion = new mysqli("localhost", "root", "", "siongrup");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$usuario = $_POST['usuario'];
$clave = $_POST['clave'];

$usuario = $conexion->real_escape_string($usuario);
$clave = $conexion->real_escape_string($clave);

$sqlEmpleado = "SELECT * FROM empleado WHERE emp_usuario = '$usuario' AND emp_clave = '$clave'";
$resultEmpleado = $conexion->query($sqlEmpleado);

if ($resultEmpleado->num_rows === 1) {
    $empleado = $resultEmpleado->fetch_assoc();
    $_SESSION['id'] = $empleado['id_empleado'];
    $_SESSION['nombre'] = $empleado['emp_nombre'];
    $_SESSION['tipo'] = 'empleado';
    header("Location: empleado/");
    exit();
}

$sqlCliente = "SELECT * FROM cliente WHERE cli_usuario = '$usuario' AND cli_clave = '$clave'";
$resultCliente = $conexion->query($sqlCliente);

if ($resultCliente->num_rows === 1) {
    $cliente = $resultCliente->fetch_assoc();
    $_SESSION['id'] = $cliente['id_cliente'];
    $_SESSION['nombre'] = $cliente['cli_nombre'];
    $_SESSION['tipo'] = 'cliente';
    header("Location: cliente/");
    exit();
}

echo "<script>alert('Usuario o contraseña incorrectos');window.location='index.php';</script>";
?>
