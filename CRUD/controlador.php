<link rel="stylesheet" href="CSS/style.css">
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>

<?php
require("conexion.php");
$db = new Conexion();
$conexion = $db->getConexion();

$nombre = $_POST['name'];
$apellido = $_POST['lastName'];
$correo = $_POST['email'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$id_ciudad = $_POST['id_ciudad'];
$id_genero = $_POST['id_genero'];
$lenguajes = $_POST['id_lenguaje'] ?? "";


//Validar que el correo no exista
$sqlValidarCorreo = "SELECT * FROM usuarios WHERE correo = :correo";
$conexionValidar = $conexion->prepare($sqlValidarCorreo);
$conexionValidar->bindParam(':correo', $correo);
$conexionValidar->execute();
$correoExtraido = $conexionValidar->fetch();

if (empty($correoExtraido)) {
    // Realizar inserción de datos
    $sqlInsertar = "INSERT INTO usuarios (nombre, apellido, correo, fecha_nacimiento, id_ciudad, id_genero) VALUES (:nombre, :apellido, :correo, :fecha_nacimiento, :id_ciudad, :id_genero)";
    $conexionInsertar = $conexion->prepare($sqlInsertar);
    
    // Bindear los datos de la inserción
    $conexionInsertar->bindParam(':nombre', $nombre);
    $conexionInsertar->bindParam(':apellido', $apellido);
    $conexionInsertar->bindParam(':correo', $correo);
    $conexionInsertar->bindParam(':fecha_nacimiento', $fecha_nacimiento);
    $conexionInsertar->bindParam(':id_ciudad', $id_ciudad);
    $conexionInsertar->bindParam(':id_genero', $id_genero);
    $conexionInsertar->execute();

    // validar si el usuario seleccionó algún lenguaje
    if (!empty($lenguajes)) {
        // Extraer id del usuario
        $lastId = $conexion->lastInsertId();
        
        // insertar en la tabla lenguaje_usuario
        $sqlLenguajeUsuario = "INSERT INTO lenguaje_usuario (id_usuario, id_lenguaje) VALUES (:id_usuario, :id_lenguaje)";
        
        $conexionLenguajeUsuario = $conexion->prepare($sqlLenguajeUsuario);
        
        foreach ($lenguajes as $key => $value) {
            $conexionLenguajeUsuario->bindParam(':id_usuario', $lastId);
            $conexionLenguajeUsuario->bindParam(':id_lenguaje', $value);
            $conexionLenguajeUsuario->execute();
        }
        
    }
    header('Location: vista_admin.php');
} else {
    ?>
    <div class="container-error">
        <i class="ri-error-warning-fill container-error__icono"></i>
        <p class="container-error__mensaje">Por favor, ingresa un correo no existente.</p>
    </div>
    <?php
}