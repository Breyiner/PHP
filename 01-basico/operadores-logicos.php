<?php

/**
 * 
 * -------- simbolo ---------------- Nombre ----------
 *            and                    and (y)
 *            or                     or (o)
 *            !                      not (no)
 *            &&                     and (y)
 *            ||                     or (o)
 * 
 * 
 * ------------------Tabla de operadores and -------------------
 * Expresión 1               Expresión 2              Resultado
 *   false           &&         false                    false
 *   false           &&         true                     false
 *   true            &&         true                     true 
 *   true            &&         false                    false
 */

 $valor1 = 7;
 $valor2 = 2;

 var_dump($valor1 == 7 && $valor2 > 3);
 echo "<br>";
 var_dump($valor1 == 7 && 9 > 3);
 echo "<br>";

 /**
 * ------------------Tabla de operadores or -------------------
 * Expresión 1               Expresión 2              Resultado
 *    False          ||         False                    False
 *    False          ||         True                     True
 *    True           ||         False                    True
 *    True           ||         True                     True
 */

 var_dump($valor1 == 7 or 2 < 3);
 echo "<br>";
 var_dump($valor1 == 5 || 9 > 3);
 echo "<br>";
 var_dump($valor1 == 5 || 1 > 3);