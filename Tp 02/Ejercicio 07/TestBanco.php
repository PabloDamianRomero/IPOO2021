<?php
include 'Banco.php';
include 'Cliente.php';
include 'Mostrador.php';
include 'Tramite.php';

/**
 * Ejercicio 7
 */

$tramite1 = new Tramite("Tramite 01", 9, 12, "Inmobiliario");
$tramite2 = new Tramite("Tramite 02", 10, 13, "Vehicular");

$cliente1 = new Cliente(40068425, $tramite1);
$cliente2 = new Cliente(88888888, $tramite2);
$cliente3 = new Cliente(11111111, $tramite1);

$colaClientes1 = array();
$colaClientes1[0] = $cliente1;
$colaClientes1[1] = $cliente2;
$colaClientes1[2] = "";

$colaClientes2 = array();
$colaClientes2[0] = $cliente3;

$mostrador1 = new Mostrador("Mostrador 01", "Inmobiliario", $colaClientes1);
$mostrador2 = new Mostrador("Mostrador 02", "Vehicular", $colaClientes2);

$colMostrador1 = array();
$colMostrador1[0] = $mostrador1;
$colMostrador1[1] = $mostrador2;

$banco1 = new Banco("Banelco", $colMostrador1);

//echo $banco1->__toString();

//------------------------------------------------------------------------
if ($mostrador1->atiende($tramite1)) {
    echo "\n El mostrador SI puede atender ese tramite";
} else {
    echo "\n El mostrador NO puede atender ese tramite";
}
//------------------------------------------------------------------------
$colMostradoresQueAtienden = $banco1->mostradoresQueAtienden($tramite1);
//print_r($colMostradoresQueAtienden);
//------------------------------------------------------------------------

$mejorMostrador = $banco1->mejorMostradorPara($tramite1);
if ($mejorMostrador != null) {
    echo "\n MEJOR MOSTRADOR: ". $mejorMostrador->__toString();
} else {
    echo "\n Mejor mostrador: NULO";
}

//------------------------------------------------------------------------

$cliente4 = new Cliente(44444444, $tramite2);
$cadena = $banco1->atender($cliente4);
echo "\n ATENDER: ".$cadena;

echo $banco1->__toString();
