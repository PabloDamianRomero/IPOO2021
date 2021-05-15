<?php

include 'Teatro.php';
include 'Funcion.php';
include 'Cine.php';
include 'Musical.php';
include 'ObraTeatral.php';

$colFunciones = array();
$objTeatro = null;

/**
 *  Imprimir menú por consola
 */
function menu()
{
    echo "\n-------------------------------------------";
    echo "\n 1       - Crear teatro. ";
    echo "\n 2       - Agregar funciones al teatro. ";
    echo "\n 3       - Cambiarle el nombre al teatro. ";
    echo "\n 4       - Cambiarle la dirección al teatro. ";
    echo "\n 5       - Modificar datos de una función. ";
    echo "\n 6       - Mostrar datos. ";
    echo "\n 7       - Dar costos según mes. ";
    echo "\n Otro n° - Salir. ";
    echo "\n-------------------------------------------";
}

/**
 *  OPCIÓN 1 DEL MENÚ
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

/**
 *  OPCIÓN 2 DEL MENÚ
 */

#function cargarFuncion($objTeatro, $colFunciones)
function cargarFuncion($objTeatro)
{
    do {
        echo "\n Ingrese la hora de inicio de la función: ";
        $hsInicio = trim(fgets(STDIN));
        echo "\n Ingrese la duración(hs) la función: ";
        $duracion = trim(fgets(STDIN));
        $funcionEsValida = $objTeatro->horarioSePisa($hsInicio);
        if ($funcionEsValida == false) { // Si no se pisa
            echo "\n Ingrese el nombre de la función: ";
            $nombreFuncion = trim(fgets(STDIN));
            echo "\n Ingrese el precio de la función: ";
            $precioFuncion = trim(fgets(STDIN));
            do {
                echo "\n Ingrese el mes de la función: ";
                $mesFuncion = trim(fgets(STDIN));
            } while ($mesFuncion < 1 && $mesFuncion > 12);

            echo "\n Ingrese el número según el tipo de función (1 = CINE ; 2 = MUSICAL ; 3 = OBRA TEATRAL): ";
            $tipo = trim(fgets(STDIN));
            switch ($tipo) {
                case 1:
                    echo "\n Ingrese el género de la película: ";
                    $genero = trim(fgets(STDIN));
                    echo "\n Ingrese país de origen: ";
                    $origen = trim(fgets(STDIN));
                    $objFuncion = new Cine($nombreFuncion, $hsInicio, $duracion, $precioFuncion, $mesFuncion, $genero, $origen);
                    $colFunciones = $objTeatro->getColObjFunciones();
                    $colFunciones[count($colFunciones)] = $objFuncion;
                    $objTeatro->setColObjFunciones($colFunciones);
                    break;
                case 2:
                    echo "\n Ingrese el director de musical: ";
                    $director = trim(fgets(STDIN));
                    echo "\n Ingrese la cantidad de personas en escena: ";
                    $cantPersonas = trim(fgets(STDIN));
                    $objFuncion = new Musical($nombreFuncion, $hsInicio, $duracion, $precioFuncion, $mesFuncion, $director, $cantPersonas);
                    $colFunciones = $objTeatro->getColObjFunciones();
                    $colFunciones[count($colFunciones)] = $objFuncion;
                    $objTeatro->setColObjFunciones($colFunciones);
                    break;
                case 3:
                    echo "\n Ingrese el nombre del autor: ";
                    $autor = trim(fgets(STDIN));
                    $objFuncion = new ObraTeatral($nombreFuncion, $hsInicio, $duracion, $precioFuncion, $mesFuncion, $autor);
                    $colFunciones = $objTeatro->getColObjFunciones();
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
    return $objTeatro;
}

/**
 * Ejecución de opciones del menú (PROGRAMA PRINCIPAL)
 */
function main($objTeatro, $colFunciones)
{
    do {
        menu();
        $op = trim(fgets(STDIN));
        switch ($op) {
            case 1: # Crear teatro
                $objTeatro = cargarTeatro($objTeatro);
                if ($objTeatro != null) {
                    echo "\nTEATRO CREADO CON ÉXITO.";
                } else {
                    echo "\nERROR. NO SE PUDO CREAR EL TEATRO";
                }
                break;
            case 2: # Agregar funciones al teatro
                if ($objTeatro != null) {
                    #$colFunciones = cargarFuncion($objTeatro, $colFunciones);
                    $objTeatro = cargarFuncion($objTeatro);
                    $colFunciones = $objTeatro->getColObjFunciones();
                    if (count($colFunciones) != 0) {
                        #$objTeatro->setColObjFunciones($colFunciones);
                        echo "\nFunciones cargadas con exito.";
                    } else {
                        echo "\nERROR. Funciones no cargadas";
                    }
                } else {
                    echo "\nTEATRO NO EXISTE";
                }

                break;
            case 3: # Cambiarle el nombre al teatro
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
                    echo "\nNo existe ningún teatro.";
                }
                break;
            case 4: # Cambiarle la dirección al teatro
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
                    echo "\nNo existe ningún teatro.";
                }
                break;
            case 5: # Modificar datos de una función
                if ($objTeatro != null) {
                    echo "\nIngrese nombre de la función que desea cambiar: ";
                    $nombreBusca = trim(fgets(STDIN));
                    $posicionFuncion = $objTeatro->buscarFuncion($nombreBusca);
                    if ($posicionFuncion != -1) {
                        echo "\nFunción encontrada. Ingrese nuevo nombre: ";
                        $nuevoNombre = trim(fgets(STDIN));
                        echo "\nIngrese nuevo precio: ";
                        $nuevoPrecio = trim(fgets(STDIN));
                        echo "\n Ingrese nueva hora de inicio de la función: ";
                        $hsInicio = trim(fgets(STDIN));
                        echo "\n Ingrese nueva duración(hs) la función: ";
                        $duracion = trim(fgets(STDIN));
                        $exito = $objTeatro->modificarFuncion($posicionFuncion, $nuevoNombre, $nuevoPrecio, $hsInicio, $duracion);
                        if ($exito) {
                            echo "\nFunción modificada con exito";
                        } else {
                            echo "\nError. No se pudo modificar la función";
                        }
                    } else {
                        echo "\nLa función ingresada no existe en el teatro.";
                    }
                } else {
                    echo "\nNo existe ningún teatro.";
                }
                break;
            case 6: # Mostrar datos
                if ($objTeatro != null) {
                    echo $objTeatro;
                } else {
                    echo "\nNo existe ningún teatro.";
                }
                break;
            case 7: # Dar costos según mes
                if ($objTeatro != null) {
                    echo "\n Ingrese el mes para filtrar costos: ";
                    $mesFiltro = trim(fgets(STDIN));
                    if ($mesFiltro > 0 && $mesFiltro < 13) {
                        $costos = $objTeatro->darCostos($mesFiltro);
                        echo "\nCOSTOS (Mes " . $mesFiltro . "): " . $costos;
                    } else {
                        echo "\nValor incorrecto. Intente nuevamente";
                    }
                } else {
                    echo "\nNo existe ningún teatro.";
                }
                break;
        }
    } while ($op > 0 && $op < 8);
}

main($objTeatro, $colFunciones);
