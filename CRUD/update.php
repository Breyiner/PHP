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
$usuario_id = $_REQUEST['id'];

echo $usuario_id;

$sqlUpdate = "";