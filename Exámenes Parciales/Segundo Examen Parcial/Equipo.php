<?php
class Equipo{
    private $nombre;
    private $nombreCapitan;
    private $cantJugadores;
    private $objCategoria;

    public function __construct($pNombre, $pNomCap, $pCantJug, $pObjCat){
        $this->nombre = $pNombre;
        $this->nombreCapitan = $pNomCap;
        $this->cantJugadores = $pCantJug;
        $this->objCategoria = $pObjCat;
    }
    

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setNombreCapitan($nombreCapitan)
    {
        $this->nombreCapitan = $nombreCapitan;
    }

    public function setCantJugadores($cantJugadores)
    {
        $this->cantJugadores = $cantJugadores;

    }


    public function setObjCategoria($objCategoria)
    {
        $this->objCategoria = $objCategoria;
    }


    public function getNombre()
    {
        return $this->nombre;
    }


    public function getNombreCapitan()
    {
        return $this->nombreCapitan;
    }


    public function getCantJugadores()
    {
        return $this->cantJugadores;
    }


    public function getObjCategoria()
    {
        return $this->objCategoria;
    }

    public function __toString(){
        $cadena = "";
        $cadena .= "\nNombre Equipo: ".$this->getNombre();
        $cadena .= "\nNombre capitan: ".$this->getNombreCapitan();
        $cadena .= "\nCantidad Jugadores: ".$this->getCantJugadores();
        $cadena .= "\n*Categoria: ".$this->getObjCategoria();
        return $cadena;
    }
}