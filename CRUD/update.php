<link rel="stylesheet" href="CSS/style.css">
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>

<?php
require("conexion.php");
$db = new Conexion();
$conexion = $db->getConexion();

$nombre = $_REQUEST['name'];
$apellido = $_REQUEST['lastName'];
$correo = $_REQUEST['email'];
$fecha_nacimiento = $_REQUEST['fecha_nacimiento'];
$id_genero = $_REQUEST['id_genero'];
$id_ciudad = $_REQUEST['id_ciudad'];
$lenguajes = $_REQUEST['id_lenguaje'] ?? "";
$usuario_id = $_REQUEST['id_usuario'];

try {
  $conexion->beginTransaction();
  
  $sqlUpdate = "UPDATE usuarios SET nombre = :nombre, apellido = :apellido, correo = :correo, fecha_nacimiento = :fecha_nacimiento, id_genero = :id_genero, id_ciudad = :id_ciudad WHERE id_usuario = :usuario_id";
  
  $conexionUpdate = $conexion->prepare($sqlUpdate);
  
  $conexionUpdate->bindParam(':nombre', $nombre);
  $conexionUpdate->bindParam(':apellido', $apellido);
  $conexionUpdate->bindParam(':correo', $correo);
  $conexionUpdate->bindParam(':fecha_nacimiento', $fecha_nacimiento);
  $conexionUpdate->bindParam(':id_genero', $id_genero);
  $conexionUpdate->bindParam(':id_ciudad', $id_ciudad);
  $conexionUpdate->bindParam(':usuario_id', $usuario_id);
  $conexionUpdate->execute();
  
  // eliminar los datos para volver a crearlos
  $sqlEliminarLenguaje = "DELETE FROM lenguaje_usuario where id_usuario = :id_usuario";
  $conexionEliminarLenguaje = $conexion->prepare($sqlEliminarLenguaje);
  $conexionEliminarLenguaje->bindParam(':id_usuario', $usuario_id);
  
  $conexionEliminarLenguaje->execute();
  
  if (!empty($lenguajes)) { 
    // se insertan de nuevo los lenguajes que el usuario selecciones
    $sqlLenguajeUsuario = "INSERT INTO lenguaje_usuario (id_usuario, id_lenguaje) VALUES (:id_usuario, :id_lenguaje)";
    
    $conexionLenguajeUsuario = $conexion->prepare($sqlLenguajeUsuario);
    
    foreach ($lenguajes as $key => $value) {
      $conexionLenguajeUsuario->bindParam(':id_usuario', $usuario_id);
      $conexionLenguajeUsuario->bindParam(':id_lenguaje', $value);
      $conexionLenguajeUsuario->execute();
    }
  }
  $conexion->commit();
  
  header('location: vista_admin.php');

} catch (Exception $e) {

  $conexion->rollBack();
  ?>
  <div class="container-error">
    <i class="ri-error-warning-fill container-error__icono"></i>
    <p class="container-error__mensaje"><?=$e->getMessage()?></p>
  </div>
  <?php
}