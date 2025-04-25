<?php
$conexion = new mysqli("localhost", "root", "", "gruposion");

if (isset($_POST['accion'])) {
    $accion = $_POST['accion'];

    if ($accion == 'crear') {
        $nombre = $_POST['mat_nombre'];
        $stock = $_POST['mat_stock'];
        $unidad = $_POST['mat_unidad'];
        $conexion->query("INSERT INTO material (mat_nombre, mat_stock, mat_unidad) VALUES ('$nombre', $stock, '$unidad')");
    }

    if ($accion == 'editar') {
        $id = $_POST['id_material'];
        $nombre = $_POST['mat_nombre'];
        $stock = $_POST['mat_stock'];
        $unidad = $_POST['mat_unidad'];
        $conexion->query("UPDATE material SET mat_nombre='$nombre', mat_stock=$stock, mat_unidad='$unidad' WHERE id_material=$id");
    }

    if ($accion == 'eliminar') {
        $id = $_POST['id_material'];
        $conexion->query("DELETE FROM material WHERE id_material=$id");
    }

    header("Location: crud_material.php");
    exit();
}

$resultado = $conexion->query("SELECT * FROM material");
?>
<!DOCTYPE html>
<html>
<head><title>CRUD Material</title></head>
<body>
<h1>Materiales</h1>
<form method="POST">
    <input type="hidden" name="accion" value="crear">
    <input type="text" name="mat_nombre" placeholder="Nombre" required>
    <input type="number" name="mat_stock" placeholder="Stock" required>
    <input type="text" name="mat_unidad" placeholder="Unidad" required>
    <button type="submit">Agregar</button>
</form>
<table border="1">
    <tr><th>ID</th><th>Nombre</th><th>Stock</th><th>Unidad</th><th>Acciones</th></tr>
    <?php while ($fila = $resultado->fetch_assoc()): ?>
    <tr>
        <form method="POST">
            <td><?php echo $fila['id_material']; ?></td>
            <td><input type="text" name="mat_nombre" value="<?php echo $fila['mat_nombre']; ?>"></td>
            <td><input type="number" name="mat_stock" value="<?php echo $fila['mat_stock']; ?>"></td>
            <td><input type="text" name="mat_unidad" value="<?php echo $fila['mat_unidad']; ?>"></td>
            <td>
                <input type="hidden" name="id_material" value="<?php echo $fila['id_material']; ?>">
                <button type="submit" name="accion" value="editar">Editar</button>
                <button type="submit" name="accion" value="eliminar" onclick="return confirm('¿Eliminar?')">Eliminar</button>
            </td>
        </form>
    </tr>
    <?php endwhile; ?>
</table>
</body>
</html>
