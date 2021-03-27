<?php
class Disquera{
    private $horaDesde;
    private $horaHasta;
    private $estado;
    private $direccion;
    private $objDuenio;

    public function __construct($pHoraDesde, $pHoraHasta, $pEstado, $pDir, $pObjDuenio){
        $this->horaDesde = $pHoraDesde;
        $this->horaHasta = $pHoraHasta;
        $this->estado = $pEstado;
        $this->direccion = $pDir;
        $this->objDuenio = $pObjDuenio;
    }

    public function getHoraDesde(){
        return $this->horaDesde;
    }

    public function getHoraHasta(){
        return $this->horaHasta;
    }

    public function getEstado(){
        return $this->estado;
    }

    public function getDireccion(){
        return $this->direccion;
    }

    public function getDuenio(){
        return $this->objDuenio;
    }

    public function setHoraDesde($pHoraDesde){
        $this->horaDesde = $pHoraDesde;
    }

    public function setHoraHasta($pHoraHasta){
        $this->horaHasta = $pHoraHasta;
    }

    public function setEstado($pEstado){
        $this->estado = $pEstado;
    }

    public function setDireccion($pDir){
        $this->direccion = $pDir;
    }

    public function setDuenio($pObjDuenio){
        $this->objDuenio = $pObjDuenio;
    }

    public function __toString(){
        $cadena = "";
        $cadena = $cadena . "\nAbre: ".$this->getHoraDesde();
        $cadena = $cadena . "\nCierra: ".$this->getHoraHasta();
        $cadena = $cadena . "\nEstado: ".$this->getEstado();
        $cadena = $cadena . "\nDirección: ".$this->getDireccion();
        $cadena = $cadena . "\nDueño: ".$this->getDuenio();
        return $cadena;
    }
}