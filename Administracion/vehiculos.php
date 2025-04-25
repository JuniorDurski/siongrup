<?php
$conexion = new mysqli("localhost", "root", "", "gruposion");

if (isset($_POST['accion'])) {
    $accion = $_POST['accion'];

    if ($accion == 'crear') {
        $nombre = $_POST['veh_nombre'];
        $marca = $_POST['veh_marca'];
        $modelo = $_POST['veh_modelo'];
        $ano = $_POST['veh_ano'];
        $color = $_POST['veh_color'];
        $patente = $_POST['veh_patente'];
        $conexion->query("INSERT INTO vehiculo (veh_nombre, veh_marca, veh_modelo, veh_ano, veh_color, veh_patente) VALUES ('$nombre', '$marca', '$modelo', '$ano', '$color', '$patente')");
    }

    if ($accion == 'editar') {
        $id = $_POST['id_vehiculo'];
        $nombre = $_POST['veh_nombre'];
        $marca = $_POST['veh_marca'];
        $modelo = $_POST['veh_modelo'];
        $ano = $_POST['veh_ano'];
        $color = $_POST['veh_color'];
        $patente = $_POST['veh_patente'];
        $conexion->query("UPDATE vehiculo SET veh_nombre='$nombre', veh_marca='$marca', veh_modelo='$modelo', veh_ano='$ano', veh_color='$color', veh_patente='$patente' WHERE id_vehiculo=$id");
    }

    if ($accion == 'eliminar') {
        $id = $_POST['id_vehiculo'];
        $conexion->query("DELETE FROM vehiculo WHERE id_vehiculo=$id");
    }

    header("Location: crud_vehiculo.php");
    exit();
}

$resultado = $conexion->query("SELECT * FROM vehiculo");
?>
<!DOCTYPE html>
<html>
<head><title>CRUD Vehiculo</title></head>
<body>
<h1>Vehiculos</h1>
<form method="POST">
    <input type="hidden" name="accion" value="crear">
    <input type="text" name="veh_nombre" placeholder="Nombre" required>
    <input type="text" name="veh_marca" placeholder="Marca" required>
    <input type="text" name="veh_modelo" placeholder="Modelo" required>
    <input type="number" name="veh_ano" placeholder="Año" required>
    <input type="text" name="veh_color" placeholder="Color" required>
    <input type="text" name="veh_patente" placeholder="Patente" required>
    <button type="submit">Agregar</button>
</form>
<table border="1">
    <tr><th>ID</th><th>Nombre</th><th>Marca</th><th>Modelo</th><th>Año</th><th>Color</th><th>Patente</th><th>Acciones</th></tr>
    <?php while ($fila = $resultado->fetch_assoc()): ?>
    <tr>
        <form method="POST">
            <td><?php echo $fila['id_vehiculo']; ?></td>
            <td><input type="text" name="veh_nombre" value="<?php echo $fila['veh_nombre']; ?>"></td>
            <td><input type="text" name="veh_marca" value="<?php echo $fila['veh_marca']; ?>"></td>
            <td><input type="text" name="veh_modelo" value="<?php echo $fila['veh_modelo']; ?>"></td>
            <td><input type="number" name="veh_ano" value="<?php echo $fila['veh_ano']; ?>"></td>
            <td><input type="text" name="veh_color" value="<?php echo $fila['veh_color']; ?>"></td>
            <td><input type="text" name="veh_patente" value="<?php echo $fila['veh_patente']; ?>"></td>
            <td>
                <input type="hidden" name="id_vehiculo" value="<?php echo $fila['id_vehiculo']; ?>">
                <button type="submit" name="accion" value="editar">Editar</button>
                <button type="submit" name="accion" value="eliminar" onclick="return confirm('¿Eliminar?')">Eliminar</button>
            </td>
        </form>
    </tr>
    <?php endwhile; ?>
</table>
</body>
</html>