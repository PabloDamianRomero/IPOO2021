<?php

class Cine extends Funcion{
    private $genero;
    private $paisOrigen;

    public function __construct($pNombre, $pInicio, $pDuracion, $pPrecio, $pGenero, $pOrigen){
        parent::__construct($pNombre, $pInicio, $pDuracion, $pPrecio);
        $this->genero = $pGenero;
        $this->paisOrigen = $pOrigen;
    }

    
    /**
     * Get the value of genero
     */ 
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * Set the value of genero
     *
     */ 
    public function setGenero($pGenero)
    {
        $this->genero = $pGenero;
    }

    /**
     * Get the value of paisOrigen
     */ 
    public function getPaisOrigen()
    {
        return $this->paisOrigen;
    }

    /**
     * Set the value of paisOrigen
     */ 
    public function setPaisOrigen($pOrigen)
    {
        $this->paisOrigen = $pOrigen;
    }

    public function __toString(){
        $cadena = "";
        $cadena .= parent::__toString();
        $cadena .= "\nGénero: ".$this->getGenero();
        $cadena .= "\nPaís de origen: ".$this->getPaisOrigen();
        return $cadena;
    }

    public function recibirCosto(){
        $costo = parent::recibirCosto() * 0.65;
        return $costo;
    }
}