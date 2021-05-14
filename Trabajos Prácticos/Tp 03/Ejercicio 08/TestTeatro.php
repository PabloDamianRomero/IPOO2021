<?php

include 'Teatro.php';
include 'Funcion.php';
include 'Cine.php';
include 'Musical.php';
include 'ObraTeatral.php';


$colFunciones = array();
$objTeatro = null;

/**
 *
 */
function menu()
{
    echo "\n-------------------------------------------";
    echo "\n 1       - Crear teatro. ";
    echo "\n 2       - Agregar funciones al teatro. ";
    echo "\n 3       - Cambiarle el nombre al teatro. ";
    echo "\n 4       - Cambiarle la dirección al teatro. ";
    echo "\n 5       - Cambiar nombre y precio de una función. ";
    echo "\n 6       - Mostrar datos. ";
    echo "\n 7       - Dar costos. ";
    echo "\n Otro n° - Salir. ";
    echo "\n-------------------------------------------";
}

/**
 *
 */
function cargarTeatro($objTeatro)
{
    echo "\n Ingrese nombre de teatro: ";
    $nombreTeatro = trim(fgets(STDIN));
    echo "\n Ingrese la dirección del teatro: ";
    $dirTeatro = trim(fgets(STDIN));
    $objTeatro = new Teatro($nombreTeatro, $dirTeatro, array());
    return $objTeatro;
}

function cargarFuncion($objTeatro, $colFunciones)
{
    do {
        echo "\n Ingrese la hora de inicio de la función: ";
        $hsInicio = trim(fgets(STDIN));
        echo "\n Ingrese la duración(hs) la función: ";
        $duracion = trim(fgets(STDIN));
        $funcionEsValida = $objTeatro->horarioSePisa($hsInicio);
        if ($funcionEsValida == false) {
            echo "\n Ingrese el nombre de la función: ";
            $nombreFuncion = trim(fgets(STDIN));
            echo "\n Ingrese el precio de la función: ";
            $precioFuncion = trim(fgets(STDIN));
            echo "\n Ingrese el número según el tipo de función (1 = CINE ; 2 = MUSICAL ; 3 = OBRA TEATRAL)";
            $tipo = trim(fgets(STDIN));
            switch ($tipo) {
                case 1:
                    echo "\nIngrese el género de la película: ";
                    $genero = trim(fgets(STDIN));
                    echo "\nIngrese país de origen: ";
                    $origen = trim(fgets(STDIN));
                    $objFuncion = new Cine($nombreFuncion, $hsInicio, $duracion, $precioFuncion, $genero, $origen);
                    $colFunciones[count($colFunciones)] = $objFuncion;
                    $objTeatro->setColObjFunciones($colFunciones);
                    break;
                case 2:
                    echo "\nIngrese el director de musical: ";
                    $director = trim(fgets(STDIN));
                    echo "\nIngrese la cantidad de personas en escena: ";
                    $cantPersonas = trim(fgets(STDIN));
                    $objFuncion = new Musical($nombreFuncion, $hsInicio, $duracion, $precioFuncion, $director, $cantPersonas);
                    $colFunciones[count($colFunciones)] = $objFuncion;
                    $objTeatro->setColObjFunciones($colFunciones);
                    break;
                case 3:
                    echo "\nIngrese el nombre del autor: ";
                    $autor = trim(fgets(STDIN));
                    $objFuncion = new ObraTeatral($nombreFuncion, $hsInicio, $duracion, $precioFuncion, $autor);
                    $colFunciones[count($colFunciones)] = $objFuncion;
                    $objTeatro->setColObjFunciones($colFunciones);
                    break;
            }

        } else {
            echo "\n No se puede agregar esta función, los horarios se solapan.";
        }
        echo "\nIngresar otra función (s/n)";
        $seguir = trim(fgets(STDIN));
        $ultHs = $objTeatro->ultimaHora();
        $perteneceUnDia = $objTeatro->correspondeAUnDia($ultHs);
    } while (($seguir == "s") && ($perteneceUnDia));
    return $colFunciones;
}

/**
 *
 */
function main($objTeatro, $colFunciones)
{
    do {
        menu();
        $op = trim(fgets(STDIN));
        switch ($op) {
            case 1:
                $objTeatro = cargarTeatro($objTeatro);
                if ($objTeatro != null) {
                    echo "\nTEATRO CREADO CON ÉXITO.";
                } else {
                    echo "\nERROR. NO SE PUDO CREAR EL TEATRO";
                }
                break;
            case 2:
                if ($objTeatro != null) {
                    $colFunciones = cargarFuncion($objTeatro, $colFunciones);
                    if (count($colFunciones) != 0) {
                        $objTeatro->setColObjFunciones($colFunciones);
                        echo "\nFunciones cargadas con exito.";
                    } else {
                        echo "\nERROR. Funciones no cargadas";
                    }
                } else {
                    echo "\nTEATRO NO EXISTE";
                }

                break;
            case 3:
                if ($objTeatro != null) {
                    echo "\nIngrese el nuevo nombre del teatro: ";
                    $nuevoNombre = trim(fgets(STDIN));
                    $exito = $objTeatro->cambiarNombreTeatro($nuevoNombre);
                    if ($exito) {
                        echo "\nNombre del teatro cambiado exitosamente.";
                    } else {
                        echo "\nERROR. El nombre del teatro no pudo ser cambiado";
                    }
                } else {
                    echo "\nNo existe nigún teatro.";
                }
                break;
            case 4:
                if ($objTeatro != null) {
                    echo "\nIngrese la nueva dirección del teatro: ";
                    $nuevaDir = trim(fgets(STDIN));
                    $exito = $objTeatro->cambiarDireccionTeatro($nuevaDir);
                    if ($exito) {
                        echo "\nDirección del teatro cambiada exitosamente.";
                    } else {
                        echo "\nERROR. La dirección del teatro no pudo ser cambiada";
                    }
                } else {
                    echo "\nNo existe nigún teatro.";
                }
                break;
            case 5: // Cambiar nombre y precio de una función
                echo "\nIngrese nombre de la función que desea cambiar: ";
                $nombreBusca = trim(fgets(STDIN));
                $posicionFuncion = $objTeatro->buscarFuncion($nombreBusca);
                if ($posicionFuncion != -1) {
                    echo "\nFunción encontrada. Ingrese nuevo nombre: ";
                    $nuevoNombre = trim(fgets(STDIN));
                    echo "\nIngrese nuevo precio: ";
                    $nuevoPrecio = trim(fgets(STDIN));
                    $exito = $objTeatro->modificarFuncion($posicionFuncion, $nuevoNombre, $nuevoPrecio);
                    if ($exito) {
                        echo "\nFunción modificada con exito";
                    } else {
                        echo "\nError. No se pudo modificar la función";
                    }
                } else {
                    echo "\nLa función ingresada no existe en el teatro.";
                }
                break;
            case 6: // Mostrar Datos
                if ($objTeatro != null) {
                    echo $objTeatro;
                } else {
                    echo "\nNo existe nigún teatro.";
                }
                break;
            case 7:
                if($objTeatro != null){
                    $costos = $objTeatro->darCostos();
                    echo "\nCOSTOS: ".$costos;
                }
                break;
        }
    } while ($op > 0 && $op < 8);
}

main($objTeatro, $colFunciones);
