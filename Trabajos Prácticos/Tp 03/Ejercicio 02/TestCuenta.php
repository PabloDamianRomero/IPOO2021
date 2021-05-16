<?php
include_once 'Banco.php';
include_once 'Cuenta.php';
include_once 'Persona.php';
include_once 'CuentaCorriente.php';
include_once 'CajaAhorro.php';
include_once 'Cliente.php';

$cliente1 = new Cliente(77777777, "George", "Orwell", "Cliente_001");
$cliente2 = new Cliente(33333333, "Oscar", "Wilde", "Cliente_002");

$colClientes = [$cliente1, $cliente2];

$banco = new Banco($colClientes);
echo $banco;

$cuenta1 = $banco->incorporarCuentaCorriente("Cliente_001");
$banco->incorporarCuentaCorriente("Cliente_002");
$banco->incorporarCuentaCorriente("Cliente_003"); # Probar falla

$banco->incorporarCajaAhorro("Cliente_001");
$banco->incorporarCajaAhorro("Cliente_001");
$cuenta2 = $banco->incorporarCajaAhorro("Cliente_002");
$banco->incorporarCajaAhorro("Cliente_003"); # Probar falla

$colCuentaCorriente = $banco->getColeccionCuentaCorriente();
$colCajaAhorro = $banco->getColeccionCajaAhorro();
$colCuentas = array_merge($colCuentaCorriente, $colCajaAhorro);
foreach ($colCuentas as $unObjCuenta) {
    $banco->realizarDeposito($unObjCuenta->getNumCuenta(), 10000);
}

$retiro = $cuenta1->realizarRetiro(350);
$deposito = $cuenta2->realizarDeposito(350);

$banco->realizarDeposito($cuenta1->getNumCuenta(), 350);
echo $banco;
