<?php
include 'Fecha.php';

$fecha1 = new Fecha(14, 2, 2020);
echo $fecha1->__toString();

if($fecha1->esBisiesto()){
    echo "\nEs bisiesto";
}else{
    echo "\nNo es bisiesto";
}

$fecha1->incremento(32,$fecha1);
echo $fecha1->__toString();