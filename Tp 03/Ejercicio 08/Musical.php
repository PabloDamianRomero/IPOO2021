<?php
include 'Funcion.php';
class Musical extends Funcion{
    private $director;
    private $cantPersonasEscena;

    public function __construct($pNombre, $pInicio, $pDuracion, $pPrecio, $pDirector, $pCant){
        parent::__construct($pNombre, $pInicio, $pDuracion, $pPrecio);
        $this->director = $pDirector;
        $this->cantPersonasEscena = $pCant;
    }

    /**
     * Get the value of director
     */ 
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * Set the value of director
     *
     */ 
    public function setDirector($pDirector)
    {
        $this->director = $pDirector;
    }

    /**
     * Get the value of cantPersonasEscena
     */ 
    public function getCantPersonasEscena()
    {
        return $this->cantPersonasEscena;
    }

    /**
     * Set the value of cantPersonasEscena
     *
     */ 
    public function setCantPersonasEscena($pCant)
    {
        $this->cantPersonasEscena = $pCant;
    }

    public function __toString(){
        $cadena = "";
        $cadena .= parent::__toString();
        $cadena .= "\nDirector: ".$this->getDirector();
        $cadena .= "\nPersonas en escena: ".$this->getCantPersonasEscena();
        return $cadena;
    }

    public function recibirCosto(){
        $costo = parent::recibirCosto() * 1.20;
        return $costo;
    }
}