<?php
include 'Cuenta.php';
include 'CuentaCorriente.php';
include 'CajaAhorro.php';
include 'Persona.php';
include 'Cliente.php';

$cliente1 = new Cliente(40068425, "Pablo", "Romero", "Cliente_001");

$cuentaCorriente1 = new CuentaCorriente ("Cuenta_001", 5000, $cliente1, 10000);

echo $cuentaCorriente1;

$cuentaCorriente1->realizarDeposito(500);
$saldo = $cuentaCorriente1->saldoCuenta();
echo "\n SALDO--------> ".$saldo;