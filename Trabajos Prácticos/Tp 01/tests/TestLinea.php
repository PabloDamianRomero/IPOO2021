<?php
include 'Linea.php';

$linea1 = new Linea(2, 1, 4, 3);

echo ($linea1->__toString());

$linea1->mueveDerecha(1);

echo ($linea1->__toString());

$linea1->mueveIzquierda(2);

echo ($linea1->__toString());

$linea1->mueveArriba(3);

echo ($linea1->__toString());

$linea1->mueveAbajo(4);

echo ($linea1->__toString());