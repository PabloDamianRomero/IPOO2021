<?php
include_once 'Torneo.php';
include_once 'Partido.php';
include_once 'Futbol.php';
include_once 'Basket.php';
include_once 'Equipo.php';
include_once 'Categoria.php';

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

#new Partido = $pObjEquipo1, $pObjEquipo2, $pFecha, $pCantGolesE1, $pCantGolesE2
$objPart1 = new Basket($objE7, $objE8, "2020-10-10", 80, 120, 75);
$objPart2 = new Basket($objE9, $objE10, "2020-10-25", 81, 110, 70);
$objPart3 = new Basket($objE11, $objE12, "2020-11-25", 115, 85, 110);
$objPart4 = new Futbol($objE1, $objE2, "2020-10-25", 3, 2);
$objPart5 = new Futbol($objE3, $objE4, "2020-11-13", 0, 1);
$objPart6 = new Futbol($objE5, $objE6, "2020-11-30", 2, 3);

$colPartidos = [$objPart1, $objPart2, $objPart3, $objPart4, $objPart5, $objPart6];

#new Torneo = ($pColObjPartidos, $pImporte)
$torneo = new Torneo($colPartidos, 100000);
echo $torneo;

$nuevoPartido = $torneo->ingresarPartido($objE7, $objE11, "10-11-20", "basquetbol");
if($nuevoPartido != null){
    echo "\n----------------------------EXITO-------------------------------------";
}else{
    echo "\n----------------------------ERROR-------------------------------------";
}

#echo $torneo;
/*
$colGanadores = $torneo->darGanadores("basket");
print_r($colGanadores);
*/

$colPremio = $torneo->calcularPremioPartido($objPart1);
print_r($colPremio);