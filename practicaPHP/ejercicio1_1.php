<?php
function doble($i) { //funcion que tiene como parametro una variable numerica de nombre i, y devuelve su doble
return $i*2;
}
$a = TRUE; //variable reservada de tipo booleana
$b = "xyz"; //variable NO reservada de tipo cadena
$c = 'xyz';  //variable NO reservada de tipo cadena
$d = 12;  //variable NO reservada de tipo numerica entera (integer)
echo gettype($a); //muestra por pantalla el tipo de variable de a (boolean)
echo gettype($b); //muestra por pantalla el tipo de variable de b  (string)
echo gettype($c);  //muestra por pantalla el tipo de variable de c  (string)
echo gettype($d);  //muestra por pantalla el tipo de variable de d  (integer)
if (is_int($d)) { //estructura de control if, y valida con la funcion is_int que la variable d sea entero
$d += 4;    // operador que increementa en 4 unidades a d, es decir 12 + 4 me queda d=16
}
if (is_string($a)) {  //estructura de control if, y valida con la funcion is_string que la variable a sea string (que no es)
echo "Cadena: $a";  
}
$d = $a ? ++$d : $d*3;  //operador de condicion, como la var a es true, incrementa a la var d en 1 unidad (16 + 1 = 17).
// echo $d; aca probe que muestra 17
$f = doble($d++);  //la variable f tiene asignado el doble la var d, o sea (17)*2 = 34. A la vez, hace que luego de hacer esa operacion, se incremento en 1 la variable d, ahora es 17+1 = 18
//echo $d; aca probe que se incremento luego de la operacion y ahora d = 18
$g = $f += 10;   // la variable g tiene asiganado la var f incrementada en 10 unidades o sea 34 + 10 = 44, a la vez se suma asi misma f esas 10 unidades
echo $a, $b, $c, $d, $f , $g; //muestra todas las variables por pantalla, para a muestra un 1 por ser TRUE
?>
