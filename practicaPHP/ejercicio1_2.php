<?php
/*cuadro 1*/
$a = array( 'color' => 'rojo',
'sabor' => 'dulce',
'forma' => 'redonda',
'nombre' => 'manzana',
4
);
print_r($a);
?>
<br><br>
<?php
/*cuadro 2*/
$b['color'] = 'rojo';
$b['sabor'] = 'dulce';
$b['forma'] = 'redonda';
$b['nombre'] = 'manzana';
$b[] = 4;
print_r($b);
?>