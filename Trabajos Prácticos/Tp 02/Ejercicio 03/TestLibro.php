<?php
include 'Libro.php';
include 'Persona.php';

$autor1 = new Persona("Cezilla", "Lontrato", "DNI", 11111111);
$autor2 = new Persona("Yamamoto", "Tsunetomo", "DNI", 22222222);
$autor3 = new Persona("Julio", "Verne", "DNI", 33333333);
$autor4 = new Persona("Emilio", "Salgari", "DNI", 44444444);

$libro1 = new Libro(9789876097260, "La Condena del Restaurador", 2018, "Del Nuevo Extremo", 256, "Tanner Davis es un restaurador de muebles y objetos cuyo cumpleaños número treinta vendrá acompañado de una maldición. Será visitado por los antiguos dueños de las piezas que restaure para que cumpla con los deseos que ellos no pueden realizar.", $autor1);
$libro2 = new Libro(9788493996307, "Hagakure", 2012, "Claridad", 204, "Hagakure significa 'oculto bajo las hojas', es inspirado en el célebre código Bushido. Señala el camino del guerrero, cuyos preceptos filosóficos y ética trascendental presentan al Bushi. Bushido es vivir incluso cuando ya no se tienen deseos de vivir.", $autor2);
$libro3 = new Libro(9789500399807, "De La Tierra A La Luna", 2014, "Losada", 208, "Se trata de enviar a la Luna un proyectil que, auxiliado por el monstruoso cañón Columbiad, hará la función de una auténtica nave espacial para hacer realidad en el siglo XIX un viejo sueño: atravesar el espacio y descubrir un mundo lunar hasta entonces en penumbras.", $autor3);
$libro4 = new Libro(9789500372909, "El Corsario Negro", 2016, "Losada", 198, "Cuando el Corsario Negro conoce que el malvado gobernador Van Guld ha ahorcado a sus hermanos, El Corsario Rojo y el Corsario Verde, se adentra con unos pocos hombres en la ciudad de Maracaibo para recuperar sus cuerpos y darles sepultura en alta mar.", $autor4);

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
if ($resp) {
    echo "\nLibro 1, pertenece a editorial. ";
} else {
    echo "\nLibro 1, NO pertenece a editorial. ";
}

echo "\n-----------------------------------------\n";

$existe = $libro1->iguales($libro1, $colLibros);
if ($existe) {
    echo "\nEl libro existe en la colección. ";
} else {
    echo "\nEl libro no existe en la colección. ";
}

echo "\n-----------------------------------------\n";

$tiempoTranscurrido = $libro3->aniosDesdeEdicion();
echo "\nAños desde edición hasta hoy: " . $tiempoTranscurrido . "\n";

echo "\n-----------------------------------------\n";

$filtro = $libro1->libroDeEditoriales($colLibros, "Losada");

$largoFiltro = count($filtro);
echo "\n Libros que pertenecen a cierta editorial: ";
for ($i = 0; $i < $largoFiltro; $i++) {
    echo "\n" . $filtro[$i]["Datos"];
}
