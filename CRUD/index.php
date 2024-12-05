<link rel="stylesheet" href="CSS/style.css">

<?php

require('conexion.php');

$db = new Conexion();
$conexion = $db->getConexion();

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

// echo "<pre>";
// print_r($generos);
// echo "</pre>";

?>

<form action="controlador.php" method="post" class="formulario">
    <fieldset class="formulario__contorno">
        <legend class="formulario__container-tittle">
            <h2 class="formulario__titulo">Formulario CRUD</h2>
        </legend>
        <input type="text" name="name" id="name" placeholder="Nombre" class="formulario__input" required pattern="^[a-zA-Z\s]{2,}$" autocomplete="off">
        <br>
        <br>
        <input type="text" name="lastName" id="lastName" placeholder="Apellido" class="formulario__input" required pattern="^[a-zA-Z\s]{2,}$" autocomplete="off">
        <br>
        <br>
        <input type="email" name="email" id="email" placeholder="Correo" class="formulario__input" required autocomplete="off">
        <br>
        <br>
        <label for="fecha_nacimiento">Fecha de Nacimiento:
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="formulario__date" required max="<?=date('Y')?>-<?=date('m')?>-<?=date('d')?>">
        </label>
        <br>
        <br>
        <label for="id_ciudad">Ciudad: </label>
        <select name="id_ciudad" id="id_ciudad" class="formulario__cities">
            <?php
            foreach ($ciudades as $key => $value) {
            ?>
                <option id="<?= $value['id_ciudad']?>" value="<?= $value['id_ciudad']?>" class="formulario__city">
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
                    <input type="radio" name="id_genero" id="genero_<?= $value['id_genero']?>" value="<?= $value['id_genero']?>" required>
                    <?= $value['genero']?>
                </label>
                <?php
            }
        ?>
        <br>
        <label>Lenguajes que domina: </label>
        <?php
            foreach ($lenguajes as $key => $value) {
                ?>
                <br>
                <label for="lenguaje_<?= $value['id_lenguaje']?>">
                    <input type="checkbox" name="id_lenguaje[]" id="lenguaje_<?= $value['id_lenguaje']?>" value="<?= $value['id_lenguaje']?>">
                    <?= $value['lenguaje']?>
                </label>
                <?php
            }
        ?>
        <br>
        <br>
        <input type="submit" value="Enviar" class="formulario__boton">
    </fieldset>
</form>
