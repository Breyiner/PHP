<link rel="stylesheet" href="CSS/style.css">

<?php

require('conexion.php');

$db = new Conexion();
$conexion = $db->getConexion();

$usuario_id = $_REQUEST['id'];

// consulta ciudades
$sqlCiudades = "SELECT * FROM ciudades";
$conexionCiudades = $conexion->prepare($sqlCiudades);
$conexionCiudades->execute();
$ciudades = $conexionCiudades->fetchAll();

// consulta generos
$sqlGeneros = "SELECT * FROM generos";
$conexionGeneros = $conexion->prepare($sqlGeneros);
$conexionGeneros->execute();
$generos = $conexionGeneros->fetchAll();

// consulta generos
$sqlLenguajes = "SELECT * FROM lenguajes";
$conexionLenguajes = $conexion->prepare($sqlLenguajes);
$conexionLenguajes->execute();
$lenguajes = $conexionLenguajes->fetchAll();

// Consulta de usuario a traves del id
$sqlUsuarios = "SELECT * FROM usuarios where id_usuario = $usuario_id";
$conexionUsuarios = $conexion->prepare($sqlUsuarios);
$conexionUsuarios->execute();
$usuarios = $conexionUsuarios->fetch();

// Consulta lenguajes a través del id
$sqlEditLenguajes = "SELECT * FROM lenguaje_usuario where id_usuario=$usuario_id";
$conexionEditLenguajes = $conexion->prepare($sqlEditLenguajes);
$conexionEditLenguajes->execute();
$editLenguajes = $conexionEditLenguajes->fetchAll();

?>

<form action="update.php" method="post" class="formulario">
    <fieldset class="formulario__contorno">
        <legend class="formulario__container-tittle">
            <h2 class="formulario__titulo">Editar Datos</h2>
        </legend>
        <input type="hidden" name="id_usuario" value="<?=$usuario_id?>">
        <input type="text" name="name" id="name" placeholder="Nombre" value="<?= $usuarios['nombre']?>" class="formulario__input" required pattern="^[a-zA-Z\s]{2,}$" autocomplete="off">
        <br>
        <br>
        <input type="text" name="lastName" id="lastName" placeholder="Apellido" value="<?= $usuarios['apellido']?>" class="formulario__input" required pattern="^[a-zA-Z\s]{2,}$" autocomplete="off">
        <br>
        <br>
        <input type="email" name="email" id="email" placeholder="Correo" value="<?= $usuarios['correo']?>" class="formulario__input" required autocomplete="off">
        <br>
        <br>
        <label for="fecha_nacimiento">Fecha de nacimiento:
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="<?= $usuarios['fecha_nacimiento']?>" class="formulario__date" required max="<?=date('Y')?>-<?=date('m')?>-<?=date('d')?>">
        </label>
        <br>
        <br>
        <label for="id_ciudad">Ciudad: </label>
        <select name="id_ciudad" id="id_ciudad" class="formulario__cities">
            <?php
            foreach ($ciudades as $key => $value) {
            ?>
                <option id="<?= $value['id_ciudad']?>" value="<?=$value['id_ciudad']?>" 
                <?php if ($value['id_ciudad'] == $usuarios['id_ciudad']) 
                {?> 
                    selected <?php 
                } ?> class="formulario__city">
                    <?= $value['ciudad']?>
                </option>
            <?php
            }
            ?>
        </select>
        <br>
        <br>
        <label for="id_genero">Genero: </label>
        <?php
            foreach ($generos as $key => $value) {
                ?>
                    <label for="genero_<?= $value['id_genero']?>" class="formulario__genero">
                    <input type="radio" name="id_genero" id="genero_<?= $value['id_genero']?>" value="<?= $value['id_genero']?>" 
                    <?php 
                    if ($usuarios['id_genero'] == $value['id_genero']) 
                    { 
                        ?> checked <?php 
                    } 
                    ?> required>
                    <?= $value['genero']?>
                </label>
                <?php
            }
        ?>
        <br>
        <label>Lenguajes que domina: </label>
        <?php
            foreach ($lenguajes as $key => $valor) {
                ?>
                <br>
                <label for="lenguaje_<?= $valor['id_lenguaje']?>">
                    <input type="checkbox" name="id_lenguaje[]" id="lenguaje_<?= $valor['id_lenguaje']?>" value="<?= $valor['id_lenguaje']?>"
                    <?php
                    foreach ($editLenguajes as $key => $value) {
                        if ($valor['id_lenguaje'] == $value['id_lenguaje']) {
                            ?>
                            checked
                            <?php
                        }
                    }
                    ?>
                    >
                    <?= $valor['lenguaje']?>
                </label>
                <?php
            }
        ?>
        <br>
        <br>
        <input type="submit" value="Enviar" class="formulario__boton">
    </fieldset>
</form>
<a href="vista_admin.php" class="button">Volver</a>