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
$usuarios = $conexionUsuarios->fetchAll();

// Consulta lenguajes a través del id
$sqlEditLenguajes = "SELECT * FROM lenguaje_usuario where id_usuario=$usuario_id";
$conexionEditLenguajes = $conexion->prepare($sqlEditLenguajes);
$conexionEditLenguajes->execute();
$editLenguajes = $conexionEditLenguajes->fetchAll();

?>

<form action="prueba.php" method="post">
    <fieldset>
        <legend>
            <h2>Prueba MySQL</h2>
        </legend>
        <input type="hidden" name="id_usuario" value="<?=$usuario_id?>">
        <label for="name">Nombre:
            <input type="text" name="name" id="name" placeholder="Nombre" value="<?= $usuarios[0]['nombre']?>">
        </label>
        <br>
        <br>
        <label for="lastName">Apellido:
            <input type="text" name="lastName" id="lastName" placeholder="Apellido" value="<?= $usuarios[0]['apellido']?>">
        </label>
        <br>
        <br>
        <label for="email">Correo:
            <input type="text" name="email" id="email" placeholder="Correo" value="<?= $usuarios[0]['correo']?>">
        </label>
        <br>
        <br>
        <label for="fecha_nacimiento">Fecha de nacimiento:
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="<?= $usuarios[0]['fecha_nacimiento']?>">
        </label>
        <br>
        <br>
        <div>
            <label for="id_ciudad">Ciudad: </label>
            <select name="id_ciudad" id="id_ciudad">
                <?php
                foreach ($ciudades as $key => $value) {
                ?>
                    <option id="<?= $value['id_ciudad']?>" value="<?=$value['id_ciudad']?>" 
                    <?php if ($value['id_ciudad'] == $usuarios[0]['id_ciudad']) 
                    {?> 
                        selected <?php 
                    } ?>>
                        <?= $value['ciudad']?>
                    </option>
                <?php
                }
                ?>
            </select>
        </div>
        <br>
        <div>
            <label for="id_genero">Genero: </label>
            <?php
                foreach ($generos as $key => $value) {
                    ?>
                    <label for="genero_<?= $value['id_genero']?>">
                        <input type="radio" name="id_genero" id="genero_<?= $value['id_genero']?>" value="<?= $value['id_genero']?>" 
                        <?php 
                        if ($usuarios[0]['id_genero'] == $value['id_genero']) 
                        { 
                            ?> checked <?php 
                        } 
                        ?>>
                        <?= $value['genero']?>
                    </label>
                    <?php
                }
            ?>
        </div>
        <br>
        <div>
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
        </div>
        <br>
        <input type="submit" value="Enviar">
        <a href="vista_admin.php">Volver</a>
    </fieldset>
</form>