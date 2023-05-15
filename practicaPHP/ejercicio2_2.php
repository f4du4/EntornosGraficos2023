<?php
/*cuadro a) */
$matriz = array("x" => "bar", 12 => true);
echo $matriz["x"]; //muestra bar
echo $matriz[12];  //muestra 1 (por true)
?>

<br><br>

<?php
/*cuadro b) */
$matriz = array("unamatriz" => array(6 => 5, 13 => 9, "a" => 42));
echo $matriz["unamatriz"][6];   //muestra 5
echo $matriz["unamatriz"][13];  //muestra 9
echo $matriz["unamatriz"]["a"]; //muestra 42
?>

<br><br>

<?php
/*cuadro c) */
$matriz = array(5 => 1, 12 => 2);
$matriz[] = 56; 
$matriz["x"] = 42; unset($matriz[5]); unset($matriz); //no mostraria nada porque no hay echo
//ademas se hizo un unset de la matriz, por lo que ahora es un array vacio
print_r($matriz); //por pantalla muestra que esta indefinido este arreglo
?>