<?php
include 'Reloj.php';

$reloj1 = new Reloj();

echo "****************".$reloj1->__toString()."****************";
//echo $reloj1->__toString()."/-/-/-/-/-/-/-/-";

$seguir = true;
while ($seguir) {
    echo "\nIngrese cantidad de segundos a incrementar: ";
    $cantSeg = trim(fgets(STDIN));
    $reloj1->incremento($cantSeg);
    echo "----------------".$reloj1->__toString()."----------------";
    echo "\nSeguir? (s/n): ";
    $resp = trim(fgets(STDIN));
    if ($resp != "s") {
        $seguir = false;
    }
}
