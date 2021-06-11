<?php
include_once '../datos/BaseDatos.php';
include_once '../datos/Teatro.php';
include_once '../datos/Funcion.php';
include_once '../datos/Cine.php';
include_once '../datos/Musical.php';
include_once '../datos/ObraTeatral.php';

/* >>> CREAR TEATRO <<< */
$obj_Teatro = new Teatro();
$obj_Teatro->cargar(0, 'El Arrimadero', 'Misiones 264', array());
$respuesta = $obj_Teatro->insertar();

if ($respuesta == true) {
    echo "\nOP INSERCION: El teatro fue ingresado correctamente a la BD";
} else {
    echo $obj_Teatro->getMensaje_operacion();
}
echo "\n";

mostrarTeatrosBD($obj_Teatro);

$id_teatro = $obj_Teatro->getId();
// $pId, $pNombre, $pInicio, $pDuracion, $pPrecio, $pMes, $pTipo, $pIdTeatro
/* >>> CREAR FUNCIONES <<< */

$datoFuncionCine1 = array();
$datoFuncionCine1["id"] = 0;
$datoFuncionCine1["nombre"] = "Funcion_001";
$datoFuncionCine1["horaInicio"] = 9;
$datoFuncionCine1["duracion"] = 2;
$datoFuncionCine1["precio"] = 100;
$datoFuncionCine1["mes"] = 5;
$datoFuncionCine1["tipo"] = "cine";
$datoFuncionCine1["id_teatro"] = $id_teatro;
$datoFuncionCine1["genero"] = "accion";
$datoFuncionCine1["pais"] = "Argentina";

$funcion1 = new Cine();
$funcion1->cargar($datoFuncionCine1);

$datoFuncionMusical1 = array();
$datoFuncionMusical1["id"] = 0;
$datoFuncionMusical1["nombre"] = "Funcion_002";
$datoFuncionMusical1["horaInicio"] = 14;
$datoFuncionMusical1["duracion"] = 3;
$datoFuncionMusical1["precio"] = 200;
$datoFuncionMusical1["mes"] = 6;
$datoFuncionMusical1["tipo"] = "musical";
$datoFuncionMusical1["id_teatro"] = $id_teatro;
$datoFuncionMusical1["director"] = "Pepe";
$datoFuncionMusical1["personas"] = 15;
$funcion2 = new Musical();
$funcion2->cargar($datoFuncionMusical1);

$datoFuncionObra1 = array();
$datoFuncionObra1["id"] = 0;
$datoFuncionObra1["nombre"] = "Funcion_003";
$datoFuncionObra1["horaInicio"] = 16;
$datoFuncionObra1["duracion"] = 4;
$datoFuncionObra1["precio"] = 300;
$datoFuncionObra1["mes"] = 7;
$datoFuncionObra1["tipo"] = "obra";
$datoFuncionObra1["id_teatro"] = $id_teatro;
$datoFuncionObra1["autor"] = "Lele";
$funcion3 = new ObraTeatral();
$funcion3->cargar($datoFuncionObra1);

$funciones1 = array(
    $funcion1,
    $funcion2,
    $funcion3,
);

$longi = count($funciones1);
/* >>> INSERTO FUNCIONES <<< */
for ($i = 0; $i < $longi; $i++) {
    $respuesta = $funciones1[$i]->insertar($id_teatro);
    if ($respuesta == true) {
        echo "\nOP INSERCION: La funcion fue ingresada correctamente a la BD";
    } else {
        echo $funciones1[$i]->getMensaje_operacion();
    }
}
echo "\n";

// $cond = "teatro.id = 1";
// mostrarTeatroCondicion($cond);

/* >>> MOSTRAR TEATROS <<< */
/**
 * Muestro por pantalla todos los teatros de la BD.
 */
function mostrarTeatrosBD($objTeatro)
{
    $colTeatro = $objTeatro->listar();
    foreach ($colTeatro as $unTeatro) {
        echo $unTeatro;
        echo "\n-------------------------------------------------------";
    }
    echo "\n";
}


/* >>> MODIFICO UNA FUNCION (Primera ie, pos = [0]) <<< */
$fun = new Funcion();
$cond = "funcion.id_teatro = ".$id_teatro;
$colFun = $fun->listar($cond);
$colFun[0]->setNombreFuncion("unNombre");
$respuesta = $colFun[0]->modificar();
if ($respuesta == true) {
    echo " \nOP MODIFICACION: Los datos fueron actualizados correctamente";
} else {
    echo $colFun[0]->getmensajeoperacion();
}
echo "\n";

echo "\nid teatro: ".$id_teatro;