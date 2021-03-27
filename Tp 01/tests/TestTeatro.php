<?php
include 'Teatro.php';

$colFunciones = array();
$colFunciones[0] = array("nombreF" => "ShowMax", "precioF" => 500);
$colFunciones[1] = array("nombreF" => "Virtud", "precioF" => 450);
$colFunciones[2] = array("nombreF" => "5g", "precioF" => 250);
$colFunciones[3] = array("nombreF" => "php para todos", "precioF" => 600);

//print_r($colFunciones);

$teatro1 = new Teatro("Luna", "Lincoln 35", $colFunciones);

echo ($teatro1->__toString());

$teatro1->cambiarNombreTeatro("Sol");
$teatro1->cambiarDireccionTeatro("Global 123");
$teatro1->cambiarNombreFuncion(0, "Ipoo");
$teatro1->cambiarPrecioFuncion(3, 750);
echo "-------------------------------------------";
echo ($teatro1->__toString());
