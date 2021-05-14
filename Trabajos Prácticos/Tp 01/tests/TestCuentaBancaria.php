<?php
include 'CuentaBancaria.php';

echo "\nIngrese número de cuenta: ";
$numCuenta = trim(fgets(STDIN));
echo "\Ingrese DNI: ";
$doc = trim(fgets(STDIN));
echo "\Ingrese saldo actual: ";
$saldo = trim(fgets(STDIN));
echo "\Ingrese interés anual: ";
$interes = trim(fgets(STDIN));

$cuenta1 = new CuentaBancaria($numCuenta, $doc, $saldo, $interes);

echo $cuenta1 -> __toString();

echo "\nIngrese valor a depositar: ";
$aDepositar = trim(fgets(STDIN));
$cuenta1 -> depositar($aDepositar);

echo $cuenta1 -> __toString();

echo "\Ingrese el monto a retirar: ";
$aRetirar = trim(fgets(STDIN));
$cuenta1 -> retirar($aRetirar);

echo $cuenta1 -> __toString();

echo "\n-----ACTUALIZANDO SALDO-----";
$cuenta1 -> actualizarSaldo();
echo $cuenta1 -> __toString();