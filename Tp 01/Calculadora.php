<?php
class Calculadora
{
    private $numeroUno;
    private $numeroDos;

    public function __construct()
    {
        $this->numeroUno = 0;
        $this->numeroDos = 0;
    }

    public function getNumeroUno()
    {
        return $this->numeroUno;
    }

    public function getNumeroDos()
    {
        return $this->numeroDos;
    }

    public function setNumeroUno($num1)
    {
        $this->numeroUno = $num1;
    }

    public function setNumeroDos($num2)
    {
        $this->numeroDos = $num2;
    }

    public function __toString(){
        return "Número 1: ".$this->getNumeroUno()."\n"."Número 2: ".$this->getNumeroDos()."\n";
    }

    public function suma()
    {
        $suma = $this->getNumeroUno() + $this->getNumeroDos();
        return $suma;
    }

    public function resta(){
        $resta = $this->getNumeroUno() - $this->getNumeroDos();
        return $resta;
    }

    public function multiplicacion(){
        $multiplicacion = $this->getNumeroUno() * $this->getNumeroDos();
        return $multiplicacion;
    }

    public function division(){
        $division = $this->getNumeroUno() / $this->getNumeroDos();
        return $division;
    }
}
