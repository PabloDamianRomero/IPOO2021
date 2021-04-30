<?php
include 'Persona.php';
include 'Cuota.php';
include 'Prestamo.php';
include 'Financiera.php';

$persona1 = new Persona("Pepe", "Florez", 11111111, "Bs As 12", "dir@gmail.com", 299444567, 40000);
$persona2 = new Persona("Luis", "Suarez", 22222222, "Bs As 123", "dir@gmail.com", 29944555, 4000);


// Inciso 2
$prestamo1 = new Prestamo(1, 50000, 5, 0.1, $persona1);
$prestamo2 = new Prestamo(2, 10000, 4, 0.1, $persona2);
$prestamo3 = new Prestamo(3, 10000, 2, 0.1, $persona2);

// Inciso 1
$financiera = new Financiera("Money", "Av. Arg 1234", null);

echo $persona1;
