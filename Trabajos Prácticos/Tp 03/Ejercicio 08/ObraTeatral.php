<?php

class ObraTeatral extends Funcion{
    private $autor;

    public function __construct($pNombre, $pInicio, $pDuracion, $pPrecio, $pAutor){
        parent::__construct($pNombre, $pInicio, $pDuracion, $pPrecio);
        $this->autor = $pAutor;
    }

    /**
     * Get the value of autor
     */ 
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * Set the value of autor
     *
     */ 
    public function setAutor($pAutor)
    {
        $this->autor = $pAutor;
    }

    public function __toString(){
        $cadena = "";
        $cadena .= parent::__toString();
        $cadena .= "\nAutor: ".$this->getAutor();
        return $cadena;
    }

    public function recibirCosto(){
        $costo = parent::recibirCosto() * 0.45;
        return $costo;
    }
}