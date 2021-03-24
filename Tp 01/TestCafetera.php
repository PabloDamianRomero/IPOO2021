<?php
include 'Cafetera.php';

echo "\nIngrese la capacidad máxima de la cafetera: ";
$max = trim(fgets(STDIN));
echo "\nIngrese la cantidad actual de cafe que tiene la cafetera: ";
$actual = trim(fgets(STDIN));
$cafetera1 = new Cafetera($max, $actual);

echo $cafetera1->__toString();

$cafetera1->llenarCafetera();

echo "\n".$cafetera1->__toString();

$cafetera1 -> vaciarCafetera();

echo "\n".$cafetera1->__toString();

echo "\nAgregar café (cantidad) a la cafetera: ";
$cafe = trim(fgets(STDIN));
$cafetera1 -> agregarCafe($cafe);

echo "\nServir en taza (cantidad): ";
$servirCant = trim(fgets(STDIN));
echo $cafetera1 -> servirTaza($servirCant);

echo "\n".$cafetera1->__toString();
