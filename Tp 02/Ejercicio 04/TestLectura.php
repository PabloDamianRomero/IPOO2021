<?php
include 'Lectura.php';
include 'Persona.php';
include 'Libro.php';

$autor1 = new Persona("Cezilla", "Lontrato", "DNI", 11111111);
$libro1 = new Libro(9789876097260, "La Condena del Restaurador", 2018, "Del Nuevo Extremo", 256, "Tanner Davis es un restaurador de muebles y objetos cuyo cumpleaños número treinta vendrá acompañado de una maldición. Será visitado por los antiguos dueños de las piezas que restaure para que cumpla con los deseos que ellos no pueden realizar.", $autor1);
$lectura1 = new Lectura($libro1, 5);

echo ($lectura1->__toString());

$lectura1->siguientePagina();
echo ($lectura1->__toString());
$lectura1->irPagina(256);
echo ($lectura1->__toString());
$lectura1->retrocederPagina();
$lectura1->retrocederPagina();
$lectura1->retrocederPagina();
$lectura1->retrocederPagina();
echo ($lectura1->__toString());