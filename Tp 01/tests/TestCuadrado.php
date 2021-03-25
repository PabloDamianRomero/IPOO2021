<?php

include 'Cuadrado.php';

$puntos = array();

/**
 * Precondición de carga de puntos:
 * Punto1 debe estar ubicado en la parte inferior-izquierda
 * Punto2 debe estar ubicado en la parte superior-izquierda
 * Punto3 debe estar ubicado en la parte superior-derecha
 * Punto4 debe estar ubicado en la parte inferior-derecha
 */
$puntos["Pto1"] = [
    $x1y1[0] = array("valor1" => 1, "valor2" => 1),
];

$puntos["Pto2"] = [
    $x2y2[0] = array("valor1" => 1, "valor2" => 3),
];

$puntos["Pto3"] = [
    $x3y3[0] = array("valor1" => 3, "valor2" => 3),
];

$puntos["Pto4"] = [
    $x4y4[0] = array("valor1" => 3, "valor2" => 1),
];

//print_r($puntos);
$c = new Cuadrado($puntos);
$esCuadrado = $c->comprobarFigura();
if ($esCuadrado) {
    $area = $c->area();
    echo "\nÁrea del cuadrado: " . $area . "\n";
    //$c->puntoInferiorIzq();
    echo "\nIngrese punto (valor de x): ";
    $x = trim(fgets(STDIN));
    echo "\nIngrese punto (valor de y): ";
    $y = trim(fgets(STDIN));
    $puntoDesplazo = array();
    $puntoDesplazo[0] = array("valorX" => $x, "valorY" => $y);
    $c->desplazar($puntoDesplazo);
} else {
    echo "\nNo es un cuadrado";
}
