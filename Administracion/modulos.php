<?php
$conexion = new mysqli("localhost", "root", "", "gruposion");

if (isset($_POST['accion'])) {
    $accion = $_POST['accion'];

    if ($accion == 'crear') {
        $descripcion = $_POST['mod_descripcion'];
        $conexion->query("INSERT INTO modulo (mod_descripcion) VALUES ('$descripcion')");
    }

    if ($accion == 'editar') {
        $id = $_POST['id_modulo'];
        $descripcion = $_POST['mod_descripcion'];
        $conexion->query("UPDATE modulo SET mod_descripcion='$descripcion' WHERE id_modulo=$id");
    }

    if ($accion == 'eliminar') {
        $id = $_POST['id_modulo'];
        $conexion->query("DELETE FROM modulo WHERE id_modulo=$id");
    }

    header("Location: crud_modulo.php");
    exit();
}

$resultado = $conexion->query("SELECT * FROM modulo");
?>
<!DOCTYPE html>
<html>
<head><title>CRUD Modulo</title></head>
<body>
<h1>Modulos</h1>
<form method="POST">
    <input type="hidden" name="accion" value="crear">
    <input type="text" name="mod_descripcion" placeholder="Descripción" required>
    <button type="submit">Agregar</button>
</form>
<table border="1">
    <tr><th>ID</th><th>Descripción</th><th>Acciones</th></tr>
    <?php while ($fila = $resultado->fetch_assoc()): ?>
    <tr>
        <form method="POST">
            <td><?php echo $fila['id_modulo']; ?></td>
            <td><input type="text" name="mod_descripcion" value="<?php echo $fila['mod_descripcion']; ?>"></td>
            <td>
                <input type="hidden" name="id_modulo" value="<?php echo $fila['id_modulo']; ?>">
                <button type="submit" name="accion" value="editar">Editar</button>
                <button type="submit" name="accion" value="eliminar" onclick="return confirm('¿Eliminar?')">Eliminar</button>
            </td>
        </form>
    </tr>
    <?php endwhile; ?>
</table>
</body>
</html>
