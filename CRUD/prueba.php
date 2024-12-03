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
$lenguajes = $_POST['id_lenguaje'];

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

header('Location: vista_admin.php');