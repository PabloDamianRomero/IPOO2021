<?php
include_once 'MinisterioDeporte.php';
include_once 'Partido.php';
include_once 'Equipo.php';
include_once 'Categoria.php';
include_once 'Torneo.php';
include_once 'TorneoNacional.php';
include_once 'TorneoProvincial.php';

# new Categoria = ($pId, $pDesc)
$objCat1 = new Categoria("Cat_001", "Menores");
$objCat2 = new Categoria("Cat_002", "Juveniles");
$objCat3 = new Categoria("Cat_003", "Mayores");

#new Equipo($pNombre, $pNombreCap, $pCantJugadores, $pObjCat);
$objE1 = new Equipo("Motanas", "Garcian S", 11, $objCat1);
$objE2 = new Equipo("Lake", "Paul R", 11, $objCat1);
$objE3 = new Equipo("Cuarteto de 4", "Nos R", 11, $objCat2);
$objE4 = new Equipo("Nqn Star", "Leon P", 11, $objCat2);
$objE5 = new Equipo("Catamarca", "Roldan B", 11, $objCat1);
$objE6 = new Equipo("Santa Destroy", "Travis T", 11, $objCat1);
$objE7 = new Equipo("Bars", "Harman S", 11, $objCat1);
$objE8 = new Equipo("Yakumo", "Kaede S", 11, $objCat1);
$objE9 = new Equipo("Langostas", "Goichi S", 11, $objCat2);
$objE10 = new Equipo("Noir", "Robert O", 11, $objCat2);
$objE11 = new Equipo("Beast", "Sumio M", 11, $objCat3);
$objE12 = new Equipo("FSR", "Zappa M", 11, $objCat3);

$arrayAsociativo = array();
$arrayAsociativo["nacional"] = [
    $nac[0] = array("id" => "torneo_01", "monto" => 300),
];

$arrayAsociativo["provincial"] = [
    $prov[0] = array("id" => "torneo_02", "monto" => 500, "nombreProvincia"=>"Neuquén"),
];

// EJERCICIO 1
$objPart1 = new Partido($objE7, $objE8, 80, 120);
$objPart2 = new Partido($objE9, $objE10, 81, 110);
$objPart3 = new Partido($objE11, $objE12, 115, 85);
$objPart4 = new Partido($objE1, $objE2, 3, 2);
$objPart5 = new Partido($objE3, $objE4, 0, 1);
$objPart6 = new Partido($objE5, $objE6, 2, 3);

$objPart1->setIdPartido("Partido_001");
$objPart2->setIdPartido("Partido_002");
$objPart3->setIdPartido("Partido_003");
$objPart4->setIdPartido("Partido_004");
$objPart5->setIdPartido("Partido_005");
$objPart6->setIdPartido("Partido_006");

// EJERCICIO 2
$colPartidosProvinciales = array();
$colPartidosProvinciales[0] = $objPart1;
$colPartidosProvinciales[1] = $objPart1;
$colPartidosProvinciales[2] = $objPart1;

// EJERCICIO 3
$colPartidosNacionales = array();
$colPartidosNacionales[0] = $objPart4;
$colPartidosNacionales[1] = $objPart5;
$colPartidosNacionales[2] = $objPart6;

// EJERCICIO 4
$ministerio = new MinisterioDeporte(2021, array());

// EJERCICIO 5
$objTorneo1 = $ministerio->registrarTorneo($colPartidosProvinciales, "provinciales", $arrayAsociativo);
echo $objTorneo1;

// EJERCICIO 6
$objTorneo2 = $ministerio->registrarTorneo($colPartidosNacionales, "nacionales", $arrayAsociativo);
echo $objTorneo2;

// EJERCICIO 7
$colPremioEquipo = $ministerio->otorgarPremioTorneo($objTorneo1->getIdTorneo());
print_r($colPremioEquipo);

// EJERCICIO 8
$colPremioEquipo = $ministerio->otorgarPremioTorneo($objTorneo2->getIdTorneo());
print_r($colPremioEquipo);

// EJERCICIO 9
echo $ministerio;





