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

// echo "<pre>";
// print_r($generos);
// echo "</pre>";

?>

<form action="" method="post">
    <div>
        <label for="id_ciudad">Ciudad: </label>
        <select name="id_ciudad" id="id_ciudad">
            <?php
            foreach ($ciudades as $key => $value) {
            ?>
                <option id="<?= $value['id_ciudad']?>">
                    <?= $value['ciudad']?>
                </option>
            <?php
            }
            ?>
        </select>
        <br>
        <label for="id_genero">Genero: </label>
        <?php
            foreach ($generos as $key => $value) {
                ?>
                <label for="genero_id_<?= $value['id_genero']?>">
                    <input type="radio" name="genero" id="genero_id_<?= $value['id_genero']?>">
                    <?= $value['genero']?>
                </label>
            <?php
            }
            ?>
        </input>
    </div>
</form>
