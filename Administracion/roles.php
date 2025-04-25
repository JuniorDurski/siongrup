<?php
$conexion = new mysqli("localhost", "root", "", "gruposion");

if (isset($_POST['accion'])) {
    $accion = $_POST['accion'];

    if ($accion == 'crear') {
        $descripcion = $_POST['rol_descripcion'];
        $conexion->query("INSERT INTO role (rol_descripcion) VALUES ('$descripcion')");
    }

    if ($accion == 'editar') {
        $id = $_POST['id_role'];
        $descripcion = $_POST['rol_descripcion'];
        $conexion->query("UPDATE role SET rol_descripcion='$descripcion' WHERE id_role=$id");
    }

    if ($accion == 'eliminar') {
        $id = $_POST['id_role'];
        $conexion->query("DELETE FROM role WHERE id_role=$id");
    }

    header("Location: crud_role.php");
    exit();
}

$resultado = $conexion->query("SELECT * FROM role");
?>
<!DOCTYPE html>
<html>
<head><title>CRUD Role</title></head>
<body>
<h1>Roles</h1>
<form method="POST">
    <input type="hidden" name="accion" value="crear">
    <input type="text" name="rol_descripcion" placeholder="Descripción" required>
    <button type="submit">Agregar</button>
</form>
<table border="1">
    <tr><th>ID</th><th>Descripción</th><th>Acciones</th></tr>
    <?php while ($fila = $resultado->fetch_assoc()): ?>
    <tr>
        <form method="POST">
            <td><?php echo $fila['id_role']; ?></td>
            <td><input type="text" name="rol_descripcion" value="<?php echo $fila['rol_descripcion']; ?>"></td>
            <td>
                <input type="hidden" name="id_role" value="<?php echo $fila['id_role']; ?>">
                <button type="submit" name="accion" value="editar">Editar</button>
                <button type="submit" name="accion" value="eliminar" onclick="return confirm('¿Eliminar?')">Eliminar</button>
            </td>
        </form>
    </tr>
    <?php endwhile; ?>
</table>
</body>
</html>
