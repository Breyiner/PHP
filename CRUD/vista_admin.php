<link rel="stylesheet" href="CSS/style.css">
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>

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
    <h1 class="message-help">No se han ingresado registros</h1>
    <?php
}else {
    ?>
    <table class="tabla">
    <tr class="tabla__encabezado">
        <th class="tabla__encabezado-item">ID</th>
        <th class="tabla__encabezado-item">Nombres</th>
        <th class="tabla__encabezado-item">Apellidos</th>
        <th class="tabla__encabezado-item">Correo</th>
        <th class="tabla__encabezado-item">Fecha De Nacimiento</th>
        <th class="tabla__encabezado-item">Genero</th>
        <th class="tabla__encabezado-item">Ciudad</th>
        <th colspan="2" class="tabla__encabezado-item">Opciones</th>
    </tr>

    <?php
    foreach ($usuarios as $key => $value) {
    ?>
    <tr class="tabla__contenido">
        <td class="tabla__contenido-item"><?=$value['id_usuario'];?></td>
        <td class="tabla__contenido-item"><?=$value['nombre'];?></td>
        <td class="tabla__contenido-item"><?=$value['apellido'];?></td>
        <td class="tabla__contenido-item"><?=$value['correo'];?></td>
        <td class="tabla__contenido-item"><?=$value['fecha_nacimiento'];?></td>
        <td class="tabla__contenido-item"><?=$value['genero'];?></td>
        <td class="tabla__contenido-item"><?=$value['ciudad'];?></td>
        <td class="tabla__contenido-item">
            <a href="editar.php?id=<?=$value['id_usuario']?>" class="btn-action btn-action--update">
                <i class="ri-edit-box-fill"></i>
            </a>
        </td>
        <td class="tabla__contenido-item">
            <a href="eliminar.php?id=<?=$value['id_usuario']?>" class="btn-action btn-action--delete">
                <i class="ri-delete-bin-5-fill"></i>
            </a>
        </td>
    </tr>
    <?php
    }
    ?>
</table>
<?php
}
?>
<a href="index.php" class="button">Nuevo</a>