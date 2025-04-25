<?php
$conexion = new mysqli("localhost", "root", "", "tu_basededatos");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
