<?php
include 'Lectura.php';
include 'Persona.php';
include 'Libro.php';

$aux = array();

$autor1 = new Persona("Cezilla", "Lontrato", "DNI", 11111111);
$autor2 = new Persona("Julio", "Verne", "DNI", 33333333);

$libro1 = new Libro(9789876097260, "La Condena del Restaurador", 2018, "Del Nuevo Extremo", 256, "Tanner Davis es un restaurador de muebles y objetos cuyo cumpleaños número treinta vendrá acompañado de una maldición. Será visitado por los antiguos dueños de las piezas que restaure para que cumpla con los deseos que ellos no pueden realizar.", $autor1);
$libro2 = new Libro(9789500399807, "De La Tierra A La Luna", 2014, "Losada", 208, "Se trata de enviar a la Luna un proyectil que, auxiliado por el monstruoso cañón Columbiad, hará la función de una auténtica nave espacial para hacer realidad en el siglo XIX un viejo sueño: atravesar el espacio y descubrir un mundo lunar hasta entonces en penumbras.", $autor2);

$lectura1 = new Lectura($libro1, 5);

$valor = $lectura1->siguientePagina();
if($valor == ($lectura1->getLibro()->getCantPaginas())){
    $aux[] = ($lectura1->getLibro());
    $lectura1->setLibrosLeidos($aux);
}

$valor = $lectura1->irPagina(256);
if($valor == ($lectura1->getLibro()->getCantPaginas())){
    $aux[] = $lectura1->getLibro();
    $lectura1->setLibrosLeidos($aux);
}

//echo ($lectura1->__toString());


$valor = $lectura1->retrocederPagina();
if($valor == ($lectura1->getLibro()->getCantPaginas())){
    $aux[] = $lectura1->getLibro();
    $lectura1->setLibrosLeidos($aux);
}


$lectura1 = new Lectura($libro2, 206);
$valor = $lectura1->siguientePagina();
if($valor == ($lectura1->getLibro()->getCantPaginas())){
    $aux[] = $lectura1->getLibro();
    $lectura1->setLibrosLeidos($aux);
}

$valor = $lectura1->siguientePagina();
if($valor == ($lectura1->getLibro()->getCantPaginas())){
    $aux[] = $lectura1->getLibro();
    $lectura1->setLibrosLeidos($aux);
}
echo ($lectura1->__toString());


echo "\n CANTIDAD LEíDOS: ".count($lectura1->getLibrosLeidos());
