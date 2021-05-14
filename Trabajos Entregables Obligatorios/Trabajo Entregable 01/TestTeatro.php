<?php
/**
 * PABLO DAMIAN ROMERO - FAI 1652
 *
 * Enlace gitHub: https://github.com/PabloDamianRomero/IPOO2021.git
 *
 * Nombre de la carpeta en el repositorio: Trabajo Entregable 01
 *
 * Un teatro se caracteriza por su nombre y su dirección y en él se realizan 4 funciones al día.
 * Cada función tiene un nombre y un precio. Realice el diseño de la clase Teatro e indique qué métodos
 * tendría que tener la clase, teniendo en cuenta que se pueda cambiar el nombre del teatro y la dirección,
 * el nombre de una función y el precio.
 * Implementar las 4 funciones usando array de array asociativo.
 * Cada función es un array asociativo con las claves “nombre” y “precio”.
 * */

include 'Teatro.php';

$colFunciones = array();
$teatro1 = null;

function funcionesPredeterminadas()
{
    $colFunciones[0] = array("nombreF" => "ShowMax", "precioF" => 500);
    $colFunciones[1] = array("nombreF" => "Virtud", "precioF" => 450);
    $colFunciones[2] = array("nombreF" => "5g", "precioF" => 250);
    $colFunciones[3] = array("nombreF" => "php para todos", "precioF" => 600);

    $teatro1 = new Teatro("Luna", "Lincoln 35", $colFunciones); // Creación de un teatro
    return $teatro1;
}

function cargaManual()
{
    echo "\nIngrese el nombre del teatro: ";
    $nombreTeatro = trim(fgets(STDIN));
    echo "\nIngrese la dirección del teatro: ";
    $direccionTeatro = trim(fgets(STDIN));
    $cont = 1;
    for ($i = 0; $i < 4; $i++) {
        echo "\nIngrese el nombre de la función n° " . $cont . ": ";
        $nombreFuncion = trim(fgets(STDIN));
        echo "\nIngrese el precio de la funcion n° " . $cont . ": ";
        $precioFuncion = trim(fgets(STDIN));
        $colFunciones[$i] = array("nombreF" => $nombreFuncion, "precioF" => $precioFuncion);
        $cont++;
    }
    $teatro1 = new Teatro($nombreTeatro, $direccionTeatro, $colFunciones);
    return $teatro1;
}

function menu()
{
    echo "\n-------------------------------------------------------------\n";
    echo "\n1 - Utilizar teatro y funciones predeterminadas";
    echo "\n2 - Crear un nuevo teatro y funciones";
    echo "\n3 - Cambiar nombre del teatro";
    echo "\n4 - Cambiar la dirección del teatro";
    echo "\n5 - Cambiar el nombre de una función (Funciones de 1 a 4)";
    echo "\n6 - Cambiar el precio de una función (Funciones de 1 a 4)";
    echo "\n7 - Mostrar datos";
    echo "\nOtro n° - Salir";
    echo "\n-------------------------------------------------------------\n";
}

function comprobarIndice($n)
{
    $respuesta = false;
    if ($n >= 1 && $n <= 4) {
        $respuesta = true;
    }
    return $respuesta;
}

function main($teatro1, $colFunciones)
{
    do {
        menu();
        $op = trim(fgets(STDIN));
        switch ($op) {
            case 1:
                $teatro1 = funcionesPredeterminadas();
                echo "\nTeatro y funciones cargadas.";
                break;
            case 2:
                $teatro1 = cargaManual();
                echo "\nTeatro y funciones cargadas.";
                break;
            case 3:
                if ($teatro1 != null) {
                    echo "\nIngrese nuevo nombre: ";
                    $nombreNuevo = trim(fgets(STDIN));
                    $teatro1->cambiarNombreTeatro($nombreNuevo);
                } else {
                    echo "\nNo existe el teatro.";
                }
                break;
            case 4:
                if ($teatro1 != null) {
                    echo "\nIngrese nueva dirección: ";
                    $nuevaDir = trim(fgets(STDIN));
                    $teatro1->cambiarDireccionTeatro($nuevaDir);
                } else {
                    echo "\nNo existe el teatro.";
                }
                break;
            case 5:
                if ($teatro1 != null) {
                    echo "\nIngrese número de función válida: ";
                    $numFuncion = trim(fgets(STDIN));
                    if (comprobarIndice($numFuncion)) {
                        echo "\nIngrese el nuevo nombre de la función n° " . $numFuncion . " ";
                        $nombreFuncion = trim(fgets(STDIN));
                        $numFuncion = $numFuncion - 1;
                        $teatro1->cambiarNombreFuncion($numFuncion, $nombreFuncion);
                    } else {
                        echo "\nNúmero de función incorrecto. ";
                    }
                } else {
                    echo "\nNo existe el teatro.";
                }
                break;
            case 6:
                if ($teatro1 != null) {
                    echo "\nIngrese número de función válida: ";
                    $numFuncion = trim(fgets(STDIN));
                    if (comprobarIndice($numFuncion)) {
                        echo "\nIngrese el nuevo precio de la función n° " . $numFuncion . " ";
                        $precio = trim(fgets(STDIN));
                        $numFuncion = $numFuncion - 1;
                        $teatro1->cambiarPrecioFuncion($numFuncion, $precio);
                    } else {
                        echo "\nNúmero de función incorrecto. ";
                    }
                } else {
                    echo "\nNo existe el teatro.";
                }
                break;
            case 7:
                if ($teatro1 != null) {
                    echo $teatro1->__toString();
                } else {
                    echo "\nNo existe un teatro para mostrar sus datos.";
                }
                break;
        }
    } while ($op > 0 && $op < 8);
}

main($teatro1, $colFunciones);
