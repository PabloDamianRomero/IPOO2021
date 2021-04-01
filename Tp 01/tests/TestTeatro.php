<?php
include '../Teatro.php';

$colFunciones = array();
$colFunciones[0] = array("nombreF" => "ShowMax", "precioF" => 500);
$colFunciones[1] = array("nombreF" => "Virtud", "precioF" => 450);
$colFunciones[2] = array("nombreF" => "5g", "precioF" => 250);
$colFunciones[3] = array("nombreF" => "php para todos", "precioF" => 600);

$teatro1 = new Teatro("Luna", "Lincoln 35", $colFunciones); // Creación de un teatro

echo ($teatro1->__toString());

function menu()
{
    echo "\n-------------------------------------------------------------\n";
    echo "\n1 - Cambiar nombre del teatro";
    echo "\n2 - Cambiar la dirección del teatro";
    echo "\n3 - Cambiar el nombre de una función (Funciones de 1 a 4)";
    echo "\n4 - Cambiar el precio de una función (Funciones de 1 a 4)";
    echo "\n5 - Mostrar datos";
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

do {
    menu();
    $op = trim(fgets(STDIN));
    switch ($op) {
        case 1:
            echo "\nIngrese nuevo nombre: ";
            $nombreNuevo = trim(fgets(STDIN));
            $teatro1->cambiarNombreTeatro($nombreNuevo);
            break;
        case 2:
            echo "\nIngrese nueva dirección: ";
            $nuevaDir = trim(fgets(STDIN));
            $teatro1->cambiarDireccionTeatro($nuevaDir);
            break;
        case 3:
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
            break;
        case 4:
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

            break;
        case 5:
            echo $teatro1->__toString();
            break;
    }

} while ($op > 0 && $op < 6);
