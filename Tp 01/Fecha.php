<?php
class Fecha
{
    private $dia;
    private $mes;
    private $anio;

    public function __construct($pDia, $pMes, $pAnio)
    {
        $this->dia = $pDia;
        $this->mes = $pMes;
        $this->anio = $pAnio;
    }

    public function getDia()
    {
        return $this->dia;
    }

    public function getMes()
    {
        return $this->mes;
    }

    public function getAnio()
    {
        return $this->anio;
    }

    public function setDia($pDia)
    {
        $this->dia = $pDia;
    }

    public function setMes($pMes)
    {
        $this->mes = $pMes;
    }

    public function setAnio($pAnio)
    {
        $this->anio = $pAnio;
    }

    public function __toString()
    {
        return "\nDía: " . $this->getDia() . "\tMes: " . $this->getMes() . "\tAño: " . $this->getAnio() . "\n";
    }

    public function incremento($entero, $fecha)
    {
        $bisiesto = $this->esBisiesto();
        $mesAux = $this->getMes();
        $diasAux = $this->getDia();
        if ($bisiesto) {
            // Completar
        }

    }

    public function incrementaUnDia()
    {
        $this->setDia($this->getDia() + 1);
    }

    public function esBisiesto()
    {
        $respuesta = false;
        $anioAux = $this->getAnio();
        if (($anioAux % 400 == 0 || $anioAux % 4 == 0) && (!($anioAux % 100 == 0))) {
            $respuesta = true;
        }
        return $respuesta;
    }

}
