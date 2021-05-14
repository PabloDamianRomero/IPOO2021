<?php
include 'Inmueble.php';
include 'Edificio.php';
include 'Persona.php';

$persona1 = new Persona("DNI", 27432561, "Carlos", "Martinez", 154321233);
$persona2 = new Persona("DNI", 12333456, "Pepe", "Suarez", 4456722);
$persona3 = new Persona("DNI", 12333422, "Pedro", "Suarez", 446678);
$persona4 = new Persona("DNI", 28765436, "Mariela", "Suarez", 25543562);

$inmueble1 = new Inmueble("I1", 1, "local comercial", 50000, $persona2);
$inmueble2 = new Inmueble("I2", 1, "local comercial", 50000, null);
$inmueble3 = new Inmueble("I3", 2, "departamento", 35000, $persona3);
$inmueble4 = new Inmueble("I4", 2, "departamento", 35000, null);
$inmueble5 = new Inmueble("I5", 2, "departamento", 35000, null);

$colInmuebles = array();
$colInmuebles[0] = $inmueble1;
$colInmuebles[1] = $inmueble2;
$colInmuebles[2] = $inmueble3;
$colInmuebles[3] = $inmueble4;
$colInmuebles[4] = $inmueble5;

$edificio = new Edificio("Juan B. Justo 3456", $persona1, $colInmuebles);



echo "\n---------Inciso n°4---------\n";
$resul1 = $edificio->darInmueblesDisponiblesParaAlquiler("local comercial", 4000);
print_r($resul1);

echo "\n---------Inciso n°5---------\n";
$exito = $edificio->registrarAlquilerInmueble($inmueble5, $persona4);
if($exito){
    echo "\n SE HA PODIDO REGISTRAR EL ALQUILER ";
}else{
    echo "\n NO SE HA PODIDO REGISTRAR EL ALQUILER ";
}

echo "\n---------Inciso n°6---------\n";
$exito = $edificio->registrarAlquilerInmueble($inmueble4, $persona4);
if($exito){
    echo "\n SE HA PODIDO REGISTRAR EL ALQUILER ";
}else{
    echo "\n NO SE HA PODIDO REGISTRAR EL ALQUILER ";
}

echo "\n---------Inciso n°7---------\n";
$costoTotal = $edificio->calculaCostoEdificio();
echo "\n COSTO TOTAL DEL EDIFICIO: ".$costoTotal;

echo "\n---------Inciso n°8---------\n";
echo $edificio;
