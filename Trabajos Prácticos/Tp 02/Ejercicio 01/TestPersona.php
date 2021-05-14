<?php
include 'Persona.php';
include 'CuentaBancaria.php';

$persona1 = new Persona("Pablo", "Romero", "DNI", 40068425);
$persona2 = new Persona("Lucas", "Asencio", "DNI", 39027981);
$cuenta1 = new CuentaBancaria(123, $persona1, 15000, 10);


echo ($cuenta1->__toString());