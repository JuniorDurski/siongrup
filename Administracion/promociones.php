<?php
$conexion = new mysqli("localhost", "root", "", "gruposion");

if (isset($_POST['accion'])) {
    $accion = $_POST['accion'];

    if ($accion == 'crear') {
        $descripcion = $_POST['pro_descripcion'];
        $descuento = $_POST['pro_descuento'];
        $inicio = $_POST['pro_vigencia_inicial'];
        $fin = $_POST['pro_vigencia_fin'];
        $conexion->query("INSERT INTO promocion (pro_descripcion, pro_descuento, pro_vigencia_inicial, pro_vigencia_fin) VALUES ('$descripcion', '$descuento', '$inicio', '$fin')");
    }

    if ($accion == 'editar') {
        $id = $_POST['id_promocion'];
        $descripcion = $_POST['pro_descripcion'];
        $descuento = $_POST['pro_descuento'];
        $inicio = $_POST['pro_vigencia_inicial'];
        $fin = $_POST['pro_vigencia_fin'];
        $conexion->query("UPDATE promocion SET pro_descripcion='$descripcion', pro_descuento='$descuento', pro_vigencia_inicial='$inicio', pro_vigencia_fin='$fin' WHERE id_promocion=$id");
    }

    if ($accion == 'eliminar') {
        $id = $_POST['id_promocion'];
        $conexion->query("DELETE FROM promocion WHERE id_promocion=$id");
    }

    header("Location: crud_promocion.php");
    exit();
}

$resultado = $conexion->query("SELECT * FROM promocion");
?>
<!DOCTYPE html>
<html>
<head><title>CRUD Promocion</title></head>
<body>
<h1>Promociones</h1>
<form method="POST">
    <input type="hidden" name="accion" value="crear">
    <input type="text" name="pro_descripcion" placeholder="Descripción" required>
    <input type="number" step="0.01" name="pro_descuento" placeholder="Descuento (%)" required>
    <input type="date" name="pro_vigencia_inicial" required>
    <input type="date" name="pro_vigencia_fin" required>
    <button type="submit">Agregar</button>
</form>
<table border="1">
    <tr><th>ID</th><th>Descripción</th><th>Descuento</th><th>Desde</th><th>Hasta</th><th>Acciones</th></tr>
    <?php while ($fila = $resultado->fetch_assoc()): ?>
    <tr>
        <form method="POST">
            <td><?php echo $fila['id_promocion']; ?></td>
            <td><input type="text" name="pro_descripcion" value="<?php echo $fila['pro_descripcion']; ?>"></td>
            <td><input type="number" step="0.01" name="pro_descuento" value="<?php echo $fila['pro_descuento']; ?>"></td>
            <td><input type="date" name="pro_vigencia_inicial" value="<?php echo $fila['pro_vigencia_inicial']; ?>"></td>
            <td><input type="date" name="pro_vigencia_fin" value="<?php echo $fila['pro_vigencia_fin']; ?>"></td>
            <td>
                <input type="hidden" name="id_promocion" value="<?php echo $fila['id_promocion']; ?>">
                <button type="submit" name="accion" value="editar">Editar</button>
                <button type="submit" name="accion" value="eliminar" onclick="return confirm('¿Eliminar?')">Eliminar</button>
            </td>
        </form>
    </tr>
    <?php endwhile; ?>
</table>
</body>
</html>
