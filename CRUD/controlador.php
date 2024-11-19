<?php
require("conexion.php");
$db = new Conexion();
$conexion = $db->getConexion();

$nombre = $_POST['name'];
$apellido = $_POST['lastName'];
$correo = $_POST['email'];
$fechaNacimiento = $_POST['fecha_nacimiento'];
$ciudad = $_POST['id_ciudad'];
$genero = $_POST['id_genero'];
$lenguajes = $_POST['id_lenguaje'];

// Realizar inserción de datos
$sqlInsertar = "INSERT INTO usuarios (nombre, apellido, correo, fecha_nacimiento, id_ciudad, id_genero) VALUES (:nombre, :apellido, :correo, :fecha_nacimiento, :ciudad, :genero)";

$conexionInsertar = $conexion->prepare($sqlInsertar);

// Bindear los datos de la inserción
$conexionInsertar->bindParam(':nombre', $nombre);
$conexionInsertar->bindParam(':apellido', $apellido);
$conexionInsertar->bindParam(':correo', $correo);
$conexionInsertar->bindParam(':fecha_nacimiento', $fechaNacimiento);
$conexionInsertar->bindParam(':ciudad', $ciudad);
$conexionInsertar->bindParam(':genero', $genero);
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

echo "Envío exitoso";