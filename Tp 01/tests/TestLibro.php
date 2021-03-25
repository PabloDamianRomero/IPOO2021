<?php
include 'Libro.php';

$libro1 = new Libro(9789876097260, "La Condena del Restaurador", 2018, "Del Nuevo Extremo", "Cezilla", "Lontrato");
$libro2 = new Libro(9788493996307, "Hagakure", 2012, "Claridad", "Yamamoto", "Tsunetomo");
$libro3 = new Libro(9789500399807, "De La Tierra A La Luna", 2014, "Losada", "Julio", "Verne");
$libro4 = new Libro(9789500372909, "El Corsario Negro", 2016, "Losada", "Emilio", "Salgari");

$colLibros = array();
$colLibros[0] = $libro1;
$colLibros[1] = $libro2;
$colLibros[2] = $libro3;
$colLibros[3] = $libro4;

//print_r($colLibros);

echo $libro1->__toString();
echo $libro2->__toString();
echo $libro3->__toString();
echo $libro4->__toString();

$resp = $libro1->perteneceEditorial("Del Nuevo Extremo");
if($resp){
    echo "\nLibro 1, pertenece a editorial. ";
}else{
    echo "\nLibro 1, NO pertenece a editorial. ";
}

echo "\n-----------------------------------------\n";

$existe = $libro1 -> iguales($libro1,$colLibros);
if($existe){
    echo "\nEl libro existe en la colección. ";
}else{
    echo "\nEl libro no existe en la colección. ";
}

echo "\n-----------------------------------------\n";

$tiempoTranscurrido = $libro3 -> aniosDesdeEdicion();
echo "\nAños desde edición hasta hoy: ".$tiempoTranscurrido;
