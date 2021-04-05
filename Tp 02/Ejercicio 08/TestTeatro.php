<?php
include 'Teatro.php';
include 'Funcion.php';

$colFunciones = array();
$colTeatros = array();

$objTeatro = null;
$objFuncion = null;

function menu()
{
    echo "\n-------------------------------------------";
    echo "\n 1       - Agregar nuevo teatro. ";
    echo "\n 2       - Agregar funciones a un teatro. ";
    echo "\n 3       - Cambiarle el nombre a un teatro. ";
    echo "\n 4       - Cambiarle la dirección a un teatro. ";
    echo "\n 5       - Cambiar nombre de una función. ";
    echo "\n 6       - Cambiar precio de una función. ";
    echo "\n 7       - Mostrar datos. ";
    echo "\n Otro n° - Salir. ";
    echo "\n-------------------------------------------";
}

/**
 * Funcion que permite crear un teatro y almacenarle cierta cantidad de funciones
 */
function cargarTeatro($colTeatros, $colFunciones, $objTeatro)
{
    echo "\n Ingrese nombre de teatro: ";
    $nombreTeatro = trim(fgets(STDIN));
    echo "\n Ingrese la dirección del teatro: ";
    $dirTeatro = trim(fgets(STDIN));
    echo "\n Cantidad de funciones del teatro " . $nombreTeatro . "? : ";
    $cantFunciones = trim(fgets(STDIN));
    $contadorFuncion = 1;
    $anterior = 0;
    $i = 0;
    $seguir = true;
    while (($i < $cantFunciones) && $seguir) { // Repetitiva que permite el ingreso de funciones, hasta que lo permita el horario del teatro
        echo "\n Ingrese el nombre de la función " . $contadorFuncion . ": ";
        $nombreFuncion = trim(fgets(STDIN));
        do { // Repetitiva para pedir continuamente la hora, en caso de ser incorrecta (por función)
            echo "\n Ingrese la hora de inicio de la función " . $contadorFuncion . " (Recuerde que debe ser 1hr después de haber terminado la función anterior o a partir de cero si es la primera): ";
            $horaInicio = trim(fgets(STDIN));
            echo "\n Cuántas hs dura la función " . $contadorFuncion . "?: ";
            $duracionFuncion = trim(fgets(STDIN));
            $resp = verificarHorarios($anterior, $horaInicio, $duracionFuncion); // verifica si la hora ingresada es valida (0 a 23hs)
            if (!$resp) {
                echo "\n\n Deberá ingresar nuevamente los horarios. (El horario se vió pisado con el anterior)\n";
            } else {
                $anterior = $horaInicio + $duracionFuncion;
                $seguir = verificarUltimaHora($anterior); // si quedan funciones por ingresar pero ya se completó el horario, se utiliza este atributo como condicion de corte
            }
        } while (!$resp);
        echo "\n Ingrese el precio de la función " . $contadorFuncion . ": ";
        $precioFuncion = trim(fgets(STDIN));
        $objFuncion = new Funcion($nombreFuncion, $horaInicio, $duracionFuncion, $precioFuncion);
        $colFunciones[$i] = $objFuncion;
        $contadorFuncion++;
        $i++;
    }
    if (!$seguir) {
        echo "\nLos horarios del teatro fueron todos ocupados. No se permiten nuevas funciones. ";
    }
    $objTeatro = new Teatro($nombreTeatro, $dirTeatro, $colFunciones);
    $cantidadTeatros = count($colTeatros);
    $colTeatros[$cantidadTeatros] = $objTeatro;
    return $colTeatros;
}


/**
 * Función que permite agregarle funciones a un teatro en particular (existente)
 */
function cargarFunciones($colTeatros, $cant, $nroTeatro)
{
    $contadorFuncion = count($colTeatros[$nroTeatro]->getFunciones());
    $auxFunciones = $colTeatros[$nroTeatro]->getFunciones();
    $anterior = $auxFunciones[$contadorFuncion - 1]->getHoraInicio() + $auxFunciones[$contadorFuncion - 1]->getDuracion();
    $seguir = verificarUltimaHora($anterior);
    if ($seguir) { // Verifica si la primera ejecución puede realizarse, en base al último horario de la función
        $valorDePosicionActual = $contadorFuncion + 1;
        $i = 0;
        while (($i < $cant) && ($seguir)) { // Repetiva para almacenar nuevas funciones
            echo "\n Ingrese el nombre de la función " . $valorDePosicionActual . ": ";
            $nombreFuncion = trim(fgets(STDIN));
            do { // Repetitiva para pedir continuamente la hora, en caso de ser incorrecta (por función)
                echo "\n Ingrese la hora de inicio de la función " . $valorDePosicionActual . " (Recuerde que debe ser 1hr después de haber terminado la función anterior): ";
                $horaInicio = trim(fgets(STDIN));
                echo "\n Cuántas hs dura la función " . $valorDePosicionActual . "?: ";
                $duracionFuncion = trim(fgets(STDIN));
                $resp = verificarHorarios($anterior, $horaInicio, $duracionFuncion); // verifica si la hora ingresada es valida (0 a 23hs)
                if (!$resp) {
                    echo "\n\n Deberá ingresar nuevamente los horarios. (El horario se vió pisado con el anterior)\n";
                } else {
                    $anterior = $horaInicio + $duracionFuncion;
                    $seguir = verificarUltimaHora($anterior); // si quedan funciones por ingresar pero ya se completó el horario, se utiliza este atributo como condicion de corte
                }
            } while (!$resp);
            echo "\n Ingrese el precio de la función " . $valorDePosicionActual . ": ";
            $precioFuncion = trim(fgets(STDIN));
            $objFuncion = new Funcion($nombreFuncion, $horaInicio, $duracionFuncion, $precioFuncion);
            $auxFunciones[$contadorFuncion] = $objFuncion;
            $contadorFuncion++;
            $i++;
            if (!$seguir) { // Avisa por pantalla que a pesar de que queden funciones por ingresar, ya se completo el horario
                echo "\nHorarios completados, ya no se permite registrar otra función";
            }
        }
    } else {
        echo "\nYa no hay lugar para otra función, horarios completos";
    }
    return $auxFunciones;
}


/**
 * Función que verifica si el horario de una función corresponde con el ciclo de hora real de un dia (0 a 23)
 */
function verificarHorarios($anterior, $inicio, $fin)
{
    $respuesta = false;
    if (($inicio + $fin >= 0) && ($inicio + $fin <= 23)) {
        if ($inicio > $anterior) {
            $respuesta = true;
        }
    }
    return $respuesta;
}

/**
 * Función que verifica la hora de la última función de un teatro, especificando
 * si es posible agregar una nueva función
 */
function verificarUltimaHora($valor)
{
    $resp = true;
    if ($valor >= 22) {
        $resp = false;
    }
    return $resp;
}


function main($colTeatros, $colFunciones, $objTeatro)
{
    do {
        menu();
        $op = trim(fgets(STDIN));
        switch ($op) {
            case 1:
                $colTeatros = cargarTeatro($colTeatros, $colFunciones, $objTeatro);
                break;
            case 2:
                if ($colTeatros != null) {
                    $longitud = count($colTeatros);
                    echo "\nTeatros disponibles: \n";
                    for ($i = 0; $i < $longitud; $i++) {
                        echo "'" . $colTeatros[$i]->getNombreTeatro() . "'\t";
                    }
                    echo "\nIngrese el nombre del teatro al cual quiere añadirle funciones: ";
                    $nombreBusca = trim(fgets(STDIN));
                    $j = 0;
                    $encontrado = false;
                    while (($j < $longitud) && (!$encontrado)) {
                        if ($colTeatros[$j]->getNombreTeatro() == $nombreBusca) {
                            $encontrado = true;
                        } else {
                            $j++;
                        }
                    }
                    if ($encontrado) {
                        echo "\n Ingrese cantidad de funciones nuevas para teatro '" . $colTeatros[$j]->getNombreTeatro() . "': ";
                        $cantFunciones = trim(fgets(STDIN));
                        $tmpFuncion = cargarFunciones($colTeatros, $cantFunciones, $j);
                        $colTeatros[$j]->setFunciones($tmpFuncion);
                    } else {
                        echo "\nNo existe teatro con ese nombre";
                    }
                } else {
                    echo "\n No existen teatros";
                }
                break;
            case 3:
                if ($colTeatros != null) {
                    $longitud = count($colTeatros);
                    echo "\nTeatros disponibles: \n";
                    for ($i = 0; $i < $longitud; $i++) {
                        echo "'" . $colTeatros[$i]->getNombreTeatro() . "'\t";
                    }
                    echo "\nIngrese el nombre del teatro al cual quiere cambiarle el nombre: ";
                    $nombreBusca = trim(fgets(STDIN));
                    $j = 0;
                    $encontrado = false;
                    while (($j < $longitud) && (!$encontrado)) {
                        if ($colTeatros[$j]->getNombreTeatro() == $nombreBusca) {
                            $encontrado = true;
                        } else {
                            $j++;
                        }
                    }
                    if ($encontrado) {
                        echo "\nIngrese el nuevo nombre del teatro '" . $colTeatros[$j]->getNombreTeatro() . "': ";
                        $nuevoNombre = trim(fgets(STDIN));
                        $colTeatros[$j]->cambiarNombreTeatro($nuevoNombre);
                    } else {
                        echo "\nNo existe teatro con ese nombre";
                    }

                } else {
                    echo "\n No existen teatros";
                }
                break;
            case 4:
                if ($colTeatros != null) {
                    $longitud = count($colTeatros);
                    echo "\nTeatros disponibles: \n";
                    for ($i = 0; $i < $longitud; $i++) {
                        echo "'" . $colTeatros[$i]->getNombreTeatro() . "'\t";
                    }
                    echo "\nIngrese el nombre del teatro al cual quiere cambiarle la dirección: ";
                    $nombreBusca = trim(fgets(STDIN));
                    $j = 0;
                    $encontrado = false;
                    while (($j < $longitud) && (!$encontrado)) {
                        if ($colTeatros[$j]->getNombreTeatro() == $nombreBusca) {
                            $encontrado = true;
                        } else {
                            $j++;
                        }
                    }
                    if ($encontrado) {
                        echo "\nIngrese la nueva dirección del teatro '" . $colTeatros[$j]->getNombreTeatro() . "': ";
                        $nuevaDir = trim(fgets(STDIN));
                        $colTeatros[$j]->cambiarDireccionTeatro($nuevaDir);
                    } else {
                        echo "\nNo existe teatro con ese nombre";
                    }
                } else {
                    echo "\n No existen teatros";
                }
                break;
            case 5:
                if ($colTeatros != null) {
                    echo "\n Ingrese el nombre de la función a la que desea cambiarle el mismo: ";
                    $funcionBusca = trim(fgets(STDIN));
                    $i = 0;
                    $longitudTeatro = count($colTeatros);
                    $encontrado = false;
                    while (($i < $longitudTeatro) && (!$encontrado)) {
                        $aux = $colTeatros[$i]->getFunciones();
                        $longitudFunciones = count($aux);
                        $j = 0;
                        while (($j < $longitudFunciones) && (!$encontrado)) {
                            if ($aux[$j]->getNombreFuncion() == $funcionBusca) {
                                $encontrado = true;
                            } else {
                                $j++;
                            }
                        }
                        if ($encontrado) {
                            echo "\nIngrese el nuevo nombre de la función '" . $aux[$j]->getNombreFuncion() . "': ";
                            $nuevoNombre = trim(fgets(STDIN));
                            $colTeatros[$i]->cambiarNombreFuncion($j, $nuevoNombre);
                        }
                        $i++;
                    }
                    if (!$encontrado) {
                        echo "\nNo existe funcion con ese nombre";
                    }

                } else {
                    echo "\n No existen teatros";
                }
                break;
            case 6:
                if ($colTeatros != null) {
                    echo "\n Ingrese el nombre de la función a la que desea cambiarle el precio: ";
                    $funcionBusca = trim(fgets(STDIN));
                    $i = 0;
                    $longitudTeatro = count($colTeatros);
                    $encontrado = false;
                    while (($i < $longitudTeatro) && (!$encontrado)) {
                        $aux = $colTeatros[$i]->getFunciones();
                        $longitudFunciones = count($aux);
                        $j = 0;
                        while (($j < $longitudFunciones) && (!$encontrado)) {
                            if ($aux[$j]->getNombreFuncion() == $funcionBusca) {
                                $encontrado = true;
                            } else {
                                $j++;
                            }
                        }
                        if ($encontrado) {
                            echo "\nIngrese el nuevo precio de la función '" . $aux[$j]->getNombreFuncion() . "': ";
                            $nuevoPrecio = trim(fgets(STDIN));
                            $colTeatros[$i]->cambiarPrecioFuncion($j, $nuevoPrecio);
                        }
                        $i++;
                    }
                    if (!$encontrado) {
                        echo "\nNo existe funcion con ese nombre";
                    }

                } else {
                    echo "\n No existen teatros";
                }
                break;
            case 7:
                if ($colTeatros != null) {
                    $longitud = count($colTeatros);
                    for ($i = 0; $i < $longitud; $i++) {
                        echo "\n" . $colTeatros[$i]->__toString();
                    }
                } else {
                    echo "\n COLECCION DE TEATROS VACíA";
                }
                break;
        }
    } while ($op > 0 && $op < 8);

}
main($colTeatros, $colFunciones, $objTeatro);
