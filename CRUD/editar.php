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

echo "<pre>";
print_r($_GET['id']);
echo "</pre>";


?>

<form action="" method="get">
    <fieldset>
        <legend>
            <h2>Prueba MySQL</h2>
        </legend>
        <label for="name">Nombre:
            <input type="text" name="name" id="name" placeholder="Nombre">
        </label>
        <br>
        <br>
        <label for="lastName">Apellido:
            <input type="text" name="lastName" id="lastName" placeholder="Apellido">
        </label>
        <br>
        <br>
        <label for="email">Correo:
            <input type="text" name="email" id="email" placeholder="Correo">
        </label>
        <br>
        <br>
        <label for="fecha_nacimiento">Fecha de nacimiento:
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento">
        </label>
        <br>
        <br>
        <div>
            <label for="id_ciudad">Ciudad: </label>
            <select name="id_ciudad" id="id_ciudad">
                <?php
                foreach ($ciudades as $key => $value) {
                ?>
                    <option id="<?= $value['id_ciudad']?>" value="<?= $value['id_ciudad']?>">
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
                        <input type="radio" name="id_genero" id="genero_<?= $value['id_genero']?>" value="<?= $value['id_genero']?>">
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
        </div>
        <br>
        <input type="submit" value="Enviar">
    </fieldset>
</form>