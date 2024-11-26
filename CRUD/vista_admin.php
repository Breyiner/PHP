<?php
require("conexion.php");
$db = new Conexion();
$conexion = $db->getConexion();

$sqlUsuarios = "SELECT u.id_usuario, u.nombre, u.apellido, u.correo, u.fecha_nacimiento, g.genero, c.ciudad FROM usuarios u INNER JOIN generos g ON u.id_genero = g.id_genero INNER JOIN ciudades c ON u.id_ciudad = c.id_ciudad ORDER BY u.id_usuario;";
$conexionUsuarios = $conexion->prepare($sqlUsuarios);
$conexionUsuarios->execute();
$usuarios = $conexionUsuarios->fetchAll();
?>
<?php
if (empty($usuarios)) {
    ?>
    <h1>No se han ingresado registros</h1>
    <?php
}else {
    ?>
    <table border="1">
    <tr>
        <th>ID</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Correo</th>
        <th>Fecha De Nacimiento</th>
        <th>Genero</th>
        <th>Ciudad</th>
    </tr>

    <?php
    foreach ($usuarios as $key => $value) {
    ?>
    <tr>
        <td><?=$value['id_usuario'];?></td>
        <td><?=$value['nombre'];?></td>
        <td><?=$value['apellido'];?></td>
        <td><?=$value['correo'];?></td>
        <td><?=$value['fecha_nacimiento'];?></td>
        <td><?=$value['genero'];?></td>
        <td><?=$value['ciudad'];?></td>
        <td><a href="editar.php?id=<?=$value['id_usuario']?>">Editar</a></td>
        <td><a href="eliminar.php?id=<?=$value['id_usuario']?>">Eliminar</a></td>
    </tr>
    <?php
    }
    ?>
</table>
<?php
}
?>
<a href="index.php">Nuevo</a>