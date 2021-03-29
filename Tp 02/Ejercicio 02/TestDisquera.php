<?php
include 'Disquera.php';
include 'Persona.php';

$persona1 = new Persona("Pablo", "Romero", "DNI", 40068425);

$tiempoInicio = array();
$tiempoInicio[0] = array("H" => 9, "M" => 00);

$tiempoCierre = array();
$tiempoCierre[0] = array("H" => 18, "M" => 30);

$disquera1 = new Disquera($tiempoInicio, $tiempoCierre, "cerrada", "Londres 123", $persona1);

echo $disquera1->__toString();

$horario = $disquera1->dentroHorarioAtencion(17,59);
if($horario){
    echo "\nTienda abierta a esa hora.";
}else{
    echo "\nTienda cerrada a esa hora.";
}
