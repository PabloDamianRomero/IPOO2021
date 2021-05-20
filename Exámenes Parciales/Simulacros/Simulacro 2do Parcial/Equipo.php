<?php
class Equipo{
    private $nombre;
    private $nombreCapitan;
    private $cantJugadores;
    private $objCategoria;

    public function __construct($pNombre, $pNombreCap, $pCantJugadores, $pObjCat){
        $this->nombre = $pNombre;
        $this->nombreCapitan = $pNombreCap;
        $this->cantJugadores = $pCantJugadores;
        $this->objCategoria = $pObjCat;
    }

    public function setNombre($pNombre)
    {
        $this->nombre = $pNombre;
    }

    public function setNombreCapitan($pNombreCap)
    {
        $this->nombreCapitan = $pNombreCap;
    }

    public function setCantJugadores($pCantJugadores)
    {
        $this->cantJugadores = $pCantJugadores;
    }

    public function setObjCategoria($pObjCat)
    {
        $this->objCategoria = $pObjCat;
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
        $cadena .= "\n\tNombre Equipo: ".$this->getNombre();
        $cadena .= "\n\tNombre Capitan: ".$this->getNombreCapitan();
        $cadena .= "\n\tCant Jugadores: ".$this->getCantJugadores();
        $cadena .= "\n\tCategoria: ".$this->getObjCategoria();
        return $cadena;
    }
}