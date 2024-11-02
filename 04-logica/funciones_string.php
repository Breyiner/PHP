<?php

$texto  = "grupo ADSO 2894667";
// $exp = "/PRUEBA/i";
// $exp = "/[0-9]/";
// $exp = "/^texto/i";
// $exp = "/pr[eu]eba/i";
// $exp = "/grupo-[0-9]-adso/i";
// $exp = "/le{2,4}r/i";
// $exp = "/l[aeiou]{2,4}r/i";
// $exp = "/[0-9]/";
// $exp = "/[A-Za-z]/";
// $exp = "/[A-Z]{4,}/";
// $exp = "/[0-9]{2,}/";
$exp = "/([A-Z]{4,}).([0-9]{2,})/";
// $resultado = preg_match_all($exp, $texto, $coincidencias);
// $resultado = preg_match_all($exp, $texto, $coincidencias, PREG_OFFSET_CAPTURE);
$resultado = preg_match($exp, $texto, $coincidencias, PREG_OFFSET_CAPTURE);

// echo"<pre>";
// print_r($coincidencias);
// echo "</pre>";
echo "<br>";
print_r($resultado);
echo "<br>";

if ($resultado){
  echo "SI tiene resultado";
}else {
  echo "No tiene resultado";
}