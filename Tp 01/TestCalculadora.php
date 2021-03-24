<?php

include 'Calculadora.php';

$c = new Calculadora(); // se crea un objeto calculadora
echo $c->__toString();

echo "\nIngrese primer número: ";
$n1 = trim(fgets(STDIN));
echo "\nIngrese segundo número: ";
$n2 = trim(fgets(STDIN));

$c->setNumeroUno($n1);
$c->setNumeroDos($n2);

echo "\n" . $c->__toString();
echo "\nSuma (" . $n1 . "+" . $n2 . ") = " . $c->suma();
echo "\nResta (" . $n1 . "-" . $n2 . ") = " . $c->resta();
echo "\nMultiplicación (" . $n1 . "*" . $n2 . ") = " . $c->multiplicacion();
echo "\nDivisión (" . $n1 . "/" . $n2 . ") = " . $c->division();
