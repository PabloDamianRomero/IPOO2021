<?php
/**
 * PABLO DAMIAN ROMERO - FAI 1652
 *
 * Enlace gitHub: https://github.com/PabloDamianRomero/IPOO2021.git
 *
 * Nombre de la carpeta en el repositorio: Trabajo Entregable 02
 *
 *
 * Modificar la clase Teatro (Ejercicio 15 TP 1) para que ahora las funciones sean un objeto
 * que tenga las variables nombre, horario de inicio, duración de la obra y precio.
 * El teatro ahora, contiene una referencia a una colección de objetos de la clase  Funciones; las cuales pueden variar en cantidad y en horario.
 * Volver a implementar las operaciones que permiten modificar el nombre y el precio de una función.
 * Luego implementar la operación que carga las funciones de un teatro, solicitando por consola la información de las mismas.
 * También se debe verificar que el horario de las funciones, no se solapen para un mismo teatro.
 * */
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
    $contadorFuncion = 1; // valor para mostrar por pantalla el nro de teatro actual
    $anterior = -1; // valor inicial que refleja la hora de la última función agregada
    $i = 0; // valor inicial para la primer repetitiva while
    $seguir = true; // valor de corte de 1er repetitiva (según hora de úlitma función), por si quedan funciones para agregar al teatro

    while (($i < $cantFunciones) && $seguir) { // Repetitiva que permite el ingreso de funciones, hasta que lo permita el horario del teatro
        echo "\n Ingrese el nombre de la función " . $contadorFuncion . ": ";
        $nombreFuncion = trim(fgets(STDIN));
        do { // Repetitiva para pedir continuamente la hora, en caso de ser incorrecta (por función)
            echo "\n Ingrese la hora de inicio de la función " . $contadorFuncion . " (Recuerde que debe ser 1hr después de haber terminado la función anterior o a partir de cero si es la primera): ";
            $horaInicio = trim(fgets(STDIN));
            echo "\n Cuántas hs dura la función " . $contadorFuncion . "?: ";
            $duracionFuncion = trim(fgets(STDIN));
            $esHoraCorrecta = verificarHorarios($anterior, $horaInicio, $duracionFuncion); // verifica si la hora ingresada es valida (0 a 23hs) y no se pisa con anterior
            if (!$esHoraCorrecta) {
                echo "\n\n Deberá ingresar nuevamente los horarios. (El horario se vió pisado con el anterior o es incorrecto)\n";
            } else {
                $anterior = $horaInicio + $duracionFuncion;
                $seguir = verificarUltimaHora($anterior); // si quedan funciones por ingresar pero ya se completó el horario del teatro, se utiliza este atributo como condicion de corte
            }
        } while (!$esHoraCorrecta);
        echo "\n Ingrese el precio de la función " . $contadorFuncion . ": ";
        $precioFuncion = trim(fgets(STDIN));
        $objFuncion = new Funcion($nombreFuncion, $horaInicio, $duracionFuncion, $precioFuncion);
        $colFunciones[$i] = $objFuncion;
        $contadorFuncion++;
        $i++;
    }
    if (!$seguir) { // Si se quiere agregar otra función al teatro, habiendo llenado los horarios del día
        echo "\nLos horarios del teatro fueron todos ocupados. No se permiten nuevas funciones. ";
    }
    $objTeatro = new Teatro($nombreTeatro, $dirTeatro, $colFunciones);
    $cantidadTeatros = count($colTeatros); // Obtener última posición de $colTeatros
    $colTeatros[$cantidadTeatros] = $objTeatro; // Agregar nuevo objeto teatro a la colección
    return $colTeatros;
}

/**
 * Función que permite agregarle funciones a un teatro en particular (existente)
 */
function cargarFunciones($colTeatros, $cant, $nroTeatro)
{
    $auxFunciones = $colTeatros[$nroTeatro]->getFunciones(); // copia de la coleccion de funciones del teatro x
    $contadorFuncion = count($auxFunciones); // Valor de la última posición de la coleccion de funciones del teatro x
    $anterior = $auxFunciones[$contadorFuncion - 1]->getHoraInicio() + $auxFunciones[$contadorFuncion - 1]->getDuracion(); // Hora de la última función

    $seguir = verificarUltimaHora($anterior); // verifica si se pueden agregar más funciones

    if ($seguir) { // Verifica si la primera ejecución puede realizarse, en base al último horario de la función
        $valorDePosicionActual = $contadorFuncion + 1; // valor para mostrar por pantalla (nro de función actual)
        $i = 0;
        while (($i < $cant) && ($seguir)) { // Repetiva para almacenar nuevas funciones
            echo "\n Ingrese el nombre de la función " . $valorDePosicionActual . ": ";
            $nombreFuncion = trim(fgets(STDIN));
            do { // Repetitiva para pedir continuamente la hora, en caso de ser incorrecta (por función)
                echo "\n Ingrese la hora de inicio de la función " . $valorDePosicionActual . " (Recuerde que debe ser 1hr después de haber terminado la función anterior): ";
                $horaInicio = trim(fgets(STDIN));
                echo "\n Cuántas hs dura la función " . $valorDePosicionActual . "?: ";
                $duracionFuncion = trim(fgets(STDIN));

                $esHoraCorrecta = verificarHorarios($anterior, $horaInicio, $duracionFuncion); // verifica si la hora ingresada es valida (0 a 23hs)
                if (!$esHoraCorrecta) {
                    echo "\n\n Deberá ingresar nuevamente los horarios. (El horario se vió pisado con el anterior o es incorrecto)\n";
                } else {
                    $anterior = $horaInicio + $duracionFuncion;
                    $seguir = verificarUltimaHora($anterior); // si quedan funciones por ingresar pero ya se completó el horario, se utiliza este atributo como condicion de corte
                }
            } while (!$esHoraCorrecta);
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
 * y además no se pisa con el horario de la función anterior
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
 * si es posible agregar una nueva función al teatro
 */
function verificarUltimaHora($horaAnterior)
{
    $respuesta = true;
    if ($horaAnterior >= 22) { // OBS* = si la función anterior terminara a las 22, la proxima función comenzaría a las 23 con 0 de duración
        $respuesta = false;
    }
    return $respuesta;
}

/**
 * Función que verifica si la colección de teatros se encuentra vacia
 */
function esVacioTeatros($colTeatros)
{
    $respuesta = false;
    if ($colTeatros == null) {
        $respuesta = true;
    }
    return $respuesta;
}

/**
 * Buscar un teatro por el nombre en la coleccion de teatros, y si existe
 * devuelve su posición
 */
function buscarTeatro($nombreTeatro, $colTeatros)
{
    $encontrado = -1;
    $longitud = count($colTeatros);
    $j = 0;
    while (($j < $longitud) && ($encontrado == -1)) {
        if ($colTeatros[$j]->getNombreTeatro() == $nombreTeatro) {
            $encontrado = $j;
        } else {
            $j++;
        }
    }
    return $encontrado;
}

/**
 * Buscar una función por el nombre dentro de un objeto teatro, y si existe
 * devuelve su posición
 */
function buscarFuncionPorTeatro($nombreFuncion, $unObjTeatro)
{
    $encontrado = -1;
    $funcionesDelTeatro = $unObjTeatro->getFunciones();
    $longitudFunciones = count($funcionesDelTeatro);
    $j = 0;
    while (($j < $longitudFunciones) && ($encontrado == -1)) {
        if ($funcionesDelTeatro[$j]->getNombreFuncion() == $nombreFuncion) {
            $encontrado = $j;
        } else {
            $j++;
        }
    }
    return $encontrado;
}

/**
 * Función que devuelve los nombres de los teatros existentes en colección de teatros
 */
function mostrarTeatrosDisponiblesPorNombre($colTeatros)
{
    $cadena = "\nTeatros existentes:\n Nombres = ( ";
    $longitud = count($colTeatros);
    $i = 0;
    while ($i < $longitud) {
        $cadena .= $colTeatros[$i]->getNombreTeatro();
        if ($i + 1 != $longitud) {
            $cadena .= ", ";
        }
        $i++;
    }
    $cadena .= " )";
    return $cadena;
}

function mostrarFuncionesDeUnTeatro($unTeatro)
{
    $cadena = "\nFunciones existentes:\n Nombres = ( ";
    $funciones = $unTeatro->getFunciones();
    $longitud = count($funciones);
    $i = 0;
    while ($i < $longitud) {
        $cadena .= $funciones[$i]->getNombreFuncion();
        if ($i + 1 != $longitud) {
            $cadena .= " , ";
        }
        $i++;
    }
    $cadena .= " )";
    return $cadena;
}

/**
 * PROGRAMA PRINCIPAL
 */
function main($colTeatros, $colFunciones, $objTeatro)
{
    do {
        menu();
        $op = trim(fgets(STDIN));
        switch ($op) {

            case 1: // Agregar nuevo teatro.
                $colTeatros = cargarTeatro($colTeatros, $colFunciones, $objTeatro);
                break;

            case 2: // Agregar funciones a un teatro.
                if (!esVacioTeatros($colTeatros)) {
                    echo mostrarTeatrosDisponiblesPorNombre($colTeatros);
                    echo "\nIngrese el nombre del teatro al cual quiere añadirle funciones: ";
                    $nombreBusca = trim(fgets(STDIN));

                    $posicionDelTeatro = buscarTeatro($nombreBusca, $colTeatros);

                    if ($posicionDelTeatro != -1) {
                        echo "\n Ingrese cantidad de funciones nuevas para el teatro '" . $nombreBusca . "': ";
                        $cantFunciones = trim(fgets(STDIN));
                        $nuevasFunciones = cargarFunciones($colTeatros, $cantFunciones, $posicionDelTeatro);
                        $colTeatros[$posicionDelTeatro]->setFunciones($nuevasFunciones);
                    } else {
                        echo "\nNo existe teatro con ese nombre";
                    }
                } else {
                    echo "\n No existen teatros";
                }
                break;

            case 3: // Cambiarle el nombre a un teatro.
                if (!esVacioTeatros($colTeatros)) {
                    echo mostrarTeatrosDisponiblesPorNombre($colTeatros);
                    echo "\nIngrese el nombre del teatro al cual quiere cambiarle el nombre: ";
                    $nombreBusca = trim(fgets(STDIN));

                    $posicionDelTeatro = buscarTeatro($nombreBusca, $colTeatros);

                    if ($posicionDelTeatro != -1) {
                        echo "\nIngrese el nuevo nombre del teatro '" . $nombreBusca . "': ";
                        $nuevoNombre = trim(fgets(STDIN));
                        $colTeatros[$posicionDelTeatro]->cambiarNombreTeatro($nuevoNombre);
                    } else {
                        echo "\nNo existe teatro con ese nombre";
                    }

                } else {
                    echo "\n No existen teatros";
                }
                break;

            case 4: // Cambiarle la dirección a un teatro.
                if (!esVacioTeatros($colTeatros)) {
                    echo mostrarTeatrosDisponiblesPorNombre($colTeatros);
                    echo "\nIngrese el nombre del teatro al cual quiere cambiarle la dirección: ";
                    $nombreBusca = trim(fgets(STDIN));

                    $posicionDelTeatro = buscarTeatro($nombreBusca, $colTeatros);

                    if ($posicionDelTeatro != -1) {
                        echo "\nIngrese la nueva dirección del teatro '" . $nombreBusca . "': ";
                        $nuevaDir = trim(fgets(STDIN));
                        $colTeatros[$posicionDelTeatro]->cambiarDireccionTeatro($nuevaDir);
                    } else {
                        echo "\nNo existe teatro con ese nombre";
                    }
                } else {
                    echo "\n No existen teatros";
                }
                break;

            case 5: // Cambiar nombre de una función.
                if (!esVacioTeatros($colTeatros)) {
                    echo mostrarTeatrosDisponiblesPorNombre($colTeatros);

                    echo "\nIngrese el nombre del teatro: ";
                    $nombreBusca = trim(fgets(STDIN));

                    $posicionDelTeatro = buscarTeatro($nombreBusca, $colTeatros);
                    if ($posicionDelTeatro != -1) {
                        echo mostrarFuncionesDeUnTeatro($colTeatros[$posicionDelTeatro]);
                        echo "\n Ingrese el nombre de la función a la que desea cambiarle el mismo: ";
                        $funcionBusca = trim(fgets(STDIN));

                        $posicionDeLaFuncion = buscarFuncionPorTeatro($funcionBusca, $colTeatros[$posicionDelTeatro]);

                        if ($posicionDeLaFuncion != -1) {
                            echo "\nIngrese el nuevo nombre de la función '" . $funcionBusca . "': ";
                            $nuevoNombre = trim(fgets(STDIN));
                            $colTeatros[$posicionDelTeatro]->cambiarNombreFuncion($posicionDeLaFuncion, $nuevoNombre);
                        } else {
                            echo "\nNo existe funcion con ese nombre en el teatro '" . $nombreBusca . "'. ";
                        }

                    } else {
                        echo "\n El teatro '" . $nombreBusca . "' no existe. ";
                    }

                } else {
                    echo "\n No existen teatros";
                }
                break;

            case 6: // Cambiar precio de una función.
                if (!esVacioTeatros($colTeatros)) {
                    echo mostrarTeatrosDisponiblesPorNombre($colTeatros);

                    echo "\nIngrese el nombre del teatro: ";
                    $nombreBusca = trim(fgets(STDIN));

                    $posicionDelTeatro = buscarTeatro($nombreBusca, $colTeatros);
                    if ($posicionDelTeatro != -1) {
                        echo mostrarFuncionesDeUnTeatro($colTeatros[$posicionDelTeatro]);
                        echo "\n Ingrese el nombre de la función a la que desea cambiarle el precio: ";
                        $funcionBusca = trim(fgets(STDIN));

                        $posicionDeLaFuncion = buscarFuncionPorTeatro($funcionBusca, $colTeatros[$posicionDelTeatro]);

                        if ($posicionDeLaFuncion != -1) {
                            echo "\nIngrese el nuevo precio de la función '" . $funcionBusca . "': ";
                            $nuevoPrecio = trim(fgets(STDIN));
                            $colTeatros[$posicionDelTeatro]->cambiarPrecioFuncion($posicionDeLaFuncion, $nuevoPrecio);
                        } else {
                            echo "\nNo existe funcion con ese nombre en el teatro '" . $nombreBusca . "'. ";
                        }

                    } else {
                        echo "\n El teatro '" . $nombreBusca . "' no existe. ";
                    }

                } else {
                    echo "\n No existen teatros";
                }
                break;

            case 7: // Mostrar datos.
                if (!esVacioTeatros($colTeatros)) {
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
