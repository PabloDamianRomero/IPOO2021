<?php
include 'Lectura.php';
include 'Persona.php';
include 'Libro.php';

$aux = array();
$lectura1 = null;

function opciones()
{
    echo "\n-----------------------MENU------------------------------";
    echo "\n-----------------------------------------------------";
    echo "\n1 - Agregar libro 1";
    echo "\n2 - Agregar libro 2";
    echo "\n3 - Siguiente página";
    echo "\n4 - Retroceder página";
    echo "\n5 - Ir a página";
    echo "\n6 - Mostrar datos";
    echo "\n7 - Dar sinopsis de un libro leído según su título";
    echo "\n8 - Libros leídos en tal año";
    echo "\n9 - Libros leídos por autor";
    echo "\nOtro n° - Salir";
    echo "\n-----------------------------------------------------";
    echo "\n-----------------------------------------------------";
}

function agregarLibroPredeterminado1()
{
    $autor1 = new Persona("Cezilla", "Lontrato", "DNI", 11111111);
    $libro1 = new Libro(9789876097260, "La Condena del Restaurador", 2018, "Del Nuevo Extremo", 256, "Tanner Davis es un restaurador de muebles y objetos cuyo cumpleaños número treinta vendrá acompañado de una maldición. Será visitado por los antiguos dueños de las piezas que restaure para que cumpla con los deseos que ellos no pueden realizar.", $autor1);
    $lec = new Lectura($libro1, 5);
    return $lec;
}

function agregarLibroPredeterminado2()
{
    $autor2 = new Persona("Julio", "Verne", "DNI", 33333333);
    $libro2 = new Libro(9789500399807, "De La Tierra A La Luna", 2014, "Losada", 208, "Se trata de enviar a la Luna un proyectil que, auxiliado por el monstruoso cañón Columbiad, hará la función de una auténtica nave espacial para hacer realidad en el siglo XIX un viejo sueño: atravesar el espacio y descubrir un mundo lunar hasta entonces en penumbras.", $autor2);
    $lec = new Lectura($libro2, 100);
    return $lec;
}

$valor = 0;
$cont = 0;
do {
    opciones();
    $op = trim(fgets(STDIN));
    switch ($op) {
        case 1: // Agregar libro 1
            $lectura1 = agregarLibroPredeterminado1();
            $lectura1->setLibrosLeidos($aux);
            break;
        case 2: // Agregar libro 2
            $lectura1 = agregarLibroPredeterminado2();
            $lectura1->setLibrosLeidos($aux);
            break;
        case 3: // Siguiente página
            if ($lectura1 != null) {
                $valor = $lectura1->siguientePagina();
                if ($valor == ($lectura1->getLibro()->getCantPaginas())) {
                    if ($lectura1->getLibrosLeidos() != null) {
                        $cont = $cont + count($lectura1->getLibrosLeidos());
                    }
                    $aux[$cont] = ($lectura1->getLibro());
                    $lectura1->setLibrosLeidos($aux);
                }
            } else {
                echo "\nNo existen libros";
            }
            break;
        case 4: // Retroceder página
            if ($lectura1 != null) {
                $valor = $lectura1->retrocederPagina();
                if ($valor == ($lectura1->getLibro()->getCantPaginas())) {
                    if ($lectura1->getLibrosLeidos() != null) {
                        $cont = $cont + count($lectura1->getLibrosLeidos());
                    }
                    $aux[$cont] = $lectura1->getLibro();
                    $lectura1->setLibrosLeidos($aux);
                }
            } else {
                echo "\nNo existen libros";
            }
            break;
        case 5: // Ir a x página
            if ($lectura1 != null) {
                echo "\nIngrese página a saltar: ";
                $siguiente = trim(fgets(STDIN));
                $valor = $lectura1->irPagina($siguiente);
                if ($valor == ($lectura1->getLibro()->getCantPaginas())) {
                    if ($lectura1->getLibrosLeidos() != null) {
                        $cont = $cont + count($lectura1->getLibrosLeidos());
                    }
                    $aux[$cont] = $lectura1->getLibro();
                    $lectura1->setLibrosLeidos($aux);
                }
            } else {
                echo "\nNo existen libros";
            }
            break;
        case 6: // Mostrar datos
            if ($lectura1 != null) {
                echo $lectura1->__toString();
            } else {
                echo "\nNo existen libros";
            }
            break;
        case 7:
            if ($lectura1 != null) {
                echo "\nIngrese el titulo del libro para ver su sinopsis: ";
                $buscaTitulo = trim(fgets(STDIN));
                $sinopsis = $lectura1->darSinopsis($buscaTitulo);
                echo "\n" . $sinopsis;
            } else {
                echo "\nNo existen libros";
            }
            break;
        case 8:
            if ($lectura1 != null) {
                echo "\nIngrese año del libro: ";
                $anioBusca = trim(fgets(STDIN));
                $col = $lectura1->leidosAnioEdicion($anioBusca);
                if ($col != null) {
                    $long = count($col);
                    echo "\n\t********LIBROS LEÍDOS DEL AÑO " . $anioBusca . "********";
                    for ($i = 0; $i < $long; $i++) {
                        echo "\n" . $col[$i];
                    }
                } else {
                    echo "\nNo existen libros leídos en ese año";
                }
            }
            break;
        case 9:
            if ($lectura1 != null) {
                echo "\nIngrese solo el nombre del autor: ";
                $nombreBusca = trim(fgets(STDIN));
                $col = $lectura1->darLibrosPorAutor($nombreBusca);
                if ($col != null) {
                    $long = count($col);
                    echo "\n\t********LIBROS LEÍDOS DEL AUTOR " . $nombreBusca . "********";
                    for ($i = 0; $i < $long; $i++) {
                        echo "\n" . $col[$i];
                    }
                }else{
                    echo "\nNo se ha leído el libro de ese autor todavía";
                }
            } else {
                echo "\nNo existen libros leídos por ese autor";
            }
            break;
    }
} while ($op > 0 && $op <= 9);

if ($lectura1->getLibrosLeidos() != null) {
    echo "\n CANTIDAD LEíDOS: " . count($lectura1->getLibrosLeidos());
} else {
    echo "\n CANTIDAD LEíDOS: 0";
}
