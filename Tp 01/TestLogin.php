<?php

include_once 'Login.php';

$contrasenias = array();
for ($i = 0; $i < 4; $i++) {
    echo "\nIngrese contraseña " . $i . ": ";
    $contrasenias[$i] = trim(fgets(STDIN));
}

$nombre = "Pablo";

$frase = "Día, mes y año de tu cumpleaños";

$l = new Login($nombre, $contrasenias, 0, $frase);

do {
    echo "\n" . $l->recordar($nombre);
    echo "\nIngrese contraseña:";
    $contrasenia = trim(fgets(STDIN));
} while (!($l->comprobarPassword($contrasenia)));

echo "\nCAMBIAR CONTRASEÑA? (s/n):";
$seguir = trim(fgets(STDIN));
while ($seguir == "s") {
// cambiar
    echo "\nIngrese nueva contraseña: ";
    $nuevaContrasenia = trim(fgets(STDIN));
    if ($l->comprobarPassword($nuevaContrasenia)) {
        echo "\nEXISTE\n";
    } else {
        //echo "\nNO EXISTE";
        $r = $l->cambiarPassword($nuevaContrasenia);
        echo "\nContraseña cambiada exitosamente!\n";
        print_r($l->getPasswordAnterior());
    }
    echo "\nCAMBIAR CONTRASEÑA? (s/n):";
    $seguir = trim(fgets(STDIN));
}

echo $l->__toString();
