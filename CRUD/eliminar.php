<?php

require('conexion.php');

$db = new Conexion();
$conexion = $db->getConexion();

$usuario_id = $_REQUEST['id'];

$sqlEliminarLenguaje = "DELETE FROM lenguaje_usuario where id_usuario = :id_usuario";
$conexionEliminarLenguaje = $conexion->prepare($sqlEliminarLenguaje);
$conexionEliminarLenguaje->bindParam(':id_usuario', $usuario_id);
$conexionEliminarLenguaje->execute();

$sqlEliminarUsuario = "DELETE FROM usuarios WHERE id_usuario = :id_usuario";
$conexionEliminarUsuario = $conexion->prepare($sqlEliminarUsuario); 
$conexionEliminarUsuario->bindParam(':id_usuario', $usuario_id);
$conexionEliminarUsuario->execute();


// echo "Se eliminaron los datos del usuario";
header('Location: vista_admin.php');