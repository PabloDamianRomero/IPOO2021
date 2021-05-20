<?php
class Partido{
    private $idPartido;
    private $fecha;
    private $cantGolesE1;
    private $cantGolesE2;
    private $objEquipo1;
    private $objEquipo2;

    public function __construct($pObjEquipo1, $pObjEquipo2, $pFecha, $pCantGolesE1, $pCantGolesE2){
        $this->objEquipo1 = $pObjEquipo1;
        $this->objEquipo2 = $pObjEquipo2;
        $this->fecha = $pFecha;
        $this->cantGolesE1 = $pCantGolesE1;
        $this->cantGolesE2 = $pCantGolesE2;
        $this->idPartido = 0;
    }

    public function setIdPartido($pIdPartido)
    {
        $this->idPartido = $pIdPartido;
    }

    public function setFecha($pFecha)
    {
        $this->fecha = $pFecha;
    }

    public function setCantGolesE1($pCantGolesE1)
    {
        $this->cantGolesE1 = $pCantGolesE1;
    }

    public function setCantGolesE2($pCantGolesE2)
    {
        $this->cantGolesE2 = $pCantGolesE2;
    }

    public function setObjEquipo1($pObjEquipo1)
    {
        $this->objEquipo1 = $pObjEquipo1;
    }

    public function setObjEquipo2($pObjEquipo2)
    {
        $this->objEquipo2 = $pObjEquipo2;
    }

    public function getIdPartido()
    {
        return $this->idPartido;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getCantGolesE1()
    {
        return $this->cantGolesE1;
    }

    public function getCantGolesE2()
    {
        return $this->cantGolesE2;
    }

    public function getObjEquipo1()
    {
        return $this->objEquipo1;
    }

    public function getObjEquipo2()
    {
        return $this->objEquipo2;
    }

    public function __toString(){
        $cadena = "";
        $cadena .= "\n----------------------------------------";
        $cadena .= "\nID Partido: ".$this->getIdPartido();
        $cadena .= "\nFecha: ".$this->getFecha();
        $cadena .= "\nCant goles E1: ".$this->getCantGolesE1();
        $cadena .= "\nCant goles E2: ".$this->getCantGolesE2();
        $cadena .= "\nEQUIPO 1: ".$this->getObjEquipo1();
        $cadena .= "\nEQUIPO 2: ".$this->getObjEquipo2();
        $cadena .= "\n----------------------------------------";
        return $cadena;
    }

    public function coeficientePartido(){
        $cantGolesTotal = $this->getCantGolesE1() + $this->getCantGolesE2();
        $cantJugadoresTotal = $this->getObjEquipo1()->getCantJugadores(); // Si existe el partido, ambos equipos tienen la misma cantidad de jugadores
        $coef = (0.5) * $cantGolesTotal * $cantJugadoresTotal;
        return $coef;
    }


}