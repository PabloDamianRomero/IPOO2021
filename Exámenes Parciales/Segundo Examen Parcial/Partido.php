<?php
class Partido{
    private $idPartido;
    private $fecha;
    private $cantGolesE1;
    private $cantGolesE2;
    private $objEquipo1;
    private $objEquipo2;

    public function __construct($pObjE1, $pObjE2, $pCantGolesE1, $pCantGolesE2){
        $this->idPartido = 0;
        $this->fecha = date("d")."/".date("m")."/".date("y");
        $this->cantGolesE1 = $pCantGolesE1;
        $this->cantGolesE2 = $pCantGolesE2;
        $this->objEquipo1 = $pObjE1;
        $this->objEquipo2 = $pObjE2;
    }


    public function setIdPartido($idPartido)
    {
        $this->idPartido = $idPartido;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function setCantGolesE1($pCantGolesE1)
    {
        $this->cantGolesE1 = $pCantGolesE1;
    }

    public function setCantGolesE2($pCantGolesE2)
    {
        $this->cantGolesE2 = $pCantGolesE2;
    }

    public function setObjEquipo1($pObjE1)
    {
        $this->objEquipo1 = $pObjE1;
    }


    public function setObjEquipo2($pObjE2)
    {
        $this->objEquipo2 = $pObjE2;
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
        $cadena .= "\nId Partido: ".$this->getIdPartido();
        $cadena .= "\nFecha: ".$this->getFecha();
        $cadena .= "\nGoles Equipo 1: ".$this->getCantGolesE1();
        $cadena .= "\nGoles Equipo 2: ".$this->getCantGolesE2();
        $cadena .= "\n*Equipo 1: ".$this->getObjEquipo1();
        $cadena .= "\n*Equipo 2: ".$this->getObjEquipo2();
        return $cadena;
    }
}