<?php
# PABLO DAMIAN ROMERO - FAI 1652
include_once '../datos/BaseDatos.php';
include_once '../datos/Teatro.php';
include_once '../datos/Funcion.php';
include_once '../datos/Cine.php';
include_once '../datos/Musical.php';
include_once '../datos/ObraTeatral.php';
include_once '../transaccion/abmTeatro.php';
include_once '../transaccion/abmCine.php';
include_once '../transaccion/abmMusical.php';
include_once '../transaccion/abmObraTeatro.php';

$objTeatro = null;

/**
 *  Imprimir menú por consola
 */
function menu()
{
    echo "\n-------------------------------------------";
    echo "\n 1       - Crear teatro. ";
    echo "\n 2       - Cambiarle el nombre al teatro. ";
    echo "\n 3       - Cambiarle la dirección al teatro. ";
    echo "\n 4       - Eliminar teatro. ";
    echo "\n 5       - Agregar funcion al teatro. ";
    echo "\n 6       - Modificar datos de una función. ";
    echo "\n 7       - Eliminar función. ";
    echo "\n 8       - Dar costos según mes. ";
    echo "\n 9       - Mostrar datos de un teatro. ";
    echo "\n 10      - Mostrar datos de todos los teatros. ";
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
    $objTeatro = new Teatro();
    $objTeatro->cargar(0, $nombreTeatro, $dirTeatro, array());
    return $objTeatro;
}

/**
 *  OPCIÓN 2 DEL MENÚ
 */
function cargarFuncion($objTeatro)
{
    $datosFuncion = array();
    do {
        echo "\n Ingrese el número según el tipo de función (1 = CINE ; 2 = MUSICAL ; 3 = OBRA TEATRAL): ";
        $tipo = trim(fgets(STDIN));
        if (($tipo < 1) || ($tipo > 3)) {
            echo "\n Valor incorrecto. Ingrese nuevamente";
        }
    } while (($tipo < 1) || ($tipo > 3));

    echo "\n Ingrese la hora de inicio de la función: ";
    $hsInicio = trim(fgets(STDIN));
    echo "\n Ingrese la duración(hs) la función: ";
    $duracion = trim(fgets(STDIN));
    $funcionEsValida = $objTeatro->horarioSePisa($hsInicio);
    $perteneceUnDia = $objTeatro->correspondeAUnDia($hsInicio);
    if (($funcionEsValida == false) && ($perteneceUnDia)) { // Si no se pisa y está dentro del rango horario (0-23)
        echo "\n Ingrese el nombre de la función: ";
        $nombreFuncion = trim(fgets(STDIN));
        echo "\n Ingrese el precio de la función: ";
        $precioFuncion = trim(fgets(STDIN));
        do {
            echo "\n Ingrese el mes de la función: ";
            $mesFuncion = trim(fgets(STDIN));
            if (($mesFuncion < 1) || ($mesFuncion > 12)) {
                echo "\n El mes ingresado es incorrecto. Valores válidos = 1 a 12";
            }
        } while (($mesFuncion < 1) || ($mesFuncion > 12));

        $datosFuncion["id_funcion"] = null;
        $datosFuncion["nombreFuncion"] = $nombreFuncion;
        $datosFuncion["horaInicio"] = $hsInicio;
        $datosFuncion["duracion"] = $duracion;
        $datosFuncion["precioFuncion"] = $precioFuncion;
        $datosFuncion["mes"] = $mesFuncion;
        $datosFuncion["objTeatro"] = $objTeatro;

        switch ($tipo) {
            case 1:
                echo "\n Ingrese el género de la película: ";
                $genero = trim(fgets(STDIN));
                echo "\n Ingrese país de origen: ";
                $origen = trim(fgets(STDIN));

                $datosFuncion["genero"] = $genero;
                $datosFuncion["pais"] = $origen;
                $datosFuncion["abmCorrespondiente"] = $tipo;
                break;
            case 2:
                echo "\n Ingrese el director de musical: ";
                $director = trim(fgets(STDIN));
                echo "\n Ingrese la cantidad de personas en escena: ";
                $cantPersonas = trim(fgets(STDIN));

                $datosFuncion["director"] = $director;
                $datosFuncion["cantPersonasEscena"] = $cantPersonas;
                $datosFuncion["abmCorrespondiente"] = $tipo;
                break;
            case 3:
                echo "\n Ingrese el nombre del autor: ";
                $autor = trim(fgets(STDIN));

                $datosFuncion["autor"] = $autor;
                $datosFuncion["abmCorrespondiente"] = $tipo;
        }
    } else {
        echo "\n No se puede agregar esta función, los horarios se solapan o son incorrectos.";
        echo "\n Hora de la última función: " . $objTeatro->ultimaHora();
    }
    return $datosFuncion;
}

/**
 * Ejecución de opciones del menú (PROGRAMA PRINCIPAL)
 */
function main($objTeatro)
{
    do {
        menu();
        $op = trim(fgets(STDIN));
        switch ($op) {
            case 1: # Crear teatro
                $objTeatro = cargarTeatro($objTeatro);
                if ($objTeatro != null) {
                    $abmTeatro = new abmTeatro();
                    $mensaje = $abmTeatro->insertarTeatro($objTeatro);
                    echo $mensaje;
                } else {
                    echo "\nERROR. NO SE PUDO CREAR EL TEATRO";
                }
                break;

            case 2: # Cambiarle el nombre al teatro
                $abmTeatro = new abmTeatro();
                echo "\nIngrese id del teatro: ";
                $idBusca = trim(fgets(STDIN));
                $objTeatroBuscado = $abmTeatro->seleccionTeatro($idBusca);
                if ($objTeatroBuscado != null) {
                    echo "\n--Teatro encontrado-- (" . $objTeatroBuscado->getNombreTeatro() . ")";
                    echo "\nIngrese el nuevo nombre del teatro: ";
                    $nuevoNombre = trim(fgets(STDIN));
                    $mensaje = $abmTeatro->modificarNombreTeatro($objTeatroBuscado, $nuevoNombre);
                    echo $mensaje;
                } else {
                    echo "\nError. Teatro no encontrado. ";
                }
                break;

            case 3: # Cambiarle la dirección al teatro
                $abmTeatro = new abmTeatro();
                echo "\nIngrese id del teatro: ";
                $idBusca = trim(fgets(STDIN));
                $objTeatroBuscado = $abmTeatro->seleccionTeatro($idBusca);
                if ($objTeatroBuscado != null) {
                    echo "\n--Teatro encontrado-- (" . $objTeatroBuscado->getNombreTeatro() . ")";
                    echo "\nIngrese la nueva dirección del teatro: ";
                    $nuevaDir = trim(fgets(STDIN));
                    $mensaje = $abmTeatro->modificarDireccionTeatro($objTeatroBuscado, $nuevaDir);
                    echo $mensaje;
                } else {
                    echo "\nError. Teatro no encontrado. ";
                }
                break;

            case 4: # Eliminar teatro
                $abmTeatro = new abmTeatro();
                echo "\nIngrese id del teatro: ";
                $idBusca = trim(fgets(STDIN));
                $objTeatroBuscado = $abmTeatro->seleccionTeatro($idBusca);
                if ($objTeatroBuscado != null) {
                    echo "\n--Teatro encontrado-- (" . $objTeatroBuscado->getNombreTeatro() . ")";
                    $respuesta = $abmTeatro->eliminarTeatro($objTeatroBuscado);
                    if ($respuesta) {
                        echo " \n Teatro eliminado correctamente junto con sus funciones.";
                    } else {
                        echo " \n No se ha podido eliminar el teatro";
                    }
                } else {
                    echo "\nError. Teatro no encontrado. ";
                }
                break;

            case 5: # Agregar funcion al teatro
                echo "\nIngrese id del teatro: ";
                $idTeatro = trim(fgets(STDIN));
                $abm = new abmTeatro();
                $objTeatro = $abm->seleccionTeatro($idTeatro);
                if ($objTeatro != null) {
                    // echo "\n TEATRO SIN COLECCION\n";
                    // print_r($objTeatro);
                    $objTeatro->setColObjFunciones($objTeatro->getColObjFunciones());
                    // echo "\n TEATRO LUEGO DE TRAER COLECCION\n";
                    // print_r($objTeatro);
                    echo "\n--Teatro encontrado-- (" . $objTeatro->getNombreTeatro() . ")";
                    $ultimaHora = $objTeatro->ultimaHora();
                    if (($objTeatro->correspondeAUnDia($ultimaHora)) || ($ultimaHora == -1)) {
                        $datosFuncion = cargarFuncion($objTeatro); // Genera una colección con los datos de una función localmente
                        if (count($datosFuncion) != 0) { // Si se pudo generar la coleccion de manera correcta, inserto en bd
                            $tipoFuncion = $datosFuncion["abmCorrespondiente"];
                            switch ($tipoFuncion) {
                                case 1:
                                    $abm = new abmCine();
                                    $respuesta = $abm->insertarFuncion($datosFuncion);
                                    break;
                                case 2:
                                    $abm = new abmMusical();
                                    $respuesta = $abm->insertarFuncion($datosFuncion);
                                    break;
                                case 3:
                                    $abm = new abmObraTeatro();
                                    $respuesta = $abm->insertarFuncion($datosFuncion);
                                    break;
                            }
                            if ($respuesta) {
                                echo "La funcion ha sido cargada a la base de datos de forma correcta\n";
                            } else {
                                echo "No se pudo cargar la funcion en la base\n";
                            }
                        }
                    } else {
                        echo "\n Capacidad horaria completada. Ya no se pueden agregar más funciones al teatro";
                        echo "\n Hora en que terminó la última función: " . $objTeatro->ultimaHora();
                    }

                } else {
                    echo "\n Teatro no encontrado";
                }
                break;

            case 6: # Modificar datos de una función
                echo "\nIngrese id de la funcion: ";
                $idFuncion = trim(fgets(STDIN));
                do {
                    echo "\n De qué tipo es la función (1 = CINE ; 2 = MUSICAL ; 3 = OBRA TEATRAL): ";
                    $tipo = trim(fgets(STDIN));
                    if (($tipo < 1) || ($tipo > 3)) {
                        echo "\n Valor incorrecto. Ingrese nuevamente";
                    }
                } while (($tipo < 1) || ($tipo > 3));

                $opcionesEnComun = "\n1 = Nombre\n2 = Hora de Inicio\n3 = Duración\n4 = Precio\n5 = Mes";
                switch ($tipo) {
                    case 1:
                        $opciones = $opcionesEnComun . "\n6 = Género\n7 = Origen";
                        $abmFuncion = new abmCine();
                        break;
                    case 2:
                        $opciones = $opcionesEnComun . "\n6 = Director\n7 = Cantidad personas";
                        $abmFuncion = new abmMusical();
                        break;
                    case 3:
                        $opciones = $opcionesEnComun . "\n6 = Autor";
                        $abmFuncion = new abmObraTeatro();
                        break;
                }
                $objFuncion = $abmFuncion->seleccionFuncion($idFuncion);
                if ($objFuncion != null) {
                    echo "\n--Función encontrada-- (" . $objFuncion->getNombreFuncion() . ")";
                    echo "\nQué atributo desea modificar?";
                    echo $opciones;
                    echo "\n(Ingrese número)";
                    $opcionElegida = trim(fgets(STDIN));
                    $valor = "";
                    switch ($opcionElegida) {
                        case 1:
                            echo "\n Ingrese nuevo nombre: ";
                            $valor = trim(fgets(STDIN));
                            break;
                        case 2:
                            echo "\n Ingrese nueva hora de inicio: ";
                            $valor = trim(fgets(STDIN));
                            break;
                        case 3:
                            echo "\n Ingrese nueva duración: ";
                            $valor = trim(fgets(STDIN));
                            break;
                        case 4:
                            echo "\n Ingrese nuevo precio: ";
                            $valor = trim(fgets(STDIN));
                            break;
                        case 5:
                            do {
                                echo "\n Ingrese nuevo mes: ";
                                $valor = trim(fgets(STDIN));
                                if (($valor < 1) || ($valor > 12)) {
                                    echo "\n El mes ingresado es incorrecto. Valores válidos = 1 a 12";
                                }
                            } while (($valor < 1) || ($valor > 12));
                            break;
                        case 6:
                            if ($tipo == 1) {
                                echo "\n Ingrese nuevo género: ";
                                $valor = trim(fgets(STDIN));
                            } elseif ($tipo == 2) {
                                echo "\n Ingrese nuevo director: ";
                                $valor = trim(fgets(STDIN));
                            } elseif ($tipo == 3) {
                                echo "\n Ingrese nuevo autor: ";
                                $valor = trim(fgets(STDIN));
                            }
                            break;
                        case 7:
                            if ($tipo == 1) {
                                echo "\n Ingrese nuevo origen: ";
                                $valor = trim(fgets(STDIN));
                            } elseif ($tipo == 2) {
                                echo "\n Ingrese nueva cantidad de personas: ";
                                $valor = trim(fgets(STDIN));
                            }
                            break;
                    }

                    if ($valor != "") {
                        $respuesta = $abmFuncion->modificarFuncion($objFuncion, $opcionElegida, $valor);
                        if ($respuesta) {
                            echo "\n Se ha modificado el valor de la función correctamente";
                        } else {
                            echo "\n No se pudo modificar el valor de la función";
                        }
                    } else {
                        echo "\n No se eligió nada para modificar.";
                    }
                } else {
                    echo "\n Función no encontrada.";
                }

                break;

            case 7: # Eliminar funcion
                echo "\nIngrese id de la funcion a eliminar: ";
                $idFuncion = trim(fgets(STDIN));
                do {
                    echo "\n De qué tipo es la función (1 = CINE ; 2 = MUSICAL ; 3 = OBRA TEATRAL): ";
                    $tipo = trim(fgets(STDIN));
                    if (($tipo < 1) || ($tipo > 3)) {
                        echo "\n Valor incorrecto. Ingrese nuevamente";
                    }
                } while (($tipo < 1) || ($tipo > 3));
                switch ($tipo) {
                    case 1:
                        $abmFuncion = new abmCine();
                        break;
                    case 2:
                        $abmFuncion = new abmMusical();
                        break;
                    case 3:
                        $abmFuncion = new abmObraTeatro();
                        break;
                }
                $objFuncion = $abmFuncion->seleccionFuncion($idFuncion);
                if ($objFuncion != null) {
                    echo "\n--Función encontrada-- (" . $objFuncion->getNombreFuncion() . ")";
                    $respuesta = $abmFuncion->eliminarFuncion($idFuncion);
                    if ($respuesta) {
                        echo "\n La función se ha eliminado de la base de datos con exito";
                    } else {
                        echo "\n La función no se pudo eliminar de la base de datos";
                    }
                } else {
                    echo "\n Función no encontrada.";
                }
                break;

            case 8: # Dar costos según mes
                $abmTeatro = new abmTeatro();
                echo "\nIngrese id del teatro: ";
                $idBusca = trim(fgets(STDIN));
                $objTeatroBuscado = $abmTeatro->seleccionTeatro($idBusca);
                if ($objTeatroBuscado != null) {
                    echo "\n--Teatro encontrado-- (" . $objTeatroBuscado->getNombreTeatro() . ")";
                    do {
                        echo "\n Ingrese el mes para filtrar costos: ";
                        $mesFiltro = trim(fgets(STDIN));
                        if (($mesFiltro < 1) || ($mesFiltro > 12)) {
                            echo "\n El mes ingresado es incorrecto. Valores válidos = 1 a 12";
                        }
                    } while (($mesFiltro < 1) || ($mesFiltro > 12));
                    $costo = $objTeatroBuscado->darCostos($mesFiltro);
                    echo "\nCOSTOS (Mes " . $mesFiltro . "): $" . $costo;
                } else {
                    echo "\nError. Teatro no encontrado. ";
                }
                break;

            case 9: # Mostrar datos de un teatro por id
                $abmTeatro = new abmTeatro();
                echo "\nIngrese id del teatro: ";
                $idBusca = trim(fgets(STDIN));
                $objTeatroBuscado = $abmTeatro->seleccionTeatro($idBusca);
                if ($objTeatroBuscado != null) {
                    echo $objTeatroBuscado;
                } else {
                    echo "\nError. Teatro no encontrado. ";
                }
                break;
            case 10: # Mostrar datos de todos los teatros de la bd
                $objTeatro = new Teatro();
                $colTeatros = $objTeatro->listar();
                foreach ($colTeatros as $uno){
                    echo $uno;
                }
                break;
        }
    } while ($op > 0 && $op < 11);
}

main($objTeatro);
