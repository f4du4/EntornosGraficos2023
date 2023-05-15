<?php
/*cuadro a) */
$fun = getdate(); //devuelve un array con info de la fecha y tiempo
echo "Has entrado en esta pagina a las $fun[hours] horas, con $fun[minutes] minutos y $fun[seconds]
segundos, del $fun[mday]/$fun[mon]/$fun[year]"; //muestra cada dato devuelto en el getdate
?>

<br><br>

<?php
/*cuadro b) */
function sumar($sumando1,$sumando2){ //funcion de nombre sumar que tiene como argumento 2 variables numericas o numero directamente
    $suma=$sumando1+$sumando2; // asigna el resultado a una variable local
    echo $sumando1."+".$sumando2."=".$suma; //muestra la suma en este caso 5 + 6 = 11
}
sumar(5,6); //llama a la funcion sumar y pasa como parametros a 5 y 6
?>
