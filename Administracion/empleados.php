<?php
$conexion = new mysqli("localhost", "root", "", "gruposion");

if (isset($_POST['accion'])) {
    $accion = $_POST['accion'];

    if ($accion == 'crear') {
        $id_role = $_POST['id_role'];
        $nombre = $_POST['emp_nombre'];
        $cedula = $_POST['emp_cedula'];
        $usuario = $_POST['emp_usuario'];
        $clave = $_POST['emp_clave'];
        $direccion = $_POST['emp_direccion'];
        $telefono = $_POST['emp_telefono'];
        $conexion->query("INSERT INTO empleado (id_role, emp_nombre, emp_cedula, emp_usuario, emp_clave, emp_direccion, emp_telefono) 
                          VALUES ('$id_role', '$nombre', '$cedula', '$usuario', '$clave', '$direccion', '$telefono')");
    }

    if ($accion == 'editar') {
        $id = $_POST['id_empleado'];
        $id_role = $_POST['id_role'];
        $nombre = $_POST['emp_nombre'];
        $cedula = $_POST['emp_cedula'];
        $usuario = $_POST['emp_usuario'];
        $clave = $_POST['emp_clave'];
        $direccion = $_POST['emp_direccion'];
        $telefono = $_POST['emp_telefono'];
        $conexion->query("UPDATE empleado SET id_role='$id_role', emp_nombre='$nombre', emp_cedula='$cedula', 
                          emp_usuario='$usuario', emp_clave='$clave', emp_direccion='$direccion', emp_telefono='$telefono' 
                          WHERE id_empleado=$id");
    }

    if ($accion == 'eliminar') {
        $id = $_POST['id_empleado'];
        $conexion->query("DELETE FROM empleado WHERE id_empleado=$id");
    }

    header("Location: crud_empleado.php");
    exit();
}

$resultado = $conexion->query("SELECT * FROM empleado");
?>
<!DOCTYPE html>
<html>
<head><title>CRUD Empleado</title></head>
<body>
<h1>Empleados</h1>
<form method="POST">
    <input type="hidden" name="accion" value="crear">
    <input type="number" name="id_role" placeholder="ID Role" required>
    <input type="text" name="emp_nombre" placeholder="Nombre" required>
    <input type="text" name="emp_cedula" placeholder="Cédula" required>
    <input type="text" name="emp_usuario" placeholder="Usuario" required>
    <input type="password" name="emp_clave" placeholder="Contraseña" required>
    <input type="text" name="emp_direccion" placeholder="Dirección" required>
    <input type="text" name="emp_telefono" placeholder="Teléfono" required>
    <button type="submit">Agregar</button>
</form>
<table border="1">
    <tr><th>ID</th><th>ID Role</th><th>Nombre</th><th>Cédula</th><th>Usuario</th><th>Contraseña</th><th>Dirección</th><th>Teléfono</th><th>Acciones</th></tr>
    <?php while ($fila = $resultado->fetch_assoc()): ?>
    <tr>
        <form method="POST">
            <td><?php echo $fila['id_empleado']; ?></td>
            <td><input type="number" name="id_role" value="<?php echo $fila['id_role']; ?>"></td>
            <td><input type="text" name="emp_nombre" value="<?php echo $fila['emp_nombre']; ?>"></td>
            <td><input type="text" name="emp_cedula" value="<?php echo $fila['emp_cedula']; ?>"></td>
            <td><input type="text" name="emp_usuario" value="<?php echo $fila['emp_usuario']; ?>"></td>
            <td><input type="password" name="emp_clave" value="<?php echo $fila['emp_clave']; ?>"></td>
            <td><input type="text" name="emp_direccion" value="<?php echo $fila['emp_direccion']; ?>"></td>
            <td><input type="text" name="emp_telefono" value="<?php echo $fila['emp_telefono']; ?>"></td>
            <td>
                <input type="hidden" name="id_empleado" value="<?php echo $fila['id_empleado']; ?>">
                <button type="submit" name="accion" value="editar">Editar</button>
                <button type="submit" name="accion" value="eliminar" onclick="return confirm('¿Eliminar?')">Eliminar</button>
            </td>
        </form>
    </tr>
    <?php endwhile; ?>
</table>
</body>
</html>
